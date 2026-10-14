<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sabor Urbano')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=anton:400|poppins:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-page flex min-h-dvh flex-col font-body text-stone-200 antialiased @yield('body-class', '')">

    <header class="border-b border-brand-gold/20 bg-black/40 backdrop-blur">
        {{-- Franja dorada --}}
        <div class="h-1 bg-linear-to-r from-transparent via-brand-gold to-transparent"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-4">
            <a href="/" class="block text-center leading-none drop-shadow-[0_0_18px_rgba(193,154,33,0.3)]">
                <span class="font-display text-5xl uppercase tracking-wide text-white md:text-7xl">
                    Sabor
                    <span class="bg-linear-to-b from-[#f3d27a] to-brand-gold bg-clip-text text-transparent">Urbano</span>
                </span>
            </a>

            {{-- Adorno --}}
            <div class="mt-2 flex items-center justify-center gap-3" aria-hidden="true">
                <span class="h-px w-16 bg-linear-to-r from-transparent to-brand-gold md:w-40"></span>
                <svg class="h-6 w-6 text-brand-gold" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 14 C5 6 27 6 27 14 Z" />
                    <path d="M4 18 q2.5 -3 5 0 t5 0 t5 0 t5 0 t5 0" />
                    <path d="M5 23 H27 V25 Q27 28 24 28 H8 Q5 28 5 25 Z" />
                </svg>
                <span class="h-px w-16 bg-linear-to-l from-transparent to-brand-gold md:w-40"></span>
            </div>

            {{-- Mi cuenta --}}
            @auth
                <div class="mx-auto mt-4 flex w-fit items-center gap-3 md:absolute md:right-4 md:top-1/2 md:mx-0 md:mt-0 md:-translate-y-1/2">
                    <span class="text-sm font-medium text-stone-200">{{ Auth::user()->name }}</span>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.productos') }}" class="text-sm font-medium text-brand-gold transition hover:text-amber-200">Panel de productos</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-brand-gold px-5 py-2 text-sm font-medium uppercase tracking-wider text-brand-gold transition hover:bg-brand-gold hover:text-brand-black">Cerrar sesión</button>
                    </form>
                </div>
            @else
            <a href="{{ route('login') }}" class="mx-auto mt-4 flex w-fit items-center gap-2 rounded-full border border-brand-gold px-5 py-2 text-sm font-medium uppercase tracking-wider text-brand-gold transition hover:bg-brand-gold hover:text-brand-black md:absolute md:right-4 md:top-1/2 md:mx-0 md:mt-0 md:-translate-y-1/2">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mi cuenta
            </a>
            @endauth
        </div>
    </header>

    <main class="mx-auto flex w-full max-w-6xl flex-1 px-4 py-6 @yield('main-class', 'items-center')">
        @yield('content')
    </main>

    <footer class="border-t border-brand-gold/20 bg-black/40">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-4">
            <p class="text-xs text-stone-400">&copy; {{ date('Y') }} Sabor Urbano. Todos los derechos reservados.</p>

            <div class="flex items-center gap-3">
                <span class="hidden text-xs uppercase tracking-widest text-stone-500 sm:block">Síguenos</span>

                {{-- Facebook --}}
                <a href="#" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook"
                    class="flex h-9 w-9 items-center justify-center rounded-full border border-brand-gold/40 text-brand-gold transition hover:-translate-y-0.5 hover:bg-brand-gold hover:text-brand-black">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>

                {{-- Instagram --}}
                <a href="#" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram"
                    class="flex h-9 w-9 items-center justify-center rounded-full border border-brand-gold/40 text-brand-gold transition hover:-translate-y-0.5 hover:bg-brand-gold hover:text-brand-black">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>

                {{-- TikTok --}}
                <a href="#" target="_blank" rel="noopener" aria-label="TikTok" title="TikTok"
                    class="flex h-9 w-9 items-center justify-center rounded-full border border-brand-gold/40 text-brand-gold transition hover:-translate-y-0.5 hover:bg-brand-gold hover:text-brand-black">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 3v11.5A4.5 4.5 0 1 1 11.5 10" />
                        <path d="M16 3c.4 2.8 2.2 4.6 5 5" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>
