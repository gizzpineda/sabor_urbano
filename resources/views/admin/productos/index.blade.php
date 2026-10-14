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

        <form method="GET" action="{{ route('admin.productos.index') }}" class="flex flex-wrap items-end gap-3 rounded-xl border border-stone-800 bg-stone-950/80 p-4">
            <div>
                <label for="categoria" class="mb-1 block text-sm text-stone-300">Categoría</label>
                <select id="categoria" name="categoria" class="rounded-lg border border-stone-700 bg-stone-900 px-3 py-2 text-white focus:border-brand-gold">
                    <option value="">Todas</option>
                    <option value="plato" @selected(request('categoria') === 'plato')>Plato</option>
                    <option value="bebida" @selected(request('categoria') === 'bebida')>Bebida</option>
                </select>
            </div>
            <div class="min-w-56 flex-1">
                <label for="buscar" class="mb-1 block text-sm text-stone-300">Buscar por nombre</label>
                <input id="buscar" name="buscar" type="search" value="{{ request('buscar') }}" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-3 py-2 text-white focus:border-brand-gold" placeholder="Nombre del producto">
            </div>
            <button class="rounded-lg border border-brand-gold px-4 py-2 font-medium text-brand-gold transition hover:bg-brand-gold hover:text-brand-black">Filtrar</button>
        </form>

        <div class="overflow-x-auto rounded-xl border border-stone-800 bg-stone-950/80">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="border-b border-stone-800 bg-stone-900/80 text-xs uppercase tracking-wider text-stone-400">
                    <tr><th class="px-4 py-3">Nombre</th><th class="px-4 py-3">Categoría</th><th class="px-4 py-3">Subcategoría</th><th class="px-4 py-3">Precio</th><th class="px-4 py-3">Stock</th><th class="px-4 py-3">Estado</th><th class="px-4 py-3">Acciones</th></tr>
                </thead>
                <tbody class="divide-y divide-stone-800">
                    @forelse ($productos as $producto)
                        <tr>
                            <td class="px-4 py-4 font-medium text-white">{{ $producto->nombre }}</td>
                            <td class="px-4 py-4 capitalize text-stone-300">{{ $producto->categoria }}</td>
                            <td class="px-4 py-4 text-stone-300">{{ ucfirst($producto->subcategoria) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-stone-200">Gs. {{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                <span class="text-stone-200">{{ $producto->stock }}</span>
                                @if ($producto->stock === 0)
                                    <span class="ml-1 rounded-full border border-brand-gold/50 bg-brand-gold/15 px-2 py-1 text-xs font-medium text-amber-200">Agotado</span>
                                @elseif ($producto->stock <= 5)
                                    <span class="ml-1 rounded-full border border-brand-gold/50 bg-brand-gold/15 px-2 py-1 text-xs font-medium text-amber-200">Stock bajo</span>
                                @endif
                            </td>
                            <td class="px-4 py-4"><span class="rounded-full border border-stone-700 px-2.5 py-1 text-xs {{ $producto->activo ? 'text-amber-200 border-brand-gold/40' : 'text-stone-400' }}">{{ $producto->activo ? 'Activo' : 'Inactivo' }}</span></td>
                            <td class="space-y-3 px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.productos.edit', $producto) }}" class="rounded-md border border-brand-gold/60 px-3 py-1.5 text-xs font-medium text-brand-gold transition hover:bg-brand-gold hover:text-brand-black">Editar</a>
                                    <form method="POST" action="{{ route('admin.productos.toggle', $producto) }}">
                                        @csrf @method('PATCH')
                                        <button class="rounded-md border border-stone-600 px-3 py-1.5 text-xs font-medium text-stone-200 transition hover:border-brand-gold hover:text-brand-gold">{{ $producto->activo ? 'Desactivar' : 'Activar' }}</button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('admin.productos.stock', $producto) }}" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <label class="sr-only" for="stock-{{ $producto->id }}">Nuevo stock para {{ $producto->nombre }}</label>
                                    <input id="stock-{{ $producto->id }}" name="stock" type="number" min="0" step="1" required value="{{ $producto->stock }}" class="w-20 rounded-md border border-stone-700 bg-stone-900 px-2 py-1.5 text-white focus:border-brand-gold">
                                    <button class="whitespace-nowrap rounded-md bg-brand-gold px-3 py-1.5 text-xs font-semibold text-brand-black transition hover:brightness-110">Actualizar stock</button>
                                </form>
                                @if ($errors->has('stock'))<p class="text-xs text-amber-200">{{ $errors->first('stock') }}</p>@endif
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
