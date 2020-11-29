@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Venta</h1>
    <div class="col-md-6 offset-md-3">
        <form action="{{ route('actualizarVenta') }}" method="post">
            @csrf
            <label for="">ID</label>
            <input class="form-control" type="number" name="id_venta" step="1" value="{{ $venta[0]->id_venta }}">
            <label for="">Cliente</label>
            <select name="cliente" class="form-control">
                @foreach ($clientes as $cliente)
                @if($venta[0]->nombreCliente == $cliente->nombre)
                <option value="{{ $cliente->id_cliente }}" selected>{{ $cliente->nombre }} {{ $cliente->apellidos }}
                </option>
                @else
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}
                </option>
                @endif
                @endforeach
            </select>
            <label class="pt-3" for="">Producto</label>
            <select name="productoAnterior" class="form-control" style="display: none;">
                @foreach ($productos as $producto)
                @if($venta[0]->producto == $producto->nombre)
                <option value="{{ $producto->id_producto }}" selected>{{ $producto->nombre }}
                </option>
                @else
                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}
                </option>
                @endif
                @endforeach
            </select>
            <select name="producto" class="form-control">
                @foreach ($productos as $producto)
                @if($venta[0]->producto == $producto->nombre)
                <option value="{{ $producto->id_producto }}" selected>{{ $producto->nombre }}
                </option>
                @else
                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }}
                </option>
                @endif
                @endforeach
            </select>
            <label class="pt-3" for="">Cantidad</label>
            <input class="form-control" type="number" name="cantidad" step="1" value="{{ $venta[0]->cantidad }}">
            <label class="pt-3" for="">Lugar Entrega</label>
            <input class="form-control" type="text" name="lugarEntrega" value="{{ $venta[0]->lugar_entrega }}">
            <label class="pt-3" for="">Fecha Entrega</label>

            @php
            $fecha = date('Y-m-d\TH:i', strtotime($venta[0]->fecha_entrega));
            echo '<input class="form-control" type="datetime-local" name="fechaEntrega" value="'.$fecha.'">';
            @endphp

            <label class="pt-3" for="">Fecha Factura</label>
            @php
            $fecha = date('Y-m-d\TH:i', strtotime($venta[0]->created_at));
            echo '<input class="form-control" type="datetime-local" name="fechaCreacion" value="'.$fecha.'">';
            @endphp
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a type="button" class="btn btn-secondary m-3" href="{{ route('ventas') }} ">Cancelar</a>
        </form>
    </div>
</div>
@endsection
