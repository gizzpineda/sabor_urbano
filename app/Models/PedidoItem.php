<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['pedido_id', 'producto_id', 'nombre', 'precio_unitario', 'cantidad', 'subtotal'];

    protected function casts(): array
    {
        return [
            'precio_unitario' => 'integer',
            'cantidad' => 'integer',
            'subtotal' => 'integer',
        ];
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
