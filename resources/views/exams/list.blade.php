@extends('layout')

{{-- 
    * Métodos HTTP *
    GET -> Obter
    POST -> Salvar
    DELETE -> Excluir
    PUT/PATCH -> Editar
--}}

<!-- Injetando o content no layout extendido, não é necessário colocar os scripts do Bootstrap pois já tem no layout -->
@section('content')
    
    <div class="container">
        <div class="row justify-content-center">

            {{-- Breadcrumb - Caminho do pão --}}
            <div class="col-lg-8 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Meus exames</li>
                      <li class="breadcrumb-item"><a href="/exams/new">Novo</a></li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-8">
                <div class="card shadow">

                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h1 class="fw-bold">Exames</h1>
                        <a class="btn btn-danger" href="/exams/new">Novo Exame</a>
                    </div>

                    <div class="card-body px-5 py-4">
                        <table class="table table-striped">

                            {{-- Header da tabela --}}
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Data</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Ações</th>
                              </tr>
                            </thead>

                            {{-- Body da tabela --}}
                            <tbody>

                                {{-- Forelse - Se existe algo cadastrado dentro do array types, mostrar, se não, mostrar o que estiver escrito dentro de @empty --}}
                                {{-- Forelse para percorrer o vetor types como cada elemento type do Banco de Dados e mostrar na tela --}}
                                @forelse($exams as $exam)
                                    
                                <tr>
                                    <th scope="row">{{$exam->id}}</th>
                                    <td>{{$exam->type->name}}</td>
                                    <td>{{date('d/m/Y', strtotime($exam->date))}}</td> {{-- Formatando a data com PHP --}}
                                    <td>{{$exam->value}} {{$exam->type->unit}}</td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="/exams/{{$exam->id}}" class="btn btn-secondary">Editar</a>

                                            {{-- Para métodos HTTP que não sejam o GET, é necessário que estejam dentro de um formulário --}}
                                            {{-- Excluindo os dados de acordo com o ID --}}
                                            <form action="/exams/{{$exam->id}}" method="POST">

                                                {{-- O HTML5 não possui todos os métodos HTTP, apenas o GET e POST, então para usar o DELETE por exemplo, é necessário usar uma diretiva do blade @method --}}
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger">Excluir</button>

                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Se estiver vazio, sem nenhum dado cadastrado, mostrar o que estiver escrito dentro de @empty --}}
                                @empty
                                <tr> {{-- Mesclando as 5 colunas com colspan --}}
                                    <td colspan="5" class="text-center fs-4">Nenhum exame cadastrado</td>
                                </tr>

                                @endforelse()

                            </tbody>

                          </table>
                    </div>

                </div>
            </div> <!-- Fim da col -->

        </div> <!-- Fim da row -->
    </div> <!-- Fim do container -->

@endsection