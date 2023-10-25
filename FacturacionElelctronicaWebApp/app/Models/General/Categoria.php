<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gen_categorias';
    protected $fillable = [
        'nombre'
    ];
    public function items() {
        return $this->hasMany(Item::class);
    }
}
