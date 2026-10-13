<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('categoria'); // plato o bebida
            $table->string('subcategoria'); // hamburguesas, pizzas, lomitos, sandwiches, empanadas, gaseosas, cervezas
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('precio'); // en guaraníes
            $table->string('presentacion')->nullable();
            $table->string('marca')->nullable();
            $table->string('icono');
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
