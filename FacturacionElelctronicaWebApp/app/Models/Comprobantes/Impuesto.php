<?php

namespace App\Models\Comprobantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;
    protected $table = 'comp_impuestos';
    protected $fillable = [
        'codigo_institucion',
        'nombre',
        'descripcion',
        'active'
    ];
    public function scopeIsActive($query) {
        return $query->where('active', true);
    }
}
