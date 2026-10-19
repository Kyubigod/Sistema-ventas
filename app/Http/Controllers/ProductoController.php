<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function getProductos() {
    $productos = Producto::select(
        'productos.id',
        'productos.producto',
        'productos.precio',
        'productos.stock',
        'categoria.categoria as nombre_categoria'
    )
    ->join('categoria', 'productos.categoria_id', '=', 'categoria.id')
    ->get();

    $categorias = Categoria::all();

    return view('productos', compact('productos', 'categorias'));
}
        public function createProducto(Request $request) {
    $request->validate([
        "producto" => "required",
        "precio" => "required",
        "stock" => "required",
        "categoria_id" => "required"
    ]);

    Producto::create([
        'producto' => $request->producto,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'categoria_id' => $request->categoria_id
    ]);

    return redirect("/productos")->with([
        "mensaje" => "producto registrado"
    ]);
} 

        public function updateProducto(int $id, Request $request)
{
    $request->validate([
        'producto'     => 'required',
        'precio'       => 'required|numeric',
        'stock'        => 'required|integer',
        'categoria_id' => 'required',
    ]);

    $producto = Producto::findOrFail($id);

    $producto->update([
        'producto'     => $request->producto, 
        'precio'       => $request->precio,
        'stock'        => $request->stock,
        'categoria_id' => $request->categoria_id,
    ]);

    return back()->with('success', 'Producto actualizado correctamente.');
}

       public function deleteProducto(int $id)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    return back()->with('success', 'Producto eliminado correctamente.');
}
 }
