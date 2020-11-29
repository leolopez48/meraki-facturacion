@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Eliminar Cliente</h1>
    <div class="col-md-6 offset-md-3">
            <input class="form-control" type="text" name="id_cliente" value="{{ $cliente[0]->id_cliente }}"
                style="display: none;">
            <label for="">Nombre</label>
            <input class="form-control" type="text" name="nombre" disabled value="{{ $cliente[0]->nombre }}">
            <label class="pt-3" for="">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" disabled value="{{ $cliente[0]->apellidos }}">
            <hr>
            <label for="">Teléfono</label>
            <input class="form-control" type="text" name="telefono" disabled value="{{ $cliente[0]->telefono }}"
                pattern="[0-9]{4}-[0-9]{4}">
                <p class=" m-3"> <strong>IMPORTANTE: </strong> Esta operación no se puede deshacer, si se eliminan los clientes, también se eliminarán todos los datos relacionados a este.</p>
            <a class="btn btn-danger" href="{{ route('borrarCliente', ['id_cliente'=>$cliente[0]->id_cliente ]) }}">Eliminar</a>
            <a type="button" class="btn btn-secondary" href="{{ route('clientes') }} ">Cancelar</a>
        </form>
    </div>
</div>
@endsection
