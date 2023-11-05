<?php

namespace App\Models\Comprobantes;

use App\Models\General\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comprobante extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'comp_comprobantes';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'punto_emision_id',
        'numero_documento',
        'fecha_emision',
        'cliente_id',
        'subtotal_si',
        'descuento_total',
        'subtotal',
        'impuestos',
        'total'
    ];
    public function puntoEmision() {
        return $this->belongsTo(PuntoEmision::class);
    }
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
    public function detalles() {
        return $this->hasMany(DetalleComprobante::class);
    }
    public function informacionAdicional() {
        return $this->hasMany(InformacionAdicional::class);
    }
    public function impuestos() {
        return $this->hasMany(ImpuestoComprobante::class);
    }
    public $incrementing = false;
}
