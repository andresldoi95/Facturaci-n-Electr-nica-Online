<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoCliente extends Model
{
    use HasFactory;
    protected $table = 'gen_correos_clientes';
    protected $fillable = [
        'cliente_id',
        'email',
        'active'
    ];
    public function scopeIsActive($query) {
        return $query->where('active', true);
    }
}
