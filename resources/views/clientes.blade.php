@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pt-2">Clientes</h1>

    <form action="{{ route('buscarCliente') }}" method="POST">
        @csrf
        <div class="form-inline offset-md-3 mb-3">
            <input class="form-control col-md-8" type="text" name="buscar" placeholder="Busca por nombre o ID">
            <button type="submit" class="btn btn-primary" href=""><i class="fas fa-search"></i></button>
        </div>
    </form>

    <div class="row pb-3">
        <div class="form-inline">
            <button class="btn btn-primary" href="#"><i class="fas fa-plus" data-toggle="modal"
                    data-target="#modalAgregar" title="Agregar"></i></button>
            <form action="{{ route('clientes') }}" method="get">
                <button type="submit" class="btn btn-success ml-2" data-toggle="tooltip" title="Refrescar">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </form>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <!-- <th>Telefono</th> -->
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_cliente }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellidos }}</td>
                <!-- <td>{{-- $cliente->telefono --}}</td> -->
                <td>
                    <a class="btn btn-secondary" href="{{ route('home') }}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" href="{{ route('home') }}"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('home') }}" method="post">
                    <label for="">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="">
                    <label class="pt-3" for="">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" id="">
                    <hr>
                    <label for="">Teléfono</label>
                    <input class="form-control" type="text" name="telefono" id="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal Agregar -->
@endsection
