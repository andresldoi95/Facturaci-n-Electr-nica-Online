<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gen_items';

    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'codigo',
        'nombre',
        'descripcion',
        'precio'
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
