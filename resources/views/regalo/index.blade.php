@extends('layouts.app')

@section('content')
<style>
.container {
    display: flex;
    flex-direction: row;
    justify-content: center; 
    margin-top: 30px;
}

.content {
    width: 66%;
}

.sidebar {
    width: 34%;
    border-left: 1px solid #ccc;
    padding-left: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.progress-container {
    position: relative;
    height: 300px; /* Altura de la barra de progreso */
    width: 30px; /* Ancho de la barra */
    background-color: #f0f0f0;
    border: 2px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.progress-bar-vertical {
    position: absolute;
    width: 100%;
    background-color: #9d35f1;
    transition: height 0.6s ease;
    bottom: 0;
    border-radius: 5px;
}

.price-marker {
    position: absolute;
    font-size: 14px;
    white-space: nowrap; /* Evita que el texto se rompa */
    transform: translateX(0); /* Elimina la rotación */
}

.price {
    left: -65px; /* Ajusta la posición a la izquierda de la barra */
    text-align: right; /* Alinea el texto a la derecha */
    width: 50px; /* Ancho suficiente para evitar la superposición */
    position: absolute;
}

.regalo {
    right: -65px; /* Ajusta la posición a la derecha de la barra */
    text-align: left; /* Alinea el texto a la izquierda */
    width: 50px; /* Ancho suficiente para evitar la superposición */
    position: absolute;
}
</style>

<div class="container">
    <div class="content">
        <h1>Lista de Regalos</h1>
            @php
                $poseoEsteDinero = 2400; // El dinero que tienes, lo puedes cambiar dinámicamente
            @endphp
        <h4>Por ahora me regalaron $ {{ $poseoEsteDinero }}
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
