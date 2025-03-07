@extends('layout') <!-- Qual o arquivo que será extendido esse conteúdo -->

@section('view-title', 'Dashboard Inicial')

@section('content') <!-- Qual o nome da section no arquivo do layout -->

    {{-- Exames cadastrados --}}
    <div class="container bg-light mt-5 mb-4 p-5">
        <h2 class="text-center mb-5">Exames Cadastrados</h2>
        <div class="row">
            @forelse($exams as $exam)
                <div class="col-md-3 mb-4">
                    <div class="card">

                        <div class="card-header bg-primary text-white text-center p-2 fs-4">
                            {{ $exam->type->name }}
                        </div>

                        <div class="card-body text-center">

                            <p class="card-text"><span class="fw-bold">Data: </span>{{date('d/m/Y', strtotime($exam->date))}}</p>
                            <p class="card-text"><span class="fw-bold">Valor: </span>{{ $exam->value }}{{ $exam->type->unit }}</p>
                            <p class="card-text"><span class="fw-bold">Anotações: </span>{{ $exam->note }}</p>

                            <hr>

                            <p class="card-text"><span class="fw-bold">Valor de referência: </span>{{$exam->type->reference_value}}</p>
                            <p class="card-text"><span class="fw-bold">Descrição desse tipo de exame: </span>{{$exam->type->description}}</p>

                        </div>

                    </div>
                </div>
            @empty
                <p class="text-center fs-5">Nenhum exame cadastrado.</p>
            @endforelse
        </div>
    </div>

    {{-- Dashboard --}}
    @if ($values && $dates)

        <h1 class="text-center mt-5 ms-5">Gráfico</h1>

        {{-- Gráfico --}}
        <canvas id="myChart" class="p-5" width="400" height="200"></canvas>

        {{-- Script para o chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>

        {{-- Modificando o gráfico com JS --}}
        <script>
            
            // Joga o array de valores para um Json
            const values = @json($values);

            // Joga o array de datas para um Json
            const dates = @json($dates);

            // * Configuração do gráfico

            // Selecionando o gráfico pelo id
            const ctx = document.getElementById('myChart').getContext('2d');

            // Inserindo as propriedades do gráfico
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates, // Dados do eixo x
                    datasets: [{
                        label: 'Valores em 2024',
                        data: values, // Dados do eixo y
                        backgroundColor: 'rgba(75, 192, 192, 1)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });

        </script>

    @endif

@endsection