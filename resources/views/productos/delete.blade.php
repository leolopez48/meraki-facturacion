@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Eliminar Producto</h1>
    <div class="col-md-6 offset-md-3">
            <input class="form-control" type="text" name="id_producto" value="{{ $producto[0]->id_producto }}"
                style="display: none;">
            <label for="">Nombre</label>
            <input class="form-control" type="text" name="nombre" disabled value="{{ $producto[0]->nombre }}">
            <label class="pt-3" for="">Precio</label>
            <input class="form-control" type="text" name="precio" disabled value="{{ $producto[0]->precio }}">
            <hr>
            <label for="">Descuento</label>
            <input class="form-control" type="text" name="descuento" disabled value="{{ $producto[0]->descuento }}">
                <p class=" m-3"> <strong>IMPORTANTE: </strong>
                    Esta operación no se puede deshacer, si se elimina el producto,
                    también se eliminarán todos los datos relacionados a este.
                </p>
            <a class="btn btn-danger" href="{{ route('borrarProducto', ['id_producto'=>$producto[0]->id_producto ]) }}">
            Eliminar</a>
            <a type="button" class="btn btn-secondary" href="{{ route('productos') }} ">
            Cancelar</a>
        </form>
    </div>
</div>
@endsection
