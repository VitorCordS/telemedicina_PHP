<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model da tabela Types - Manipula os dados da tabela type (DML - Data Manipulation Language)

// Classe Type puxa tudo o que for do modelo (model), para funcionar as funções do Laravel
class Type extends Model
{

    // Irá trasnformar as colunas e atributos para serem usados na manipulação
    use HasFactory;

    // Relacionando o model Type com a tabela types do banco de dados
    protected $table = 'types';

    // Função que retorna o que pertence a tabela Exam (um Tipo tem muitos Exames)
    public function exams() : HasMany {
        return $this->hasMany(Exam::class);
    }

}
