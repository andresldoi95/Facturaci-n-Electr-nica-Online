<?php

namespace App\Models\Comprobantes;

use App\Models\General\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComprobante extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'comp_detalles_comprobantes';

    protected $fillable = [
        'id',
        'comprobante_id',
        'item_id',
        'cantidad',
        'precio'
    ];

    public function comprobante() {
        return $this->belongsTo(Comprobante::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
