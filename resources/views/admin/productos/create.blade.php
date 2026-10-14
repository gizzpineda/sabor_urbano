@extends('layouts.app')

@section('title', 'Nuevo producto | Sabor Urbano')
@section('main-class', 'items-start')

@section('content')
    <section class="mx-auto w-full max-w-3xl space-y-5">
        <div>
            <a href="{{ route('admin.productos.index') }}" class="text-sm text-brand-gold hover:text-amber-200">← Volver a productos</a>
            <h1 class="mt-3 font-display text-4xl uppercase text-white">Nuevo producto</h1>
        </div>
        @include('admin.productos._form')
    </section>
@endsection
