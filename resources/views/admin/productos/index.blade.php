@extends('layouts.app')

@section('title', 'Productos | Sabor Urbano')
@section('main-class', 'items-start')

@section('content')
    <section class="w-full space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.25em] text-brand-gold">Administración</p>
                <h1 class="mt-1 font-display text-4xl uppercase tracking-wide text-white">Panel de productos</h1>
            </div>
            <a href="{{ route('admin.productos.create') }}" class="rounded-lg bg-brand-gold px-5 py-3 font-semibold text-brand-black transition hover:brightness-110">+ Nuevo producto</a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-brand-gold/40 bg-brand-gold/10 px-4 py-3 text-sm text-amber-100">{{ session('status') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.productos.index') }}" class="flex flex-wrap items-end gap-3 rounded-xl border border-stone-800 bg-stone-950/80 p-3 sm:flex-nowrap">
            <div>
                <label for="categoria" class="mb-1 block text-xs font-medium text-stone-300">Categoría</label>
                <select id="categoria" name="categoria" class="[color-scheme:dark] rounded-lg border border-stone-700 bg-stone-900 px-3 py-2 text-sm text-stone-100 outline-none transition focus:border-brand-gold focus:ring-1 focus:ring-brand-gold/40">
                    <option value="">Todas</option>
                    <option value="plato" @selected(request('categoria') === 'plato')>Plato</option>
                    <option value="bebida" @selected(request('categoria') === 'bebida')>Bebida</option>
                </select>
            </div>
            <div class="min-w-56 flex-1">
                <label for="buscar" class="mb-1 block text-xs font-medium text-stone-300">Buscar por nombre</label>
                <input id="buscar" name="buscar" type="search" value="{{ request('buscar') }}" class="w-full [color-scheme:dark] rounded-lg border border-stone-700 bg-stone-900 px-3 py-2 text-sm text-stone-100 outline-none transition focus:border-brand-gold focus:ring-1 focus:ring-brand-gold/40" placeholder="Nombre del producto">
            </div>
            <button class="h-10 shrink-0 rounded-lg bg-brand-gold px-5 text-sm font-semibold text-brand-black transition hover:brightness-110">Filtrar</button>
        </form>

        <div class="w-full min-w-0 overflow-x-auto rounded-xl border border-stone-800 bg-stone-950/80">
            <table class="w-full min-w-[1120px] text-left text-sm">
                <thead class="border-b border-stone-800 bg-stone-900/80 text-[11px] uppercase tracking-[0.16em] text-brand-gold">
                    <tr><th class="px-5 py-4">Nombre</th><th class="px-5 py-4">Categoría</th><th class="px-5 py-4">Subcategoría</th><th class="px-5 py-4 text-right">Precio</th><th class="px-5 py-4">Stock</th><th class="px-5 py-4">Estado</th><th class="px-5 py-4">Acciones</th></tr>
                </thead>
                <tbody class="divide-y divide-stone-800">
                    @forelse ($productos as $producto)
                        <tr class="transition-colors hover:bg-white/[0.03]">
                            <td class="px-5 py-4 font-medium text-white">{{ $producto->nombre }}</td>
                            <td class="px-5 py-4 capitalize text-stone-300">{{ $producto->categoria }}</td>
                            <td class="px-5 py-4 text-stone-300">{{ ucfirst($producto->subcategoria) }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-right font-medium tabular-nums text-stone-200">Gs. {{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="inline-flex min-w-8 justify-center rounded-full border border-stone-700 bg-stone-900 px-2 py-1 text-xs tabular-nums text-stone-200">{{ $producto->stock }}</span>
                                @if ($producto->stock === 0)
                                    <span class="ml-1 rounded-full border border-stone-600 bg-stone-800 px-2 py-1 text-xs font-medium text-stone-300">Agotado</span>
                                @elseif ($producto->stock <= 5)
                                    <span class="ml-1 rounded-full border border-brand-gold/50 bg-brand-gold/10 px-2 py-1 text-xs font-medium text-amber-200">Stock bajo</span>
                                @endif
                            </td>
                            <td class="px-5 py-4"><span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-medium {{ $producto->activo ? 'border-brand-gold/40 bg-brand-gold/10 text-amber-200' : 'border-stone-700 bg-stone-900 text-stone-400' }}">{{ $producto->activo ? 'Activo' : 'Inactivo' }}</span></td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="inline-flex items-center gap-2 align-middle">
                                    <a href="{{ route('admin.productos.edit', $producto) }}" class="inline-flex h-8 items-center rounded-md border border-brand-gold/70 px-3 text-xs font-medium text-brand-gold transition hover:bg-brand-gold hover:text-brand-black">Editar</a>
                                    <form method="POST" action="{{ route('admin.productos.toggle', $producto) }}">
                                        @csrf @method('PATCH')
                                        <button class="inline-flex h-8 items-center rounded-md border border-stone-600 px-3 text-xs font-medium text-stone-200 transition hover:border-brand-gold hover:text-brand-gold">{{ $producto->activo ? 'Desactivar' : 'Activar' }}</button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('admin.productos.stock', $producto) }}" class="inline-flex items-center gap-2 align-middle">
                                    @csrf @method('PATCH')
                                    <label class="sr-only" for="stock-{{ $producto->id }}">{{ $producto->nombre }}</label>
                                    <input id="stock-{{ $producto->id }}" name="stock" type="number" min="0" step="1" required value="{{ $producto->stock }}" aria-label="{{ $producto->nombre }}" class="h-8 w-20 rounded-md border border-stone-700 bg-stone-900 px-2 text-right text-xs tabular-nums text-stone-100 outline-none focus:border-brand-gold focus:ring-1 focus:ring-brand-gold/40">
                                    <button class="inline-flex h-8 items-center whitespace-nowrap rounded-md bg-brand-gold px-3 text-xs font-semibold text-brand-black transition hover:brightness-110">Guardar</button>
                                </form>
                                @if ($errors->has('stock'))<p class="mt-1 text-xs text-amber-200">{{ $errors->first('stock') }}</p>@endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-10 text-center text-stone-400">No se encontraron productos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $productos->links() }}</div>
    </section>
@endsection
