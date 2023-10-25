<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gen_clientes';
    protected $fillable = [
        'tipo_identificacion_id',
        'numero_identificacion',
        'nombre_razon_social',
        'nombre_comercial',
        'direccion',
        'observacion'
    ];
    public function tipoIdentificacion() {
        return $this->belongsTo(TipoIdentificacion::class);
    }
    public function correos() {
        return $this->hasMany(CorreoCliente::class, 'cliente_id');
    }
}
