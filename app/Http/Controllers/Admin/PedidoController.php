<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(): View
    {
        $pedidos = Pedido::query()
            ->with(['user', 'items'])
            ->latest()
            ->paginate(15);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function deliver(Pedido $pedido): RedirectResponse
    {
        if ($pedido->estado !== 'entregado') {
            $pedido->update(['estado' => 'entregado']);
        }

        return redirect()->route('admin.pedidos.index')->with('status', "El pedido #{$pedido->id} figura como entregado.");
    }
}
