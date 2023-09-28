<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Detalle</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventarios as $inventario)
            <tr>
                <td>{{$inventario->created_at}}</td>
                <td>{{$inventario->detalle}}</td>
                <td>{{$inventario->cantidad}}</td>
            </tr>
        @endforeach
    </tbody>
</table>