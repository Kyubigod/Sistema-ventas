<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function getCategorias()
    {
        $categorias = Categoria::all();
        return view('categoria', compact('categorias'));
    }

    public function createCategoria(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255'
        ]);

        Categoria::create([
            'categoria' => $request->categoria
        ]);

        return redirect()->route('getcategorias');
    }

    public function updateCategoria($id, Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255'
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'categoria' => $request->categoria
        ]);

        return redirect()->route('getcategorias');
    }

    public function deleteCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('getcategorias');
    }
}