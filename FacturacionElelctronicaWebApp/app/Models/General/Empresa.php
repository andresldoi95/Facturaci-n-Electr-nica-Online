<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gen_empresas';
    protected $fillable = [
        'nombre_comercial',
        'razon_social',
        'numero_identificacion'
    ];
}
