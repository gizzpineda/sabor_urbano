<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(Request $request): View
    {
        $pedidos = Pedido::query()
            ->where('user_id', $request->user()->id)
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'distinct', 'exists:productos,id'],
            'items.*.cantidad' => ['required', 'integer', 'min:1'],
            'nota' => ['nullable', 'string', 'max:2000'],
        ], [
            'items.required' => 'Agrega al menos un producto al carrito.',
            'items.min' => 'Agrega al menos un producto al carrito.',
            'items.*.id.required' => 'Hay un producto inválido en el carrito.',
            'items.*.id.exists' => 'Uno de los productos ya no está disponible.',
            'items.*.id.distinct' => 'El carrito contiene un producto repetido.',
            'items.*.cantidad.required' => 'Indica la cantidad de cada producto.',
            'items.*.cantidad.integer' => 'Las cantidades deben ser números enteros.',
            'items.*.cantidad.min' => 'Cada cantidad debe ser al menos 1.',
            'nota.max' => 'La nota no puede superar los 2000 caracteres.',
        ]);

        $pedido = DB::transaction(function () use ($request, $validated): Pedido {
            $items = collect($validated['items']);
            $productos = Producto::query()
                ->whereIn('id', $items->pluck('id'))
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            foreach ($items as $index => $item) {
                $producto = $productos->get($item['id']);

                if (! $producto || ! $producto->activo) {
                    throw ValidationException::withMessages([
                        'items' => 'El producto seleccionado ya no está disponible. Actualiza el menú e inténtalo de nuevo.',
                    ]);
                }

                if ($producto->stock < $item['cantidad']) {
                    throw ValidationException::withMessages([
                        'items' => "Stock insuficiente para {$producto->nombre}. Disponible: {$producto->stock}.",
                    ]);
                }
            }

            $pedido = Pedido::create([
                'user_id' => $request->user()->id,
                'total' => 0,
                'nota' => $validated['nota'] ?? null,
                'estado' => 'pendiente',
            ]);

            $total = 0;

            foreach ($items as $item) {
                $producto = $productos->get($item['id']);
                $cantidad = (int) $item['cantidad'];
                $subtotal = $producto->precio * $cantidad;

                $pedido->items()->create([
                    'producto_id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio_unitario' => $producto->precio,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ]);

                $producto->decrement('stock', $cantidad);
                $total += $subtotal;
            }

            $pedido->update(['total' => $total]);

            return $pedido;
        });

        return response()->json([
            'message' => 'Pedido enviado correctamente.',
            'numero' => $pedido->id,
            'total' => $pedido->total,
        ], 201);
    }
}
