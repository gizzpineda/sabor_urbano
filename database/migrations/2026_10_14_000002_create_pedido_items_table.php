<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();
            $table->foreignId('producto_id')->constrained('productos')->restrictOnDelete();
            $table->string('nombre');
            $table->unsignedInteger('precio_unitario');
            $table->unsignedInteger('cantidad');
            $table->unsignedInteger('subtotal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_items');
    }
};
