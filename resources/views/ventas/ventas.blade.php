@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="pt-2">Ventas</h1>

    <form action="{{ route('buscarVenta') }}" method="POST">
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
            <button class="btn btn-secondary ml-2" data-toggle="modal" data-target="#modalProducto"><i
                    class="fas fa-cart-plus" title="Agregar"></i></button>
            <a href="{{ route('ventas') }}" class="btn btn-success ml-2" data-toggle="tooltip" title="Refrescar">
                <i class="fas fa-redo-alt"></i>
            </a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto </th>
            <th>Lugar</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @if (count($ventas) > 0)
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->nombreCliente }} {{ $venta->apellidoCliente }}</td>
                <td>{{ $venta->producto }}</td>
                <td>{{ $venta->lugar_entrega }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>{{ $venta->created_at }}</td>
                <td>
                    <a class="btn btn-secondary"
                        href="{{ route('editarVenta', [ 'id_venta'=>$venta->id_venta, 'id_producto'=>$venta->id_producto ]) }}"><i
                            class="fas fa-edit"></i></a>
                    <a class="btn btn-danger"
                        href="{{ route('eliminarVenta', [ 'id_venta'=>$venta->id_venta, 'id_producto'=>$venta->id_producto ]) }}"><i
                            class="fas fa-trash"></i></a>
                    <a class="btn btn-success" href="{{ route('facturacion', [ 'id_venta'=>$venta->id_venta ]) }}"><i
                            class="fas fa-file-alt"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guardarVenta') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="">Cliente</label>
                    <select name="cliente" class="form-control">
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}
                        </option>
                        @endforeach
                    </select>
                    <label class="pt-3" for="">Producto</label>
                    <select name="producto" class="form-control">
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    <label class="pt-3" for="">Cantidad</label>
                    <input class="form-control" type="number" name="cantidad" step="1">
                    <label class="pt-3" for="">Lugar Entrega</label>
                    <input class="form-control" type="text" name="lugarEntrega">
                    <label class="pt-3" for="">Fecha Entrega</label>
                    <input class="form-control" type="date" name="fechaEntrega">
                    <label class="pt-3" for="">Fecha Factura</label>
                    <input class="form-control" type="datetime-local" name="fechaFactura">
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

<!-- Modal -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProducto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto a venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('agregarProductoVenta') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label class="pt-3" for="">ID Venta</label>
                    @php
                    if(count($ventas)>0){
                    $length = count($ventas);
                    $idVenta = $ventas[$length-1]->id_venta;
                    echo '<input class="form-control" type="number" name="idVenta" value="'.$idVenta.'">';
                    }
                    @endphp
                    <label for="">Cliente</label>
                        <select name="cliente" class="form-control">
                        @if(count($clientes)>0)
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <label class="pt-3" for="">Producto</label>
                    <select name="producto" class="form-control">
                        @if(count($productos)>0))
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label class="pt-3" for="">Cantidad</label>
                    <input class="form-control" type="number" name="cantidad" step="1">
                    <label class="pt-3" for="">Lugar Entrega</label>
                    <input class="form-control" type="text" name="lugarEntrega">
                    <label class="pt-3" for="">Fecha Entrega</label>
                    <input class="form-control" type="date" name="fechaEntrega">
                    <label class="pt-3" for="">Fecha Factura</label>
                    <input class="form-control" type="datetime-local" name="fechaFactura">
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
