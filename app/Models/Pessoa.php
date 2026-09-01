<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'tipo_atendimento',
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }




    
}
