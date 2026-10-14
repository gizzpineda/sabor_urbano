<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Admin\PedidoController as AdminPedidoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegistration'])->name('registro');
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pedidos/continuar', function () {
    session()->put('url.intended', route('menu'));
    return redirect()->route('login')->with('status', 'Inicia sesión para enviar tu pedido.');
})->name('pedidos.login');
Route::post('/pedidos', [PedidoController::class, 'store'])->middleware('auth')->name('pedidos.store');
Route::get('/mis-pedidos', [PedidoController::class, 'index'])->middleware('auth')->name('pedidos.index');

Route::middleware(['auth', 'admin'])->prefix('admin/pedidos')->name('admin.pedidos.')->group(function () {
    Route::get('/', [AdminPedidoController::class, 'index'])->name('index');
    Route::patch('/{pedido}/entregar', [AdminPedidoController::class, 'deliver'])->name('deliver');
});

Route::prefix('admin/productos')->name('admin.productos.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('index');
    Route::get('/crear', [ProductoController::class, 'create'])->name('create');
    Route::post('/', [ProductoController::class, 'store'])->name('store');
    Route::get('/{producto}/editar', [ProductoController::class, 'edit'])->name('edit');
    Route::put('/{producto}', [ProductoController::class, 'update'])->name('update');
    Route::patch('/{producto}/stock', [ProductoController::class, 'updateStock'])->name('stock');
    Route::patch('/{producto}/estado', [ProductoController::class, 'toggleActive'])->name('toggle');
});

