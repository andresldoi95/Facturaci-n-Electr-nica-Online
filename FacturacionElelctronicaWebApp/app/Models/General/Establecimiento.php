<?php

namespace App\Models\General;

use App\Models\Comprobantes\PuntoEmision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establecimiento extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gen_establecimientos';
    protected $fillable = [
        'empresa_id',
        'descripcion',
        'codigo_institucion',
        'direccion'
    ];
    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }
    public function puntosEmision() {
        return $this->hasMany(PuntoEmision::class);
    }
}
