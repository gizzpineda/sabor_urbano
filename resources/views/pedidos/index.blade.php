@extends('layouts.app')

@section('title', 'Mis pedidos | Sabor Urbano')
@section('main-class', 'items-start')

@section('content')
    <section class="w-full space-y-6">
        <div>
            <p class="text-sm font-medium uppercase tracking-[0.25em] text-brand-gold">Tu cuenta</p>
            <h1 class="mt-1 font-display text-4xl uppercase tracking-wide text-white">Mis pedidos</h1>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-brand-gold/40 bg-brand-gold/10 px-4 py-3 text-sm text-amber-100">{{ session('status') }}</div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-stone-800 bg-stone-950/80">
            <table class="w-full min-w-[640px] text-left text-sm">
                <thead class="border-b border-stone-800 bg-stone-900/80 text-[11px] uppercase tracking-[0.16em] text-brand-gold">
                    <tr><th class="px-5 py-4">Número</th><th class="px-5 py-4">Fecha</th><th class="px-5 py-4 text-right">Total</th><th class="px-5 py-4">Estado</th></tr>
                </thead>
                <tbody class="divide-y divide-stone-800">
                    @forelse ($pedidos as $pedido)
                        <tr class="transition-colors hover:bg-white/[0.03]">
                            <td class="px-5 py-4 font-medium text-white">#{{ $pedido->id }}</td>
                            <td class="px-5 py-4 text-stone-300">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-right tabular-nums text-brand-gold">Gs. {{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td class="px-5 py-4"><span class="rounded-full border px-2.5 py-1 text-xs {{ $pedido->estado === 'entregado' ? 'border-brand-gold/40 bg-brand-gold/10 text-amber-200' : 'border-stone-700 bg-stone-900 text-stone-300' }}">{{ ucfirst($pedido->estado) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-10 text-center text-stone-400">Todavía no tienes pedidos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $pedidos->links() }}
    </section>
@endsection
