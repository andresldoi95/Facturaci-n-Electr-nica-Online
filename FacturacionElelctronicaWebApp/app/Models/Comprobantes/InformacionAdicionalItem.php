<?php

namespace App\Models\Comprobantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionAdicionalItem extends Model
{
    use HasFactory;
    protected $table = 'comp_informacion_adicional_items';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'detalle_id',
        'clave',
        'mostrar',
        'enviar'
    ];
    public function scopeMostrable($query) {
        return $query->where('mostrar', true);
    }
    public function scopeEnviable($query) {
        return $query->where('enviar', true);
    }
    public function comprobante() {
        return $this->belongsTo(DetalleComprobante::class);
    }
}
