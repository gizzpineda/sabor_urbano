@extends('layouts.app')

@section('title', 'Inicio')
@section('body-class', 'lg:h-dvh lg:overflow-hidden')

@section('content')

<section class="grid w-full items-center gap-8 md:grid-cols-2">

    {{-- Texto --}}
    <div>
        <span class="inline-flex items-center gap-2 rounded-full border border-brand-gold/40 bg-brand-gold/10 px-4 py-1 text-xs font-medium uppercase tracking-widest text-brand-gold">
            <span class="h-2 w-2 animate-pulse rounded-full bg-brand-red"></span> Comida urbana
        </span>

        <h1 class="mt-5 font-display text-5xl uppercase leading-none text-white md:text-6xl lg:text-7xl">
            Calidad, sabor y <span class="text-brand-gold">rapidez</span>
        </h1>

        <p class="mt-5 max-w-md text-stone-300">
            Elige tu plato favorito, haz tu pedido en pocos pasos y recíbelo donde estés.
        </p>
        <div class="mt-7 flex flex-wrap items-center gap-4">
            <a href="#" class="group inline-flex items-center gap-2 rounded-full bg-linear-to-b from-[#f3d27a] to-brand-gold px-8 py-3.5 text-sm font-semibold uppercase tracking-wider text-brand-black shadow-[0_10px_30px_-8px_rgba(193,154,33,0.9),inset_0_1px_0_rgba(255,255,255,0.5)] transition duration-300 hover:-translate-y-0.5 hover:brightness-110">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                Hacer pedido
                <span class="transition group-hover:translate-x-1">→</span>
            </a>

            <a href="{{ route('menu') }}" class="inline-flex items-center rounded-full border border-white/25 px-8 py-3.5 text-sm font-semibold uppercase tracking-wider text-stone-200 transition hover:border-brand-gold hover:text-brand-gold">
                Ver menú
            </a>
        </div>
    </div>

    {{-- Hamburguesa --}}
    <div class="relative flex items-center justify-center">
        <div class="absolute hidden h-[min(26rem,58vh)] w-[min(26rem,58vh)] rounded-full border border-brand-gold/20 lg:block"></div>
        <div class="absolute hidden h-[min(32rem,72vh)] w-[min(32rem,72vh)] rounded-full border border-brand-gold/10 lg:block"></div>

        <div class="animate-float relative flex h-60 w-60 items-center justify-center rounded-full border-4 border-brand-gold bg-linear-to-br from-brand-gray to-brand-black shadow-[0_0_80px_rgba(193,154,33,0.35)] md:h-72 md:w-72 lg:h-[min(20rem,45vh)] lg:w-[min(20rem,45vh)]">
            <svg viewBox="0 60 300 190"
                class="w-3/4 text-brand-gold drop-shadow-[0_0_14px_rgba(193,154,33,0.45)]"
                fill="none" stroke="currentColor" stroke-width="5"
                stroke-linecap="round" stroke-linejoin="round"
                role="img" aria-label="Menú">

                {{-- Perilla --}}
                <circle cx="150" cy="80" r="10" fill="currentColor" fill-opacity=".15" />

                {{-- Campana --}}
                <path d="M50 184 A100 94 0 0 1 250 184 Z" fill="currentColor" fill-opacity=".08" />
                <path d="M84 156 C90 132 106 116 130 108" stroke-width="4" opacity=".5" />

                {{-- Borde y plato --}}
                <rect x="34" y="184" width="232" height="14" rx="7" fill="currentColor" fill-opacity=".12" />
                <path d="M64 214 H236" stroke-width="4" opacity=".6" />

                {{-- Destellos --}}
                <g stroke-width="3.5" opacity=".7">
                    <path d="M262 92 v14 M255 99 h14" />
                    <path d="M38 112 v10 M33 117 h10" />
                    <g stroke-width="3.5" opacity=".9" stroke="#e8452c"></g>
                </g>
            </svg>
        </div>
    </div>

</section>

@endsection