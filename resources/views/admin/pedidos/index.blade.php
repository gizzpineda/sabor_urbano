@extends('layouts.app')

@section('title', 'Pedidos | Sabor Urbano')
@section('main-class', 'items-start')

@section('content')
    <section class="w-full space-y-6">
        <div>
            <p class="text-sm font-medium uppercase tracking-[0.25em] text-brand-gold">Administración</p>
            <h1 class="mt-1 font-display text-4xl uppercase tracking-wide text-white">Pedidos</h1>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-brand-gold/40 bg-brand-gold/10 px-4 py-3 text-sm text-amber-100">{{ session('status') }}</div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-stone-800 bg-stone-950/80">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead class="border-b border-stone-800 bg-stone-900/80 text-[11px] uppercase tracking-[0.16em] text-brand-gold">
                    <tr><th class="px-5 py-4">Número</th><th class="px-5 py-4">Cliente</th><th class="px-5 py-4">Fecha</th><th class="px-5 py-4 text-right">Total</th><th class="px-5 py-4">Estado</th><th class="px-5 py-4">Productos</th><th class="px-5 py-4">Acción</th></tr>
                </thead>
                <tbody class="divide-y divide-stone-800">
                    @forelse ($pedidos as $pedido)
                        <tr class="align-top transition-colors hover:bg-white/[0.03]">
                            <td class="px-5 py-4 font-medium text-white">#{{ $pedido->id }}</td>
                            <td class="px-5 py-4"><p class="font-medium text-white">{{ $pedido->user->name }}</p><p class="text-xs text-stone-400">{{ $pedido->user->email }}</p></td>
                            <td class="whitespace-nowrap px-5 py-4 text-stone-300">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-right tabular-nums text-brand-gold">Gs. {{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td class="px-5 py-4"><span class="rounded-full border px-2.5 py-1 text-xs {{ $pedido->estado === 'entregado' ? 'border-brand-gold/40 bg-brand-gold/10 text-amber-200' : 'border-stone-700 bg-stone-900 text-stone-300' }}">{{ ucfirst($pedido->estado) }}</span></td>
                            <td class="px-5 py-4">
                                <ul class="space-y-1 text-xs text-stone-300">
                                    @foreach ($pedido->items as $item)
                                        <li>{{ $item->cantidad }} × {{ $item->nombre }} <span class="text-stone-500">(Gs. {{ number_format($item->subtotal, 0, ',', '.') }})</span></li>
                                    @endforeach
                                </ul>
                                @if ($pedido->nota)<p class="mt-2 max-w-xs text-xs text-stone-400">Nota: {{ $pedido->nota }}</p>@endif
                            </td>
                            <td class="px-5 py-4">
                                @if ($pedido->estado !== 'entregado')
                                    <form method="POST" action="{{ route('admin.pedidos.deliver', $pedido) }}">
                                        @csrf @method('PATCH')
                                        <button class="whitespace-nowrap rounded-lg bg-brand-gold px-3 py-2 text-xs font-semibold text-brand-black transition hover:brightness-110">Marcar entregado</button>
                                    </form>
                                @else
                                    <span class="text-xs text-stone-500">Completado</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-10 text-center text-stone-400">No hay pedidos todavía.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pedidos->links() }}
    </section>
@endsection
