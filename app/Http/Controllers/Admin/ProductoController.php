<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    private const ICONOS = ['hamburguesa', 'pizza', 'lomito', 'sandwich', 'empanada', 'gaseosa', 'cerveza'];

    private const SUBCATEGORIAS = ['hamburguesas', 'pizzas', 'lomitos', 'sandwiches', 'empanadas', 'gaseosas', 'cervezas'];

    public function index(Request $request): View
    {
        $productos = Producto::query()
            ->when($request->filled('categoria'), fn ($query) => $query->where('categoria', $request->string('categoria')))
            ->when($request->filled('buscar'), fn ($query) => $query->where('nombre', 'like', '%'.$request->string('buscar').'%'))
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('admin.productos.index', compact('productos'));
    }

    public function create(): View
    {
        return view('admin.productos.create', [
            'producto' => new Producto(),
            'iconos' => self::ICONOS,
            'subcategorias' => self::SUBCATEGORIAS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Producto::create($this->validatedData($request));

        return redirect()->route('admin.productos.index')->with('status', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto): View
    {
        return view('admin.productos.edit', [
            'producto' => $producto,
            'iconos' => self::ICONOS,
            'subcategorias' => self::SUBCATEGORIAS,
        ]);
    }

    public function update(Request $request, Producto $producto): RedirectResponse
    {
        $producto->update($this->validatedData($request));

        return redirect()->route('admin.productos.index')->with('status', 'Producto actualizado correctamente.');
    }

    public function updateStock(Request $request, Producto $producto): RedirectResponse
    {
        $data = $request->validate([
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
        ]);

        $producto->update($data);

        return redirect()->route('admin.productos.index')->with('status', 'Stock actualizado correctamente.');
    }

    public function toggleActive(Producto $producto): RedirectResponse
    {
        $producto->update(['activo' => ! $producto->activo]);

        return redirect()->route('admin.productos.index')->with('status', $producto->activo
            ? 'Producto activado correctamente.'
            : 'Producto desactivado correctamente.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'in:plato,bebida'],
            'subcategoria' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'integer', 'min:0'],
            'presentacion' => ['nullable', 'string', 'max:255'],
            'marca' => ['nullable', 'string', 'max:255'],
            'icono' => ['required', 'in:'.implode(',', self::ICONOS)],
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
            'categoria.required' => 'La categoría es obligatoria.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
            'subcategoria.required' => 'La subcategoría es obligatoria.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.integer' => 'El precio debe ser un número entero en guaraníes.',
            'precio.min' => 'El precio no puede ser negativo.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'icono.required' => 'El icono es obligatorio.',
            'icono.in' => 'Selecciona uno de los iconos disponibles.',
        ]);
    }
}
