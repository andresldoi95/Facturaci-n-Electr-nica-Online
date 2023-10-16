<?php

namespace App\Models\Comprobantes;

use App\Models\General\Establecimiento;
use App\Models\General\TipoComprobante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoEmision extends Model
{
    use HasFactory;
    protected $table = 'comp_puntos_emision';
    protected $fillable = [
        'establecimiento_id',
        'tipo_comprobante_id',
        'nombre',
        'codigo_emisor',
        'numero_inicial',
        'electronico'
    ];
    public function establecimiento() {
        return $this->belongsTo(Establecimiento::class);
    }
    public function scopeEsElectronico($query) {
        return $query->where('electronico', true);
    }
    public function tipoComprobante() {
        return $this->belongsTo(TipoComprobante::class);
    }
}
