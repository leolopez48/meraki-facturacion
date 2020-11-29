@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>
    <div class="col-md-6 offset-md-3">
        <form action="{{ route('actualizarCliente') }}" method="post">
            @csrf
            <input class="form-control" type="text" name="id_cliente" value="{{ $cliente[0]->id_cliente }}"
                style="display: none;">
            <label for="">Nombre</label>
            <input class="form-control" type="text" name="nombre" value="{{ $cliente[0]->nombre }}">
            <label class="pt-3" for="">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" value="{{ $cliente[0]->apellidos }}">
            <hr>
            <label for="">Teléfono</label>
            <input class="form-control" type="tel" name="telefono" value="{{ $cliente[0]->telefono }}"
                pattern="[0-9]{4}-[0-9]{4}">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a type="button" class="btn btn-secondary m-3" href="{{ route('clientes') }} ">Cancelar</a>
        </form>
    </div>
</div>
@endsection
