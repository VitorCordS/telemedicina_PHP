<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Já vem automática importado o Request

use App\Models\Type; // Importando o model Type para manipulação de dados

// Classe TypeController irá puxar as informações de controller, para funcionar as funções do Laravel
class TypeController extends Controller
{

    // Controller - Para fazer o controle de dados entre tela e banco de dados, validar os dados, preparar os dados...
    
    /**
     * Função index - Realiza uma consulta no Banco de Dados e mostra na tela
     */
    public function index() {

        // Seleciona todos os "tipos" e armazena no array $types
        $types = Type::all();

        // Retorna a view list com o array $types com o nome de 'types'
        return view('type/list', ['types' => $types]);

    }

    /**
     * Função store - Armazena os valores no Banco de Dados
     * A variável $request é o programador que decide o nome, está request para ficar melhor a leitura
     */
    public function store(Request $request) {

        // Criando um objeto para o model Type
        $type = new Type();

        // Atributos da classe Type
        $type->name = $request->name; // O atributo name da tabela Type é igual ao que veio da requisição com o nome de "name"
        $type->unit = $request->unit;
        $type->reference_value = $request->reference_value;
        $type->description = $request->description;

        // Inserindo os dados no Banco de Dados com a função já pronta do Laravel
        $type->save();

        // Redirecionando o usuário para a própria página após salvar os dados
        // return redirect('/types/new');

        // Renderizando a view novamente para aparecer o toast/popup de sucesso no cadastro
        return view('type/form', ["success"=>true]);

    } // Fim da store

    /**
     * Função destroy - Excluir os valores no Banco de Dados
     * Irá apagar os dados de acordo com o ID
     */
    public function destroy($id) {

        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o tipo do Banco de Dados
        $type = Type::findOrFail($id);

        // Excluir o tipo do Banco de Dados
        $type->delete();

        // Redirecionar para a página dos tipos
        return redirect('/types');

    } // Fim do destroy

    /**
     * Função show - Mostra a tela para atualizar os dados do tipo já cadastrado com os dados preenchidos nas inputs
     */
    public function edit($id) {

        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o tipo do Banco de Dados
        $type = Type::findOrFail($id);

        // Retorna a view form com os dados do tipo encontrado no Banco de Dados
        return view('type/form', ["type"=>$type]);

    }

    /**
     * Função edit - Edita os dados que já vieram cadastrados nas inputs pelo método show
     */
    public function update(Request $request) {

        // Verificar se o tipo existe
        // findOrFail - Procure esses dados no Banco de Dados, se não achar, de erro/falha 
        // Retornar o tipo do Banco de Dados
        $type = Type::findOrFail($request->id);

        // Se existir, alterar os dados
        // Atributos da classe Type
        $type->name = $request->name; // O atributo name da tabela Type é igual ao que veio da requisição com o nome de "name"
        $type->unit = $request->unit;
        $type->reference_value = $request->reference_value;
        $type->description = $request->description;

        // Editar os dados
        $type->save();

        // Redirecionar para a página dos tipos e ver se o editar funcionou
        return redirect('/types');

    }

} // Fim da classe
