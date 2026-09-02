<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;        

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
