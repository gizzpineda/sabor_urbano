<?php

namespace App\Models;

use Database\Factories\ProductoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<ProductoFactory> */
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * Atributos asignables en masa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'categoria',
        'subcategoria',
        'descripcion',
        'precio',
        'presentacion',
        'marca',
        'icono',
        'stock',
        'activo',
    ];

    /**
     * Casts de atributos para tipos de datos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'precio' => 'integer',
            'stock' => 'integer',
            'activo' => 'boolean',
        ];
    }

    /**
     * Scope para filtrar productos activos.
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
