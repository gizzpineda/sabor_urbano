@php($editing = $producto->exists)

@if ($errors->any())
    <div class="rounded-lg border border-brand-gold/40 bg-brand-gold/10 p-4 text-sm text-amber-100" role="alert">
        <ul class="list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<form method="POST" action="{{ $editing ? route('admin.productos.update', $producto) : route('admin.productos.store') }}" class="space-y-5 rounded-2xl border border-brand-gold/30 bg-stone-950/90 p-6 shadow-2xl shadow-black/40">
    @csrf
    @if ($editing) @method('PUT') @endif

    <div class="grid gap-4 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label for="nombre" class="mb-1 block text-sm text-stone-300">Nombre *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required maxlength="255" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
            @error('nombre')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="categoria" class="mb-1 block text-sm text-stone-300">Categoría *</label>
            <select id="categoria" name="categoria" required class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
                <option value="">Selecciona una categoría</option>
                <option value="plato" @selected(old('categoria', $producto->categoria) === 'plato')>Plato</option>
                <option value="bebida" @selected(old('categoria', $producto->categoria) === 'bebida')>Bebida</option>
            </select>
            @error('categoria')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="subcategoria" class="mb-1 block text-sm text-stone-300">Subcategoría *</label>
            <select id="subcategoria" name="subcategoria" required class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
                <option value="">Selecciona una subcategoría</option>
                @foreach ($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria }}" @selected(old('subcategoria', $producto->subcategoria) === $subcategoria)>{{ ucfirst($subcategoria) }}</option>
                @endforeach
            </select>
            @error('subcategoria')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="precio" class="mb-1 block text-sm text-stone-300">Precio en guaraníes *</label>
            <input id="precio" name="precio" type="number" min="0" step="1" value="{{ old('precio', $producto->precio) }}" required class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
            @error('precio')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="stock" class="mb-1 block text-sm text-stone-300">Stock *</label>
            <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', $producto->stock ?? 0) }}" required class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
            @error('stock')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="presentacion" class="mb-1 block text-sm text-stone-300">Presentación</label>
            <input id="presentacion" name="presentacion" value="{{ old('presentacion', $producto->presentacion) }}" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
            @error('presentacion')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="marca" class="mb-1 block text-sm text-stone-300">Marca</label>
            <input id="marca" name="marca" value="{{ old('marca', $producto->marca) }}" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
            @error('marca')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="icono" class="mb-1 block text-sm text-stone-300">Icono *</label>
            <select id="icono" name="icono" required class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">
                <option value="">Selecciona un icono</option>
                @foreach ($iconos as $icono)
                    <option value="{{ $icono }}" @selected(old('icono', $producto->icono) === $icono)>{{ ucfirst($icono) }}</option>
                @endforeach
            </select>
            @error('icono')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label for="descripcion" class="mb-1 block text-sm text-stone-300">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white focus:border-brand-gold">{{ old('descripcion', $producto->descripcion) }}</textarea>
            @error('descripcion')<p class="mt-1 text-sm text-amber-200">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="flex flex-wrap justify-end gap-3 border-t border-stone-800 pt-4">
        <a href="{{ route('admin.productos.index') }}" class="rounded-lg border border-stone-700 px-5 py-3 text-stone-300 transition hover:border-brand-gold hover:text-brand-gold">Cancelar</a>
        <button type="submit" class="rounded-lg bg-brand-gold px-5 py-3 font-semibold text-brand-black transition hover:brightness-110">{{ $editing ? 'Guardar cambios' : 'Crear producto' }}</button>
    </div>
</form>
