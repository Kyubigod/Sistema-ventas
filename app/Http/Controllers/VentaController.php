<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function getVentas()
    {
        $ventas = Venta::join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->select('ventas.*', 'clientes.nombre as nombre_cliente')
            ->get();

        $clientes = Cliente::all();
        $productos = Producto::all();

        return view('ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function createVenta(Request $request)
    {
        $request->validate([
            'cliente_id'  => 'required',
            'producto_id' => 'required',
            'cantidad'    => 'required|integer|min:1',
            'estado'      => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock para realizar esta venta.');
        }

        $subtotal = $producto->precio * $request->cantidad;

        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha'      => now(),
            'estado'     => $request->estado,
            'total'      => $subtotal,
        ]);

        DetalleVenta::create([
            'venta_id'        => $venta->id,
            'producto_id'     => $producto->id,
            'cantidad'        => $request->cantidad,
            'precio_unitario' => $producto->precio,
            'total'           => $subtotal,
        ]);

        $producto->decrement('stock', $request->cantidad);

        return back()->with('success', 'Venta registrada con éxito.');
    }

    public function updateVenta(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update([
            'estado' => $request->estado,
        ]);

        return back()->with('success', 'Venta actualizada correctamente.');
    }

    public function deleteVenta($id)
    {
        $venta = Venta::findOrFail($id);

        if ($venta->estado === 'confirmada') {
            return back()->with('error', 'No se pueden eliminar ventas con estado confirmada.');
        }

        $venta->delete();

        return back()->with('success', 'Venta eliminada correctamente.');
    }
}