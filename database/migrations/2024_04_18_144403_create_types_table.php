<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration - Cria a tabela do banco de dados, sua estrutura (DDL - Data Definition Language)
     * O Eloquent (criado pelo Symphony) irá pegar esse código e irá converter para SQL
     * É necessário iniciar as migrates toda vez quando estiver no PC da escola, para criar o banco de dados (php artisan migrate)
     * @return void
     */

    // Será a função que irá "subir/criar" as tabelas no banco de dados
    public function up()
    {
        // Criação da tabela types
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Exemplo de coluna/campo
            $table->text('description');
            $table->string('unit', 10); // O número representa o tamanho do dado
            $table->string('reference_value', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    // Será a função que irá "dropar/excluir" as tabelas no banco de dados
    public function down()
    {
        Schema::dropIfExists('types');
    }
};
