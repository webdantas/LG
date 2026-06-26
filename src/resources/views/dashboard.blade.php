<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        LG Electronics - Dashboard Produção
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body{

            background:#f8f9fa;

        }

        .card-dashboard{

            border:none;

            border-radius:12px;

            transition:.2s;

        }

        .card-dashboard:hover{

            transform:translateY(-2px);

            box-shadow:0 .5rem 1rem rgba(0,0,0,.15);

        }

        .number{

            font-size:2rem;

            font-weight:bold;

        }

        .table td{

            vertical-align:middle;

        }

    </style>

</head>

<body>

<div class="container py-4">

    <div class="row mb-4">

        <div class="col">

            <h2>

                Dashboard Produção - Planta A

            </h2>

            <small class="text-muted">

                Janeiro / 2026

            </small>

        </div>

    </div>



    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <div class="card card-dashboard shadow-sm">

                <div class="card-body text-center">

                    <div class="text-muted">

                        Total Produzido

                    </div>

                    <div class="number text-primary">

                        {{ number_format($totalProduced,0,',','.') }}

                    </div>

                </div>

            </div>

        </div>



        <div class="col-md-4 mb-3">

            <div class="card card-dashboard shadow-sm">

                <div class="card-body text-center">

                    <div class="text-muted">

                        Total Defeitos

                    </div>

                    <div class="number text-danger">

                        {{ number_format($totalDefects,0,',','.') }}

                    </div>

                </div>

            </div>

        </div>



        <div class="col-md-4 mb-3">

            <div class="card card-dashboard shadow-sm">

                <div class="card-body text-center">

                    <div class="text-muted">

                        Eficiência Média

                    </div>

                    <div class="number text-success">

                        {{ number_format($averageEfficiency,2,',','.') }}%

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">

            <strong>

                Produção por Linha

            </strong>

        </div>

        <div class="card-body">

            <div style="height:350px">

                <canvas id="productionChart"></canvas>

            </div>

        </div>

    </div>



    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form

                id="filterForm"

                method="GET"

                action="{{ url('/') }}">

                <div class="row align-items-end">

                    <div class="col-md-5">

                        <label class="form-label">

                            Linha de Produção

                        </label>

                        <select

                            id="line"

                            name="line"

                            class="form-select">

                            <option value="">

                                Todas as linhas

                            </option>

                            @foreach($lines as $item)

                                <option

                                    value="{{ $item }}"

                                    {{ $line == $item ? 'selected' : '' }}>

                                    {{ $item }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button

                            type="submit"

                            class="btn btn-primary w-100">

                            Pesquisar

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a

                            href="{{ url('/') }}"

                            class="btn btn-secondary w-100">

                            Limpar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>



    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <strong>

                Produção Diária

            </strong>

        </div>

        <div class="table-responsive">

            <table class="table table-striped table-hover mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>Data</th>

                        <th>Linha</th>

                        <th class="text-end">

                            Produzidas

                        </th>

                        <th class="text-end">

                            Defeitos

                        </th>

                        <th class="text-end">

                            Eficiência

                        </th>

                    </tr>

                </thead>

                <tbody>

                                        @forelse($productions as $production)

                        <tr>

                            <td>

                                {{ $production->production_date->format('d/m/Y') }}

                            </td>

                            <td>

                                {{ $production->product_line }}

                            </td>

                            <td class="text-end">

                                {{ number_format($production->produced_quantity,0,',','.') }}

                            </td>

                            <td class="text-end">

                                {{ number_format($production->defect_quantity,0,',','.') }}

                            </td>

                            <td class="text-end">

                                @if($production->efficiency >= 99)

                                    <span class="badge bg-success">

                                        {{ number_format($production->efficiency,2,',','.') }}%

                                    </span>

                                @elseif($production->efficiency >= 97)

                                    <span class="badge bg-warning text-dark">

                                        {{ number_format($production->efficiency,2,',','.') }}%

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        {{ number_format($production->efficiency,2,',','.') }}%

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center text-muted py-4">

                                Nenhum registro encontrado.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>



    <div class="mt-4 d-flex justify-content-center">

        {{ $productions->links() }}

    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const select = document.getElementById('line');

    select.addEventListener('change', function () {

        document.getElementById('filterForm').submit();

    });

        const ctx = document.getElementById('productionChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: @json($chartLabels),

            datasets: [{

                label: 'Quantidade Produzida',

                data: @json($chartData),

                backgroundColor: [

                    '#C00000',

                    '#0D6EFD',

                    '#198754',

                    '#FFC107'

                ],

                borderColor: [

                    '#C00000',

                    '#0D6EFD',

                    '#198754',

                    '#FFC107'

                ],

                borderWidth: 1

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: true,

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    callbacks: {

                        label: function(context){

                            return context.raw.toLocaleString('pt-BR') + ' unidades';

                        }

                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value){

                            return value.toLocaleString('pt-BR');

                        }

                    }

                }

            }

        }

    });

});

</script>

</body>

</html>
