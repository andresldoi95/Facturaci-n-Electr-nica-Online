<?php

namespace App\Models\Comprobantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoComprobante extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'comp_impuestos_comprobantes';
    protected $fillable = [
        'id',
        'comprobante_id',
        'tarifa_id',
        'base_imponible',
        'tarifa',
        'valor'
    ];
    public function comprobante() {
        return $this->belongsTo(Comprobante::class);
    }
    public function tarifa() {
        return $this->belongsTo(Tarifa::class);
    }
}
