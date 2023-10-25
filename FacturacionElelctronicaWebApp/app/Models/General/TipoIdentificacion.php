<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;
    protected $table = 'gen_tipos_identificacion';
    protected $fillable = [
        'codigo_institucion',
        'nombre',
        'descripcion',
        'identificacion_defecto',
        'active'
    ];
    public function scopeIsActive($query) {
        return $query->where('active', true);
    }
}
