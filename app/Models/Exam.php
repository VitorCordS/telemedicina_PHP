<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    use HasFactory;

    // Função que retorna o que pertence ao model Type (muitos Exames pertencem a um Tipo)
    public function type() {
        return $this->belongsTo(Type::class);
    }
    
}
