@extends('layouts.app')

@section('styles')
    @vite('resources/css/regalo-index.css')
@endsection

@section('content')
<div class="container">
    <div class="content">
        <h1>Perfil de {{ $usuario->name }} </h1>

        <h2>Lista de Regalos</h2>

            @php
                $poseoEsteDinero = 2400; // El dinero que tienes, lo puedes cambiar dinámicamente
            @endphp
        <h4>{{ $usuario->name }} ha recibido hasta ahora $ {{ $poseoEsteDinero }}
        </h4>

        @if ($regalos->isEmpty())
            <p>Agrega tus regalos. Link</p>
        @endif
    </div>

    <div class="sidebar">
        {{-- Variables para calcular progreso entre precios --}}
        @php
            // Precios ordenados
            $precios = $regalos->pluck('precio')->sort()->values();
            
            $lowestPrice = $precios->first();
            $highestPrice = $precios->last();

            // Si el dinero que tienes está entre el precio más bajo y el más alto, calculamos el progreso
            $progressPercentage = 0;
            if ($poseoEsteDinero >= $lowestPrice && $poseoEsteDinero <= $highestPrice) {
                $progressPercentage = (($poseoEsteDinero - $lowestPrice) / ($highestPrice - $lowestPrice)) * 100;
            } elseif ($poseoEsteDinero > $highestPrice) {
                $progressPercentage = 100; // Si tienes más dinero que el precio más alto, llena la barra completamente
            }
        @endphp

        {{-- Barra de progreso vertical con relleno dinámico --}}
        <div class="progress-container">
            <div class="progress-bar-vertical" style="height: {{ $progressPercentage }}%;"></div>

            {{-- Marcadores de precios y regalos posicionados a lo largo de la barra --}}
            @foreach ($regalos as $regalo)
                @php
                    // Calcula la posición vertical del precio en porcentaje
                    $pricePosition = (($regalo->precio - $lowestPrice) / ($highestPrice - $lowestPrice)) * 100;
                @endphp
                <span class="price-marker price" style="bottom: {{ $pricePosition }}%;">
                    ${{ floor($regalo->precio) }}
                </span>
                <span class="price-marker regalo" style="bottom: {{ $pricePosition }}%;">
                    {{ $regalo->regalo }}
                </span>
            @endforeach
        </div>
    </div>
</div>
@endsection
