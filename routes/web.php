<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TypeController; // É necessário importar o controller, se não o Laravel não sabe de onde vem a função
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// * Rotas protegidas por autenticação

Route::middleware('auth')->group(function () {

    // Rota Home
    Route::get('/', [ExamController::class, 'indexHome']);

    // * Rotas para o controller do form de Tipo

    // Rota por Get Form Tipo de Exame
    Route::get('/types/new', function () {
        return view('type/form');
    });

    // Rota Lista de Exames com um método que traz os valores da tabela através do index
    Route::get('/types', [TypeController::class, 'index']);

    // Rota por Post para cadastrar dados no Form Tipo de Exame
    Route::post('/types/new', [TypeController::class, 'store']);

    // Rota por Delete para excluir os tipos cadastrados ao clicar no botão, passando o ID para URL para excluir o tipo de tal id
    Route::delete('/types/{id}', [TypeController::class, 'destroy']);

    // Rota por Get para mostrar os dados nos inputs de um tipo já cadastrado para altera-los posteriomente com o método Put da rota abaixo
    Route::get('/types/{id}', [TypeController::class, 'edit']);

    // Rota por Put para editar os dados quando houver um ID no form
    Route::put('/types/{id}', [TypeController::class, 'update']);

    // * Rotas para o controller do form de Exames

    // Rota por Get para mostar o formulário para criação de um novo exame
    Route::get('/exams/new', [ExamController::class, 'create']);

    // Rota Lista de Exames com um método que traz os valores da tabela através do index
    Route::get('/exams', [ExamController::class, 'index']);

    // Rota por Post para cadastrar exames no Form Exame
    Route::post('/exams/new', [ExamController::class, 'store']);

    // Rota por Delete para excluir os exames cadastrados ao clicar no botão, passando o ID para URL para excluir o exame de tal id
    Route::delete('/exams/{id}', [ExamController::class, 'destroy']);

    // Rota por Get para mostrar os dados nos inputs de um exame já cadastrado para altera-los posteriomente com o método Put da rota abaixo
    Route::get('/exams/{id}', [ExamController::class, 'edit']);

    // Rota por Put para editar os dados quando houver um ID no form
    Route::put('/exams/{id}', [ExamController::class, 'update']);

});

// * Rotas de Autenticação - Abertas

// Rota por GET para acessar a tela de Registro
Route::get('/register', [AuthController::class, 'showFormRegister']);

// Rota por POST para registrar o usuário
Route::post('/register', [AuthController::class, 'register']);

// Rota por GET para acessar a tela de Login
Route::get('/login', [AuthController::class, 'showFormLogin']);

// Rota por POST para logar o usuário - Rota nomeada para usar na proteção de rotas
Route::post('/login', [AuthController::class, 'login'])->name('login');