<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    use HasFactory;
    protected $table = 'gen_tipos_comprobante';
    protected $fillable = [
        'codigo_institucion',
        'nombre',
        'descripcion',
        'active'
    ];
    public function escopeIsActive($query) {
        return $query->where('active', true);
    }
}
