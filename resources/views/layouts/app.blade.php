<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sabor Urbano')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=anton:400|poppins:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body data-cart-authenticated="{{ auth()->check() ? 'true' : 'false' }}" data-cart-submit-url="{{ route('pedidos.store') }}" data-cart-login-url="{{ route('pedidos.login') }}" class="bg-page flex min-h-dvh flex-col font-body text-stone-200 antialiased @yield('body-class', '')">

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

                {{-- Acceso al carrito y cuenta --}}
            <div class="mx-auto mt-4 flex w-fit items-center gap-2 xl:absolute xl:right-4 xl:top-1/2 xl:mt-0 xl:-translate-y-1/2">
                <button type="button" id="cart-open" aria-label="Abrir carrito" aria-controls="order-cart-drawer" aria-expanded="false" class="relative inline-flex h-10 w-10 items-center justify-center rounded-full border border-brand-gold/60 bg-black/40 text-brand-gold transition hover:bg-brand-gold hover:text-brand-black">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h2l2.2 10.2a2 2 0 0 0 2 1.6h7.6a2 2 0 0 0 1.9-1.4L21 8H6" /><circle cx="10" cy="20" r="1" /><circle cx="18" cy="20" r="1" /></svg>
                    <span id="cart-count" class="absolute -right-1 -top-1 inline-flex min-h-5 min-w-5 items-center justify-center rounded-full bg-brand-gold px-1 text-[10px] font-bold text-brand-black">0</span>
                </button>
                @auth
                    <details class="group relative w-fit">
                        <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-brand-gold px-5 py-2 text-sm font-medium uppercase tracking-wider text-brand-gold transition hover:bg-brand-gold hover:text-brand-black [&::-webkit-details-marker]:hidden">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
                            <span class="hidden lg:inline">{{ \Illuminate\Support\Str::before(Auth::user()->name, ' ') }}</span><span class="lg:hidden">Mi cuenta</span>
                            <svg class="h-3 w-3 transition group-open:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6" /></svg>
                        </summary>
                        <div class="absolute right-0 top-full z-50 mt-2 w-60 rounded-xl border border-brand-gold/30 bg-neutral-950 p-2 shadow-2xl shadow-black/60">
                            <div class="border-b border-white/10 px-3 pb-2 pt-1"><p class="truncate text-sm font-medium text-white">{{ Auth::user()->name }}</p><p class="text-xs uppercase tracking-widest text-brand-gold">{{ Auth::user()->isAdmin() ? 'Administrador' : 'Cliente' }}</p></div>
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.productos.index') }}" class="mt-2 block rounded-lg px-3 py-2 text-sm uppercase tracking-wider text-neutral-200 transition hover:bg-brand-gold/10 hover:text-brand-gold">Panel de productos</a>
                                <a href="{{ route('admin.pedidos.index') }}" class="block rounded-lg px-3 py-2 text-sm uppercase tracking-wider text-neutral-200 transition hover:bg-brand-gold/10 hover:text-brand-gold">Pedidos</a>
                            @else
                                <a href="{{ route('pedidos.index') }}" class="mt-2 block rounded-lg px-3 py-2 text-sm uppercase tracking-wider text-neutral-200 transition hover:bg-brand-gold/10 hover:text-brand-gold">Mis pedidos</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="mt-1 block w-full rounded-lg px-3 py-2 text-left text-sm uppercase tracking-wider text-neutral-200 transition hover:bg-brand-gold/10 hover:text-brand-gold">Cerrar sesión</button></form>
                        </div>
                    </details>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 rounded-full border border-brand-gold px-5 py-2 text-sm font-medium uppercase tracking-wider text-brand-gold transition hover:bg-brand-gold hover:text-brand-black"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>Mi cuenta</a>
                @endauth
            </div>
        </div>
    </header>


    <button type="button" id="cart-overlay" aria-label="Cerrar carrito" class="fixed inset-0 z-40 hidden bg-black/70 backdrop-blur-[2px]"></button>
    <aside id="order-cart-drawer" aria-hidden="true" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-brand-gold/30 bg-neutral-950 shadow-2xl shadow-black/60 transition-transform duration-300">
        <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
            <div><p class="text-xs uppercase tracking-[0.2em] text-brand-gold">Sabor Urbano</p><h2 class="font-display text-2xl uppercase tracking-wide text-white">Tu carrito</h2></div>
            <button type="button" id="cart-close" aria-label="Cerrar carrito" class="rounded-full border border-stone-700 p-2 text-stone-300 transition hover:border-brand-gold hover:text-brand-gold"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 6 12 12M18 6 6 18" /></svg></button>
        </div>
        <div id="cart-message" role="status" aria-live="polite" class="hidden mx-4 mt-4 rounded-lg border border-brand-gold/40 bg-brand-gold/10 px-3 py-2 text-sm text-amber-100"></div>
        <div id="cart-items" class="flex-1 space-y-3 overflow-y-auto px-4 py-4"></div>
        <p id="cart-empty" class="hidden px-5 py-10 text-center text-sm text-stone-400">Tu carrito está vacío.</p>
        <div class="space-y-4 border-t border-white/10 p-5">
            <label for="cart-note" class="block text-xs font-medium text-stone-300">Nota para el pedido <span class="text-stone-500">(opcional)</span></label>
            <textarea id="cart-note" rows="2" maxlength="2000" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-3 py-2 text-sm text-stone-100 outline-none transition placeholder:text-stone-500 focus:border-brand-gold focus:ring-1 focus:ring-brand-gold/40"></textarea>
            <div class="flex items-center justify-between text-sm"><span class="text-stone-400">Total</span><strong id="cart-total" class="font-display text-xl text-brand-gold">Gs. 0</strong></div>
            <div class="grid grid-cols-2 gap-3">
                <button type="button" id="cart-clear" class="rounded-lg border border-stone-700 px-3 py-3 text-sm font-medium text-stone-300 transition hover:border-brand-gold hover:text-brand-gold">Vaciar carrito</button>
                <button type="button" id="cart-submit" class="rounded-lg bg-brand-gold px-3 py-3 text-sm font-semibold text-brand-black transition hover:brightness-110 disabled:cursor-not-allowed disabled:opacity-50">Enviar pedido</button>
            </div>
        </div>
    </aside>
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
