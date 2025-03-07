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
                      <li class="breadcrumb-item"><a href="/exams">Meus exames</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Novo</li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-8">
                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h1 class="fw-bold">
                            Novo exame
                        </h1>
                    </div>

                    <div class="card-body px-5 py-4">

                        {{-- PUT - Altera o recurso inteiro, PATCH - Altera parte do recurso --}}
                        {{-- Verificando se o ID existe, se existir fazer a alteração/update do tipo com o ID indicado através do método put --}}
                        @if (isset($exam->id))
                            <form action="/exams/{{$exam->id}}" method="POST">
                            @method('put')
                        @else
                            <form action="/exams/new" method="POST">
                        @endif

                            @csrf <!-- Token para assinar de onde veio os dados, para evitar o ataque de falsificação de tela (sem isso não funciona) -->

                            <!-- Select - tag do html para um menu de escolhas de opção, um input com opções -->
                            <select name="type_id" required class="form-select mb-3" aria-label="Default select example">
                                <option disabled selected value="">Selecione o tipo do exame</option>

                                {{-- Forelse - Para cada tipo como 'type' dentro da tabela 'types', gerar uma opção para o select com o nome do tipo de exame, senão, mostrar como nenhum tipo cadastrado --}}
                                @forelse ($types as $type)
                                    <option value="{{$type->id}}" {{isset($exam) && $type->id == $exam->type->id ? 'selected' : null}}>
                                        {{$type->name}}
                                    </option>
                                @empty
                                    <option disabled value="" class="text-black text-center">Nenhum tipo cadastrado</option>
                                @endforelse
                            </select>

                            <!-- Data - "date" -->
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date" name="date" placeholder="Data do Exame" value="{{$exam->date ?? null}}">
                                <label for="floatingInput">Data do Exame</label>
                            </div>

                            <!-- Valor - "value" -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="value" name="value" placeholder="Valor" value="{{$exam->value ?? null}}">
                                <label for="floatingInput">Valor</label>
                            </div>

                            <!-- Anotações (Text Area) - "note" -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="note" name="note" placeholder="Anotações" rows="3" >{{$exam->note ?? null}}</textarea>
                                <label for="floatingInput">Anotações</label>
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
            <strong class="me-auto">✅Sucesso</strong> <!-- Provisoriamente -->
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

            <div class="toast-body">
            Tipo de exame cadastrado com sucesso!
            </div>

        </div>

    @endisset

@endsection