@extends('layouts.app')

@section('title', 'Inicio')
@section('body-class', 'lg:h-dvh lg:overflow-hidden')

@section('content')

<section class="relative grid w-full items-center gap-8 md:grid-cols-2">

    {{-- Manchas de degradado radial dorado difusas (fondo elegante sin saturar) --}}
    <div class="pointer-events-none absolute -top-24 -left-20 h-72 w-72 rounded-full bg-brand-gold/10 blur-[90px] md:h-96 md:w-96" aria-hidden="true"></div>
    <div class="pointer-events-none absolute top-1/2 -right-20 h-80 w-80 -translate-y-1/2 rounded-full bg-brand-gold/15 blur-[100px] md:h-[28rem] md:w-[28rem]" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-16 left-1/3 h-64 w-64 rounded-full bg-brand-gold/8 blur-[85px]" aria-hidden="true"></div>

    {{-- Texto y botones (lado izquierdo) --}}
    <div class="relative z-10">
        <span class="inline-flex items-center gap-2 rounded-full border border-brand-gold/40 bg-brand-gold/10 px-4 py-1 text-xs font-medium uppercase tracking-widest text-brand-gold">
            <span class="h-2 w-2 animate-pulse rounded-full bg-brand-gold shadow-[0_0_8px_rgba(193,154,33,0.8)]"></span> Comida urbana
        </span>

        <h1 class="mt-5 font-display text-4xl uppercase leading-[0.95] tracking-wide text-white sm:text-5xl md:text-6xl lg:text-[4.75rem]">
            Calidad, sabor y <span class="bg-linear-to-b from-[#fae59f] via-brand-gold to-[#8f6d0f] bg-clip-text text-transparent drop-shadow-[0_0_22px_rgba(193,154,33,0.35)]">rapidez</span>
        </h1>

        <p class="mt-5 max-w-md text-stone-300">
            Elige tu plato favorito, haz tu pedido en pocos pasos y recíbelo donde estés.
        </p>

        <div class="mt-7 flex flex-wrap items-center gap-4">
            <a href="#" class="group inline-flex items-center gap-2 rounded-full bg-linear-to-b from-[#f3d27a] to-brand-gold px-8 py-3.5 text-sm font-semibold uppercase tracking-wider text-brand-black shadow-[0_10px_30px_-8px_rgba(193,154,33,0.9),inset_0_1px_0_rgba(255,255,255,0.5)] transition-all duration-300 hover:-translate-y-0.5 hover:scale-[1.02] hover:brightness-110 hover:shadow-[0_0_35px_rgba(193,154,33,0.7),0_10px_30px_-8px_rgba(193,154,33,0.9)]">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                Hacer pedido
                <span class="transition group-hover:translate-x-1">→</span>
            </a>

            <a href="{{ route('menu') }}" class="inline-flex items-center rounded-full border border-white/25 px-8 py-3.5 text-sm font-semibold uppercase tracking-wider text-stone-200 transition-all duration-300 hover:border-brand-gold hover:text-brand-gold hover:bg-brand-gold/5">
                Ver menú
            </a>
        </div>
    </div>

    {{-- Ilustración central con cloche y 6 iconos orbitantes (lado derecho) --}}
    <div class="relative flex items-center justify-center py-6 md:py-0">

        {{-- Resplandor dorado suave que pulsa detrás del conjunto --}}
        <div class="animate-pulse-glow absolute h-64 w-64 rounded-full bg-brand-gold/20 blur-3xl md:h-80 md:w-80 lg:h-96 lg:w-96" aria-hidden="true"></div>

        {{-- Anillo concéntrico interior estático --}}
        <div class="absolute h-56 w-56 rounded-full border border-brand-gold/15 sm:h-64 sm:w-64 md:h-80 md:w-80 lg:h-[min(24rem,52vh)] lg:w-[min(24rem,52vh)]" aria-hidden="true"></div>

        {{-- Anillo concéntrico exterior girando muy lento (35 s) --}}
        <div class="animate-spin-slow absolute h-72 w-72 rounded-full border border-dashed border-brand-gold/30 sm:h-80 sm:w-80 md:h-[22rem] md:w-[22rem] lg:h-[min(29rem,64vh)] lg:w-[min(29rem,64vh)]" aria-hidden="true">
            {{-- Puntos brillantes decorativos sobre la órbita --}}
            <span class="absolute -top-1 left-1/2 h-2 w-2 -translate-x-1/2 rounded-full bg-brand-gold shadow-[0_0_8px_rgba(193,154,33,0.8)]"></span>
            <span class="absolute -bottom-1 left-1/2 h-2 w-2 -translate-x-1/2 rounded-full bg-brand-gold/70"></span>
            <span class="absolute top-1/2 -left-1 h-1.5 w-1.5 -translate-y-1/2 rounded-full bg-brand-gold/70"></span>
            <span class="absolute top-1/2 -right-1 h-1.5 w-1.5 -translate-y-1/2 rounded-full bg-brand-gold/70"></span>
        </div>

        {{-- 6 Iconos lineales dorados orbitantes con flotación desfasada --}}
        <div class="pointer-events-none absolute h-72 w-72 sm:h-80 sm:w-80 md:h-[22rem] md:w-[22rem] lg:h-[min(29rem,64vh)] lg:w-[min(29rem,64vh)]" aria-hidden="true">
            {{-- 1. Hamburguesa (Arriba - 12h) --}}
            <div class="animate-float-gentle absolute -top-4 left-1/2 -translate-x-1/2" style="animation-delay: 0s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="hamburguesa" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>

            {{-- 2. Pizza (Arriba derecha - 2h) --}}
            <div class="animate-float-gentle absolute top-[12%] right-[4%] sm:right-[6%]" style="animation-delay: 0.7s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="pizza" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>

            {{-- 3. Lomito (Abajo derecha - 4h) --}}
            <div class="animate-float-gentle absolute bottom-[12%] right-[4%] sm:right-[6%]" style="animation-delay: 1.4s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="lomito" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>

            {{-- 4. Empanada (Abajo - 6h) --}}
            <div class="animate-float-gentle absolute -bottom-4 left-1/2 -translate-x-1/2" style="animation-delay: 2.1s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="empanada" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>

            {{-- 5. Sandwich (Abajo izquierda - 8h) --}}
            <div class="animate-float-gentle absolute bottom-[12%] left-[4%] sm:left-[6%]" style="animation-delay: 2.8s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="sandwich" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>

            {{-- 6. Bebida / Gaseosa (Arriba izquierda - 10h) --}}
            <div class="animate-float-gentle absolute top-[12%] left-[4%] sm:left-[6%]" style="animation-delay: 3.5s;">
                <div class="flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full border border-brand-gold/40 bg-brand-black/90 text-brand-gold shadow-[0_0_15px_rgba(193,154,33,0.3)] backdrop-blur">
                    <x-icono name="gaseosa" class="h-4 w-4 sm:h-5 sm:w-5" />
                </div>
            </div>
        </div>

        {{-- Círculo dorado central con la cloche gastronómica --}}
        <div class="animate-float relative z-10 flex h-48 w-48 items-center justify-center rounded-full border-4 border-brand-gold bg-linear-to-br from-brand-gray to-brand-black shadow-[0_0_60px_rgba(193,154,33,0.4)] sm:h-56 sm:w-56 md:h-64 md:w-64 lg:h-[min(19rem,42vh)] lg:w-[min(19rem,42vh)]">
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

                {{-- Destellos dorados --}}
                <g stroke-width="3.5" opacity=".7">
                    <path d="M262 92 v14 M255 99 h14" />
                    <path d="M38 112 v10 M33 117 h10" />
                </g>
            </svg>
        </div>
    </div>

</section>

@endsection