<?php

namespace App\Models\Comprobantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoDetalleComprobante extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'comp_impuestos_detalles_comprobantes';
    protected $fillable = [
        'id',
        'detalle_id',
        'tarifa_id',
        'base_imponible',
        'tarifa',
        'valor'
    ];
    public function detalle() {
        return $this->belongsTo(DetalleComprobante::class);
    }
    public function tarifa() {
        return $this->belongsTo(Tarifa::class);
    }
}
