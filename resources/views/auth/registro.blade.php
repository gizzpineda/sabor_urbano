@extends('layouts.app')

@section('title', 'Crear cuenta | Sabor Urbano')

@section('content')
    <section class="mx-auto w-full max-w-md rounded-2xl border border-brand-gold/30 bg-stone-950/90 p-6 shadow-2xl shadow-black/40 sm:p-8">
        <h1 class="mb-2 text-center font-display text-3xl uppercase tracking-wide text-brand-gold">Crear cuenta</h1>
        <p class="mb-6 text-center text-sm text-stone-400">Regístrate para disfrutar de Sabor Urbano.</p>

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-700/50 bg-emerald-950/40 p-3 text-sm text-emerald-200">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-800/60 bg-red-950/40 p-3 text-sm text-red-200" role="alert">
                <ul class="list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registro') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="mb-1 block text-sm text-stone-300">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white outline-none focus:border-brand-gold" />
            </div>
            <div>
                <label for="email" class="mb-1 block text-sm text-stone-300">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white outline-none focus:border-brand-gold" />
            </div>
            <div>
                <label for="password" class="mb-1 block text-sm text-stone-300">Contraseña</label>
                <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white outline-none focus:border-brand-gold" />
            </div>
            <div>
                <label for="password_confirmation" class="mb-1 block text-sm text-stone-300">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password" class="w-full rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-white outline-none focus:border-brand-gold" />
            </div>
            <button type="submit" class="w-full rounded-lg bg-brand-gold px-4 py-3 font-semibold text-brand-black transition hover:brightness-110">Crear cuenta</button>
        </form>
        <p class="mt-6 text-center text-sm text-stone-400">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-brand-gold underline underline-offset-4 hover:text-amber-200">Inicia sesión</a></p>
    </section>
@endsection
