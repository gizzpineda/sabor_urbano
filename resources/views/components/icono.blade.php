@props([
    'name' => '',
    'class' => 'h-7 w-7 text-brand-gold',
])

@php
    $normalizedName = strtolower(trim($name));
@endphp

<svg {{ $attributes->merge(['class' => $class]) }}
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.8"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true">
    @switch($normalizedName)
        {{-- Hamburguesa: pan curvo superior con semillas, lechuga, medallón y pan inferior --}}
        @case('hamburguesa')
            <path d="M4 11c0-3.8 3.5-7 8-7s8 3.2 8 7H4z" />
            <path d="M9 7.5h.01M12 6h.01M15 7.5h.01" stroke-width="2.2" />
            <path d="M3.5 13.5c1-.6 2-.6 3 0s2 .6 3 0 2-.6 3 0 2 .6 3 0 2-.6 3 0" />
            <rect x="3.5" y="15" width="17" height="2.5" rx="1.2" />
            <path d="M4.5 18.5a2.5 2.5 0 0 0 2.5 2.5h10a2.5 2.5 0 0 0 2.5-2.5H4.5z" />
            @break

        {{-- Pizza: porción triangular con corteza superior, orilla y pepperoni --}}
        @case('pizza')
            <path d="M4 5c5-2 11-2 16 0" />
            <path d="M4 5l8 16 8-16" />
            <circle cx="12" cy="10" r="1.5" />
            <circle cx="9.5" cy="14" r="1.2" />
            <circle cx="14.5" cy="13.5" r="1.2" />
            @break

        {{-- Lomito: pan alargado artesanal con cortes inclinados y relleno visible --}}
        @case('lomito')
            <path d="M2 11c0-3 3.5-5 10-5s10 2 10 5H2z" />
            <path d="M6.5 8.5l1.5-1.5M11.5 8.5l1.5-1.5M16.5 8.5l1.5-1.5" />
            <path d="M1.5 13.5c1.2-.6 2.3-.6 3.5 0s2.3.6 3.5 0 2.3-.6 3.5 0 2.3.6 3.5 0 2.3-.6 3.5 0 2.3.6 3.5 0" />
            <path d="M2 15h20" />
            <path d="M2.5 17c0 2 3.5 3 9.5 3s9.5-1 9.5-3H2.5z" />
            @break

        {{-- Sandwich: corte triangular tostado con capas de relleno --}}
        @case('sandwich')
            <path d="M3 18.5V7a1.5 1.5 0 0 1 2.3-1.3L19.5 13.5a1.5 1.5 0 0 1 .5 1.3V18.5a1.5 1.5 0 0 1-1.5 1.5h-14A1.5 1.5 0 0 1 3 18.5z" />
            <path d="M3 12.5l16.5 6.5" />
            <path d="M8 10l2 2M12 12l2 2" />
            @break

        {{-- Empanada: forma de medialuna con repulgue característico en la curva --}}
        @case('empanada')
            <path d="M3 16.5h18" />
            <path d="M3 16.5C3 8.5 21 8.5 21 16.5" />
            <path d="M4.5 14c.7-.7 1.6-.3 2 .3" />
            <path d="M7.8 11.2c.8-.7 1.7-.3 2.1.4" />
            <path d="M11.5 9.8c.8-.7 1.7-.3 2.1.4" />
            <path d="M15.2 11.2c.8-.7 1.7-.3 2.1.4" />
            <path d="M18.5 14c.6-.7 1.5-.3 1.8.3" />
            @break

        {{-- Gaseosa: lata cilíndrica con anilla abridora superior y ondas de burbujas --}}
        @case('gaseosa')
            <rect x="6.5" y="4.5" width="11" height="15.5" rx="2.5" />
            <path d="M7 6.5h10" />
            <path d="M10 4.5V2.5h4v2" />
            <circle cx="12" cy="3.3" r="0.6" fill="currentColor" />
            <path d="M7 11.5c2.5-1.5 4.5 1.5 7 0s2-1 3 0" />
            <path d="M8 18h8" />
            @break

        {{-- Cerveza: chopp/jarra espumante con asa lateral y espuma --}}
        @case('cerveza')
            <path d="M6 9v9.5a2.5 2.5 0 0 0 2.5 2.5h7a2.5 2.5 0 0 0 2.5-2.5V9" />
            <path d="M18 11h2a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-2" />
            <path d="M5.5 9a2 2 0 0 1 2-2 2.5 2.5 0 0 1 4.5-1 2.5 2.5 0 0 1 4.5 1 2 2 0 0 1 2 2H5.5z" />
            <path d="M10 12.5v5M14 12.5v5" />
            @break

        {{-- Fallback: icono de campana/menú gastronómico elegante --}}
        @default
            <path d="M12 3a2 2 0 0 0-2 2h4a2 2 0 0 0-2-2z" />
            <path d="M4 14a8 8 0 0 1 16 0H4z" />
            <rect x="3" y="16" width="18" height="2" rx="1" />
            <path d="M6 20h12" />
    @endswitch
</svg>
