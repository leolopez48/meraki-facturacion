@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <div class="col-md-6 offset-md-3">
        <form action="{{ route('actualizarProducto') }}" method="post">
            @csrf
            <input class="form-control" type="text" name="id_producto" value="{{ $producto[0]->id_producto }}"
                style="display: none;">
            <label for="">Nombre</label>
            <input class="form-control" type="text" name="nombre" value="{{ $producto[0]->nombre }}">
            <label class="pt-3" for="">Precio</label>
            <input class="form-control" type="number" step="0.1" name="precio" value="{{ $producto[0]->precio }}">
            <label for="">Descuento</label>
            <input class="form-control" type="number" step="0.1" name="descuento" value="{{ $producto[0]->descuento }}">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a type="button" class="btn btn-secondary m-3" href="{{ route('productos') }} ">Cancelar</a>
        </form>
    </div>
</div>
@endsection
