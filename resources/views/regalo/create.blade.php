@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Regalo</h1>

    <form action="{{ route('regalos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="regalo" class="form-label">Nombre del Regalo</label>
            <input type="text" name="regalo" id="regalo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Regalo</button>
    </form>
</div>
@endsection
