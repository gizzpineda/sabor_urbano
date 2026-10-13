<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Muestra la vista del menú con las listas de platos y bebidas (8 platos y 8 bebidas).
     */
    public function index()
    {
        // Lista de platos (8 platos exactos: 2 filas de 4 en escritorio)
        $platos = [
            [
                'nombre' => 'Hamburguesa clásica',
                'categoria' => 'Hamburguesas',
                'descripcion' => 'Carne vacuna seleccionada, lechuga fresca, tomate y salsa especial de la casa en pan artesanal.',
                'precio' => 28000,
                'icono' => 'hamburguesa',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Hamburguesa doble con queso',
                'categoria' => 'Hamburguesas',
                'descripcion' => 'Doble medallón de carne, abundante queso cheddar fundido y toque ahumado especial.',
                'precio' => 38000,
                'icono' => 'hamburguesa',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Pizza muzzarella (8 porciones)',
                'categoria' => 'Pizzas',
                'descripcion' => 'Salsa de tomate casera, generosa capa de muzzarella gratinada, orégano y aceitunas.',
                'precio' => 55000,
                'icono' => 'pizza',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Pizza calabresa (8 porciones)',
                'categoria' => 'Pizzas',
                'descripcion' => 'Muzzarella fundida, rodajas de calabresa seleccionada y cebolla caramelizada suave.',
                'precio' => 65000,
                'icono' => 'pizza',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Lomito completo',
                'categoria' => 'Lomitos',
                'descripcion' => 'Corte tierno de bife de lomo, jamón, queso, huevo a la plancha, lechuga y tomate en pan casero.',
                'precio' => 35000,
                'icono' => 'lomito',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Sandwich de milanesa',
                'categoria' => 'Sandwiches',
                'descripcion' => 'Milanesa crujiente de carne, lechuga fresca, rodajas de tomate y mayonesa casera en pan baguette.',
                'precio' => 25000,
                'icono' => 'sandwich',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Empanadas de carne (unidad)',
                'categoria' => 'Empanadas',
                'descripcion' => 'Relleno jugoso de carne cortada a cuchillo, huevo duro, cebollita de verdeo y masa crocante.',
                'precio' => 6000,
                'icono' => 'empanada',
                'presentacion' => null,
                'marca' => null,
            ],
            [
                'nombre' => 'Empanadas de jamón y queso (unidad)',
                'categoria' => 'Empanadas',
                'descripcion' => 'Clásica combinación de jamón cocido y muzzarella derretida en masa dorada al horno.',
                'precio' => 6000,
                'icono' => 'empanada',
                'presentacion' => null,
                'marca' => null,
            ],
        ];

        // Lista de bebidas (8 bebidas exactas: 4 gaseosas y 4 cervezas)
        $bebidas = [
            [
                'nombre' => 'Coca-Cola',
                'categoria' => 'Gaseosas',
                'descripcion' => 'Gaseosa clásica con gas, servida bien fría.',
                'precio' => 8000,
                'presentacion' => 'Lata 350 ml',
                'marca' => 'Coca-Cola',
                'icono' => 'gaseosa',
            ],
            [
                'nombre' => 'Coca-Cola',
                'categoria' => 'Gaseosas',
                'descripcion' => 'Formato familiar para compartir con tus platos.',
                'precio' => 15000,
                'presentacion' => 'Botella 1,5 L',
                'marca' => 'Coca-Cola',
                'icono' => 'gaseosa',
            ],
            [
                'nombre' => 'Pepsi',
                'categoria' => 'Gaseosas',
                'descripcion' => 'Sabor refrescante inconfundible.',
                'precio' => 7000,
                'presentacion' => 'Lata 350 ml',
                'marca' => 'Pepsi',
                'icono' => 'gaseosa',
            ],
            [
                'nombre' => 'Guaraná Antarctica',
                'categoria' => 'Gaseosas',
                'descripcion' => 'Auténtico sabor a guaraná de la Amazonía.',
                'precio' => 7000,
                'presentacion' => 'Lata 350 ml',
                'marca' => 'Guaraná Antarctica',
                'icono' => 'gaseosa',
            ],
            [
                'nombre' => 'Pilsen',
                'categoria' => 'Cervezas',
                'descripcion' => 'Cerveza paraguaya tradicional, rubia y liviana.',
                'precio' => 12000,
                'presentacion' => 'Lata 473 ml',
                'marca' => 'Pilsen',
                'icono' => 'cerveza',
            ],
            [
                'nombre' => 'Pilsen',
                'categoria' => 'Cervezas',
                'descripcion' => 'Botella de 1 litro servida a punto de nieve.',
                'precio' => 20000,
                'presentacion' => 'Botella 1 L',
                'marca' => 'Pilsen',
                'icono' => 'cerveza',
            ],
            [
                'nombre' => 'Brahma',
                'categoria' => 'Cervezas',
                'descripcion' => 'Chopp en lata con la cremosidad y suavidad justa.',
                'precio' => 12000,
                'presentacion' => 'Lata 473 ml',
                'marca' => 'Brahma',
                'icono' => 'cerveza',
            ],
            [
                'nombre' => 'Heineken',
                'categoria' => 'Cervezas',
                'descripcion' => 'Lager premium de pura malta con amargor equilibrado.',
                'precio' => 17000,
                'presentacion' => 'Lata 473 ml',
                'marca' => 'Heineken',
                'icono' => 'cerveza',
            ],
        ];

        return view('menu', compact('platos', 'bebidas'));
    }
}
