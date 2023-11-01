<table>
    <thead>
        <tr>
            <th></th>
            <th>Codigo : {{$producto->codigo}}</th>
            <th></th>
            <th></th>         
            <th></th>
            <th>Catalago : {{$producto->catalago}}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>EXISTENCIA FISICA</th>
            <th></th>         
            <th></th>
            <th></th>
            <th>VALOR EN BOLIVIANO</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>FECHA</th>
            <th>DETALLE</th>
            <th>ENTRADA</th>
            <th>SALIDA</th>
            <th>SALDO</th>
            <th>COSTO UNIT</th>
            <th>ENTRADA</th>
            <th>SALIDA</th>
            <th>SALDO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventarios as $inventario)
            <tr>
                <td>{{$inventario->created_at}}</td>
                <td>{{$inventario->detalle}}</td>
                @if ($inventario->tipo == 'entrada')
                <td>{{$inventario->cantidad}}</td>
                <td></td>
                @else
                <td></td>
                <td>{{$inventario->cantidad}}</td>
                @endif
                <td>{{$inventario->cantidad_total}}</td>
                <td>{{$inventario->valor_unit}}</td>
                @if ($inventario->tipo == 'entrada')
                <td>{{$inventario->valor}}</td>
                <td></td>
                @else
                <td></td>
                <td>{{$inventario->valor}}</td>
                @endif
                <td>{{$inventario->valor_total}}</td>               
            </tr>
        @endforeach
    </tbody>
</table>