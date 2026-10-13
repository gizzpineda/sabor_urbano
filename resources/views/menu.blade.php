@extends('layouts.app')

@section('title', 'Menú - Sabor Urbano')
@section('main-class', 'items-start py-4 md:py-6')

@section('content')
<div class="w-full">

    {{-- Encabezado principal del menú --}}
    <header class="text-center">
        <span class="inline-flex items-center gap-2 rounded-full border border-brand-gold/40 bg-brand-gold/10 px-4 py-1 text-xs font-medium uppercase tracking-widest text-brand-gold">
            Carta gastronómica
        </span>

        <h1 class="mt-2.5 font-display text-4xl uppercase tracking-wide text-white md:text-6xl">
            Nuestro <span class="bg-linear-to-b from-[#f3d27a] to-brand-gold bg-clip-text text-transparent">Menú</span>
        </h1>

        {{-- Detalle dorado --}}
        <div class="mt-2 flex items-center justify-center gap-3" aria-hidden="true">
            <span class="h-px w-12 bg-linear-to-r from-transparent to-brand-gold md:w-28"></span>
            <span class="h-1.5 w-1.5 rotate-45 bg-brand-gold"></span>
            <span class="h-px w-12 bg-linear-to-l from-transparent to-brand-gold md:w-28"></span>
        </div>

        <p class="mx-auto mt-2.5 max-w-lg text-sm text-stone-300 md:text-base">
            Sabores auténticos de la cocina urbana, preparados al momento con ingredientes de primera calidad.
        </p>

        {{-- Navegación interna con anclas --}}
        <nav class="mt-5 flex flex-wrap items-center justify-center gap-3" aria-label="Navegación de secciones del menú">
            <a href="#platos"
               class="group inline-flex items-center gap-2 rounded-full border border-brand-gold/60 bg-black/40 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-200 backdrop-blur transition duration-300 hover:border-brand-gold hover:bg-brand-gold hover:text-brand-black">
                <svg class="h-4 w-4 text-brand-gold transition group-hover:text-brand-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 14a8 8 0 0 1 16 0H4z" />
                    <rect x="3" y="16" width="18" height="2" rx="1" />
                </svg>
                Platos
            </a>

            <a href="#bebidas"
               class="group inline-flex items-center gap-2 rounded-full border border-white/20 bg-black/40 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-stone-200 backdrop-blur transition duration-300 hover:border-brand-gold hover:bg-brand-gold hover:text-brand-black">
                <svg class="h-4 w-4 text-brand-gold transition group-hover:text-brand-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="7" y="4" width="10" height="16" rx="2" />
                    <line x1="7" y1="7" x2="17" y2="7" />
                </svg>
                Bebidas
            </a>
        </nav>
    </header>

    {{-- SECCIÓN 1: PLATOS --}}
    <section id="platos" class="scroll-mt-24 pt-6 md:pt-8">
        <div class="mb-5 flex flex-col items-center justify-between gap-3 border-b border-white/10 pb-3 sm:flex-row sm:items-end">
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-brand-gold">Sección 01</span>
                <h2 class="font-display text-3xl uppercase tracking-wide text-white md:text-4xl">
                    Platos <span class="text-brand-gold">Urbanos</span>
                </h2>
            </div>
            <p class="text-xs text-stone-400 sm:text-sm">
                Hamburguesas artesanales, pizzas, lomitos, sandwiches y empanadas
            </p>
        </div>

        {{-- Grilla responsive: 1 col móvil, 2 tablet, 4 escritorio --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($platos as $plato)
                <article class="group relative flex flex-col justify-between rounded-2xl border border-white/10 bg-black/50 p-5 backdrop-blur transition duration-300 hover:-translate-y-1.5 hover:border-brand-gold/60 hover:shadow-[0_12px_28px_-8px_rgba(193,154,33,0.3)]">
                    <div>
                        {{-- Cabecera de la tarjeta: icono y categoría --}}
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-brand-gold/30 bg-brand-gold/10 text-brand-gold transition duration-300 group-hover:scale-105 group-hover:border-brand-gold group-hover:bg-brand-gold/20">
                                <x-icono :name="$plato['icono']" class="h-6 w-6" />
                            </div>

                            <span class="rounded-full border border-brand-gold/20 bg-brand-gold/5 px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wider text-brand-gold">
                                {{ $plato['categoria'] }}
                            </span>
                        </div>

                        {{-- Nombre del plato --}}
                        <h3 class="font-display text-xl uppercase tracking-wide text-white transition duration-200 group-hover:text-brand-gold">
                            {{ $plato['nombre'] }}
                        </h3>

                        {{-- Descripción corta --}}
                        <p class="mt-2 text-xs leading-relaxed text-stone-400">
                            {{ $plato['descripcion'] }}
                        </p>
                    </div>

                    {{-- Pie de tarjeta: precio y botón de agregar --}}
                    <div class="mt-5 flex items-center justify-between border-t border-white/10 pt-4">
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider text-stone-500">Precio</span>
                            <span class="font-display text-lg tracking-wide text-brand-gold md:text-xl">
                                Gs. {{ number_format($plato['precio'], 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="button"
                                class="inline-flex items-center gap-1.5 rounded-full border border-brand-gold/60 bg-brand-gold/10 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-brand-gold transition duration-200 hover:bg-brand-gold hover:text-brand-black">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Agregar
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- SECCIÓN 2: BEBIDAS --}}
    <section id="bebidas" class="scroll-mt-24 pt-14 md:pt-20">
        <div class="mb-8 flex flex-col items-center justify-between gap-3 border-b border-white/10 pb-4 sm:flex-row sm:items-end">
            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-brand-gold">Sección 02</span>
                <h2 class="font-display text-3xl uppercase tracking-wide text-white md:text-4xl">
                    Bebidas <span class="text-brand-gold">& Cervezas</span>
                </h2>
            </div>
            <p class="text-xs text-stone-400 sm:text-sm">
                Gaseosas y cervezas servidas en su punto ideal de temperatura
            </p>
        </div>

        {{-- Grilla responsive: 1 col móvil, 2 tablet, 4 escritorio --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($bebidas as $bebida)
                <article class="group relative flex flex-col justify-between rounded-2xl border border-white/10 bg-black/50 p-5 backdrop-blur transition duration-300 hover:-translate-y-1.5 hover:border-brand-gold/60 hover:shadow-[0_12px_28px_-8px_rgba(193,154,33,0.3)]">
                    <div>
                        {{-- Cabecera de la tarjeta: icono y categoría --}}
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl border border-brand-gold/30 bg-brand-gold/10 text-brand-gold transition duration-300 group-hover:scale-105 group-hover:border-brand-gold group-hover:bg-brand-gold/20">
                                <x-icono :name="$bebida['icono']" class="h-6 w-6" />
                            </div>

                            <span class="rounded-full border border-brand-gold/20 bg-brand-gold/5 px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wider text-brand-gold">
                                {{ $bebida['categoria'] }}
                            </span>
                        </div>

                        {{-- Nombre de la bebida --}}
                        <h3 class="font-display text-xl uppercase tracking-wide text-white transition duration-200 group-hover:text-brand-gold">
                            {{ $bebida['nombre'] }}
                        </h3>

                        {{-- Presentación y Marca --}}
                        <div class="mt-2.5 flex flex-wrap items-center gap-1.5">
                            <span class="inline-flex items-center rounded-md border border-brand-gold/40 bg-brand-gold/10 px-2 py-0.5 text-[11px] font-medium text-brand-gold">
                                {{ $bebida['presentacion'] }}
                            </span>
                            <span class="inline-flex items-center rounded-md border border-white/10 bg-white/5 px-2 py-0.5 text-[11px] text-stone-300">
                                {{ $bebida['marca'] }}
                            </span>
                        </div>

                        {{-- Descripción corta --}}
                        <p class="mt-2 text-xs leading-relaxed text-stone-400">
                            {{ $bebida['descripcion'] }}
                        </p>
                    </div>

                    {{-- Pie de tarjeta: precio y botón de agregar --}}
                    <div class="mt-5 flex items-center justify-between border-t border-white/10 pt-4">
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider text-stone-500">Precio</span>
                            <span class="font-display text-lg tracking-wide text-brand-gold md:text-xl">
                                Gs. {{ number_format($bebida['precio'], 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="button"
                                class="inline-flex items-center gap-1.5 rounded-full border border-brand-gold/60 bg-brand-gold/10 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-brand-gold transition duration-200 hover:bg-brand-gold hover:text-brand-black">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Agregar
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

</div>
@endsection
