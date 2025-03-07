<?php

namespace App\Http\Controllers;

use App\Models\Exam; // Importando o model Exam para manipulação de dados
use App\Models\Type; // Importando o model Type para manipulação de dados
use Illuminate\Http\Request; 

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Seleciona todos os "exames" junto com todos os "tipos" e armazena no array $exams
        // Funciona como um INNER JOIN
        $exams = Exam::with('type')->get();

        // Retorna a view list com o array $exams com o nome de 'exams'
        return view('exams/list', ['exams' => $exams]);
    }

    /**
     * Função que mostra os exames na tela Home junto com o gráfico
     */
    public function indexHome() 
    {
        // Seleciona os exames e os envia para a tela home
        $exams = Exam::with('type')->get();

        // Extrai da variável de exams apenas o mês (date) para usar no gráfico
        $dates = $exams->pluck('date');

        // Extrai da variável de exams apenas o valor (value) para usar no gráfico
        $values = $exams->pluck('value');

        // Retorna a tela home com os exames cadastrados, as datas e os valores separados
        return view('dashboard/home', ["exams" => $exams, "dates" => $dates, "values" => $values]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Buscar os tipos no BD
        $types = Type::all();

        // Retornar o form com os dados
        return view('exams/form', ["types" => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Criando um objeto para o model Exam
        $exam = new Exam();

        // Atributos da classe Exam
        $exam->type_id = $request->type_id; // O atributo type_id da tabela Exam é igual ao que veio da requisição com o nome de "type_id"
        $exam->date = $request->date;
        $exam->value = $request->value;
        $exam->note = $request->note;

        // Inserindo os dados no Banco de Dados com a função já pronta do Laravel
        $exam->save();

        // Buscar os tipos no BD
        $types = Type::all();

        // Renderizando a view novamente para aparecer o toast/popup de sucesso no cadastro
        return view('exams/form', ["success"=>true, "types" => $types]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o exame do Banco de Dados
        $exam = Exam::findOrFail($id);

        // Buscar os tipos no BD
        $types = Type::all();

        // Retorna a view form com os dados do exame encontrado no Banco de Dados, assim como todos os dados de tipos
        return view('exams/form', ["exam"=>$exam, "types"=>$types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Verificar se o exame existe
        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o exame do Banco de Dados
        $exam = Exam::findOrFail($request->id);

        // Se existir, alterar os dados
        // Atributos da classe Exam
        $exam->date = $request->date;
        $exam->value = $request->value;
        $exam->note = $request->note;

        // Editar os dados
        $exam->save();

        // Redirecionar para a página dos tipos e ver se o editar funcionou
        return redirect('/exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o tipo do Banco de Dados
        $exam = Exam::findOrFail($id);

        // Excluir o tipo do Banco de Dados
        $exam->delete();

        // Redirecionar para a página dos tipos
        return redirect('/exams');
    }
}
