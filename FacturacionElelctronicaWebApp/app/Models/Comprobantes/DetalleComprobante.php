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
        'precio',
        'porcentaje_descuento',
        'subtotal_si',
        'descuento_total',
        'subtotal',
        'impuestos',
        'total'
    ];

    public function comprobante() {
        return $this->belongsTo(Comprobante::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
    public function informacionAdicional() {
        return $this->hasMany(InformacionAdicionalItem::class, 'detalle_id');
    }

    public function impuestos() {
        return $this->hasMany(ImpuestoDetalleComprobante::class, 'detalle_id');
    }
}
