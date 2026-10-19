<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function getClientes()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }

    public function createCliente(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:clientes,email',
            'direccion' => 'nullable',
            'telefono' => 'nullable'
        ]);

        Cliente::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        return redirect('/clientes')->with([
            'mensaje' => 'Cliente registrado'
        ]);
    }

   public function updateCliente(int $id, Request $request)
{
    $request->validate([
        'nombre'    => 'required',
        'email'     => 'required|email|unique:clientes,email,' . $id,
        'direccion' => 'nullable',
        'telefono'  => 'nullable'
    ]);

    $cliente = Cliente::findOrFail($id);

    $cliente->update([
        'nombre'    => $request->nombre,
        'email'     => $request->email,
        'direccion' => $request->direccion,
        'telefono'  => $request->telefono
    ]);

    return redirect()->route('getclientes')->with('success', 'Cliente actualizado correctamente.');
}

    public function deleteCliente(int $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('/clientes')->with([
            'mensaje' => 'Cliente eliminado'
        ]);
    }
}