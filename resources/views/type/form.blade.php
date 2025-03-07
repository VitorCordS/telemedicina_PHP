@extends('layout')

<!-- Injetando o content no layout extendido, não é necessário colocar os scripts do Bootstrap pois já tem no layout -->
@section('content')
    
    <div class="container">
        <div class="row justify-content-center">

            {{-- Breadcrumb - Caminho do pão --}}
            <div class="col-lg-8 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Home</a></li>
                      <li class="breadcrumb-item"><a href="/types">Tipos</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Novo</li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-8">
                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h1 class="fw-bold">
                            {{-- Se existe um ID, usar "Alterar Tipo", senão usar "Novo Tipo" --}}
                            {{ isset($type->id) ? "Alterar Tipo" : "Novo Tipo" }}
                        </h1>
                    </div>

                    <div class="card-body px-5 py-4">

                        {{-- PUT - Altera o recurso inteiro, PATCH - Altera parte do recurso --}}
                        {{-- Verificando se o ID existe, se existir fazer a alteração/update do tipo com o ID indicado através do método put --}}
                        @if (isset($type->id))
                            <form action="/types/{{$type->id}}" method="POST">
                            @method('put')
                        @else
                            <form action="/types/new" method="POST">
                        @endif

                            @csrf <!-- Token para assinar de onde veio os dados, para evitar o ataque de falsificação de tela (sem isso não funciona) -->

                            <!-- Nome - "name" -->
                            <div class="form-floating mb-3"> <!-- value - Valor padrão do input será o que vier do Banco de Dados do método show, se não existir, será nulo -->
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{$type->name ?? null}}">
                                <label for="floatingInput">Nome</label>
                            </div>

                            <!-- Unidade de Medida - "unit" -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="unit" name="unit" placeholder="Unidade de Medida" value="{{$type->unit ?? null}}">
                                <label for="floatingInput">Unidade de Medida</label>
                            </div>

                            <!-- Valor de Referência - "reference_value" -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="reference_value" name="reference_value" placeholder="Valor de Referência" value="{{$type->reference_value ?? null}}">
                                <label for="floatingInput">Valor de Referência</label>
                            </div>

                            <!-- Descrição (Text Area) - "description" -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="description" name="description" placeholder="Descrição" rows="3" >{{$type->description ?? null}}</textarea>
                                <label for="floatingInput">Descrição</label>
                            </div>

                            <!-- Botões -->
                            <div class="d-flex justify-content-end gap-1">
                                <button class="btn btn-secondary" type="reset">Limpar</button>
                                <button class="btn btn-success" type="submit">Salvar</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div> <!-- Fim da col -->

        </div> <!-- Fim da row -->
    </div> <!-- Fim do container -->

    <!-- Toast -->

    <!-- Se existe o sucesso, mostre -->
    @isset($success)
        
        <!-- Style pro Toast -->
        <style>

            .toast {
                position: fixed;
                right: 20px;
                top: 20px;

                background-color: rgba(255, 255, 255, 0.96);
                
                /* Duas animações em uma animation, sendo a segunda a mesma animação porém ao contrário (FadeIn e FadeOut) */
                animation: fade 1s forwards, fade 1s forwards; /* forwards - Executa apenas uma vez */
                animation-delay: 0s, 3s;
                animation-direction: normal, reverse;
            }

            /* Animação de fade */
            @keyframes fade {
                from {opacity: 0; display: none;} /* display: none - Irá sumir com o toast inclusive no HTML também, sem ele, será possível interagir mesmo com o elemento invisível */ 
                to {opacity: 1;}
            }

        </style>

        <!-- Toast - Pop Up para indicar se deu certo ou errado o cadastro de dados com uma mensagem de sucesso ou erro -->
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">

            <div class="toast-header">
            <strong class="me-auto">✅Sucesso</strong> <!-- Provirsoriamente -->
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

            <div class="toast-body">
            Tipo de exame cadastrado com sucesso!
            </div>

        </div>

    @endisset

@endsection