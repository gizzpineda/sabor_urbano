<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Muestra los platos y las bebidas disponibles en el menú.
     */
    public function index(): View
    {
        $platos = Producto::query()
            ->where('categoria', 'plato')
            ->where('activo', true)
            ->orderBy('subcategoria')
            ->orderBy('nombre')
            ->get()
            ->map(fn (Producto $producto) => [
                'nombre' => $producto->nombre,
                'categoria' => ucfirst($producto->subcategoria),
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'icono' => $producto->icono,
                'presentacion' => $producto->presentacion,
                'marca' => $producto->marca,
                'stock' => $producto->stock,
            ]);

        $bebidas = Producto::query()
            ->where('categoria', 'bebida')
            ->where('activo', true)
            ->orderBy('subcategoria')
            ->orderBy('nombre')
            ->get()
            ->map(fn (Producto $producto) => [
                'nombre' => $producto->nombre,
                'categoria' => ucfirst($producto->subcategoria),
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'icono' => $producto->icono,
                'presentacion' => $producto->presentacion,
                'marca' => $producto->marca,
                'stock' => $producto->stock,
            ]);

        return view('menu', compact('platos', 'bebidas'));
    }
}