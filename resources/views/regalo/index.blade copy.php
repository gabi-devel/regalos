@extends('layouts.app')

@section('content')
<style>
    .container {
        display: flex;
    }

    .content {
        width: 66%;
    }

    .sidebar {
        width: 34%;
        border-left: 1px solid #ccc;
        padding-left: 15px;
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
    .progress {
        width: 100%;
        height: 30px; /* Altura de la barra de progreso */
        margin-bottom: 20px;
    }
</style>
    <div class="container">
    <div class="content">
        <h1>Lista de Regalos</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($regalos->isEmpty())
            <p>Agrega tus regalos. Link</p>
        @endif

    </div>
    <div class="sidebar">
        {{-- Calcular el total de los precios --}}
        @php
            $totalPrecio = $regalos->sum('precio');
            $maxValue = 1000; // El objetivo máximo total
            $progressPercentage = min(100, ($totalPrecio / $maxValue) * 100);
        @endphp
        {{-- Barra de progreso única para todos los regalos --}}
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                {{ floor($totalPrecio) }}
            </div>
        </div>

        @foreach ($regalos as $regalo)
            <div class="price-item" data-precio="{{ $regalo['precio'] }}" data-regalo="{{ $regalo['regalo'] }}">
                <span class="precio">$ {{ floor($regalo->precio) }}</span> {{-- floor redondea hacia abajo --}}
                <span class="regalo">{{ $regalo['regalo'] }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection


