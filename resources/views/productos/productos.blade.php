@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pt-2">Productos</h1>

    <form action="{{ route('buscarProducto') }}" method="POST">
        @csrf
        <div class="form-inline offset-md-3 mb-3">
            <input class="form-control col-md-8" type="text" name="buscar" placeholder="Busca por nombre o ID">
            <button type="submit" class="btn btn-primary" href=""><i class="fas fa-search"></i></button>
        </div>
    </form>

    <div class="row pb-3">
        <div class="form-inline">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregar"><i class="fas fa-plus"
                    title="Agregar"></i></button>
            <a href="{{ route('productos') }}" class="btn btn-success ml-2" data-toggle="tooltip" title="Refrescar">
                <i class="fas fa-redo-alt"></i>
            </a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio </th>
            <th>Descuento</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id_producto }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->descuento }}</td>
                <td>
                    <a class="btn btn-secondary"
                        href="{{ route('editarProducto', [ 'id_producto'=>$producto->id_producto ]) }}"><i
                            class="fas fa-edit"></i></a>
                    <a class="btn btn-danger"
                        href="{{ route('eliminarProducto', [ 'id_producto'=>$producto->id_producto ]) }}]"><i
                            class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guardarProducto') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="">
                    <label class="pt-3" for="">Descuento</label>
                    <input class="form-control" type="number" name="descuento" step="0.1">
                    <label class="pt-3" for="">Precio</label>
                    <input class="form-control" type="number" name="precio" step="0.1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin modal Agregar -->

@endsection
