<?php

namespace App\Models\Comprobantes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarifa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'comp_tarifas';
    protected $fillable = [
        'impuesto_id',
        'codigo_institucion',
        'nombre',
        'descripcion',
        'porcentaje'
    ];
    public function impuesto() {
        return $this->belongsTo(Impuesto::class);
    }
}
