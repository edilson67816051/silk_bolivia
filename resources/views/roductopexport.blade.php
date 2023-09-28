<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Unidad Medida</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{$producto->id}}</td>
                <td>{{$producto->producto}}</td>
                <td>{{$producto->unidad_medida}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
