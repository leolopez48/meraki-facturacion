@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Eliminar Venta</h1>
    <div class="col-md-6 offset-md-3">
        <form class="ml-2" action="{{ route('borrarVenta') }}" method="post">
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
            <input class="form-control" type="number" name="cantidad" disabled step="1"
                value="{{ $venta[0]->cantidad }}">
            <label class="pt-3" for="">Lugar Entrega</label>
            <input class="form-control" type="text" name="lugarEntrega" disabled value="{{ $venta[0]->lugar_entrega }}">
            <label class="pt-3" for="">Fecha Entrega</label>

            @php
            $fecha = date('Y-m-d\TH:i', strtotime($venta[0]->fecha_entrega));
            echo '<input class="form-control" type="datetime-local" disabled name="fechaEntrega" value="'.$fecha.'">';
            @endphp

            <label class="pt-3" for="">Fecha Factura</label>
            @php
            $fecha = date('Y-m-d\TH:i', strtotime($venta[0]->created_at));
            echo '<input class="form-control" type="datetime-local" disabled name="fechaEntrega" value="'.$fecha.'">';
            @endphp
            <p class=" m-3"> <strong>IMPORTANTE: </strong>
                Esta operación no se puede deshacer, si se elimina la venta,
                también se eliminarán todos los datos relacionados a este.
            </p>
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a type="button" class="btn btn-secondary" href="{{ route('ventas') }} ">
                Cancelar</a>
        </form>
        </form>
    </div>
</div>
@endsection
