<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $esPlato = fake()->boolean(60);
        $categoria = $esPlato ? 'plato' : 'bebida';

        $subcategoriasPlatos = ['hamburguesas', 'pizzas', 'lomitos', 'sandwiches', 'empanadas'];
        $subcategoriasBebidas = ['gaseosas', 'cervezas'];

        $subcategoria = $esPlato
            ? fake()->randomElement($subcategoriasPlatos)
            : fake()->randomElement($subcategoriasBebidas);

        $iconoPorDefecto = match ($subcategoria) {
            'hamburguesas' => 'hamburguesa',
            'pizzas' => 'pizza',
            'lomitos' => 'lomito',
            'sandwiches' => 'sandwich',
            'empanadas' => 'empanada',
            'gaseosas' => 'gaseosa',
            'cervezas' => 'cerveza',
            default => 'hamburguesa',
        };

        return [
            'nombre' => fake()->words(2, true),
            'categoria' => $categoria,
            'subcategoria' => $subcategoria,
            'descripcion' => fake()->sentence(),
            'precio' => fake()->numberBetween(6, 65) * 1000,
            'presentacion' => $esPlato ? null : fake()->randomElement(['Lata 350 ml', 'Botella 1,5 L', 'Lata 473 ml', 'Botella 1 L']),
            'marca' => $esPlato ? null : fake()->randomElement(['Coca-Cola', 'Pepsi', 'Pilsen', 'Brahma', 'Heineken']),
            'icono' => $iconoPorDefecto,
            'stock' => fake()->numberBetween(10, 50),
            'activo' => true,
        ];
    }
}
