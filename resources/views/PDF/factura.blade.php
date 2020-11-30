<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Facturación</title>
</head>
<style>
    /* table,
    th,
    td {
        border: 1px solid black;
    } */

</style>

<body style="font-size: 14px;">
    <div class="container-fluid">
        <table class="py-0 " style=" width:100%;">
            <tbody>
                <tr>
                    <td style="width: 200px;"><img src="{{public_path('imgs/logo-blanco.jpg')}}"
                            style="width: 120px; height:90px;">
                    </td>
                    <td scope="col" style="width: 230px; padding-left: 30px; font-size: 14px;" class="text-center">
                        <!-- Fb: MerakiSV
                        <br>Ig: @merakiisv__
                        <br>Wa: 7675-7394 -->
                    </td>
                    <td scope="col">
                        <p class="text-left font-weight-bold pl-1" style="font-size: 14px;">Factura No.
                            {{ date('dmY') }}{{$show[0]->id_venta}}
                            <br>Fecha de emisión: {{ date('d-m-Y', strtotime($show[0]->created_at)) }}
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered" style="padding-top: 15px;">
            <thead class="px-0">
                <tr>
                    <th colspan="2">Cliente </th>
                    <th>Lugar entrega</th>
                    <th>Fecha Entrega</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" colspan="2" class="px-0" style="margin-left: 20px;">{{ $show[0]->nombreCliente }}
                        {{ $show[0]->apellidoCliente }}
                    </td>
                    <td>
                        {{$show[0]->lugar_entrega}}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($show[0]->fecha_entrega)) }}
                    </td>
                </tr>

            </tbody>
        </table>
        <?php
        $total = array();
        ?>
        <table class="table table-bordered" style=" width:100%;">
            <thead>
                <tr>
                    <th scope="col" class="text-left">ID</th>
                    <th scope="col" style="align-content: initial;">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($show as $show)
                <tr>
                    <td>{{$show->id_producto}}</td>
                    <td>{{$show->producto}}</td>
                    <td>{{$show->cantidad}}</td>
                    <td>${{ number_format($show->precio, 2) }}</td>
                    <td>${{ number_format($show->total, 2) }}</td>
                    <?php array_push($total, $show->total) ?>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Total</td>
                    <td>
                        <?php
                        $suma = 0;
                        foreach($total as $total){
                            $suma += $total;
                        }
                    ?>
                        ${{ $suma }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
