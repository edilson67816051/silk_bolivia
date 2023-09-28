<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de los Productos
            </h5>

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#productoModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Nuevo Producto
            </a>

            <!-- Producto Modal-->
            <div class="modal fade" id="productoModal" wire:ignore.self tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Producto</label>
                                <input type="text" class="form-control" wire:model.lazy="nombreproducto"
                                    id="nombreproducto" placeholder="Producto...">
                                    @error('nombreproducto')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Unidad Medida</label>
                                <input type="email" class="form-control" id="unidad" wire:model.lazy="unidad"
                                    placeholder="medida...">
                                    @error('unidad')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" wire:click="clear" data-dismiss="modal">Salir</button>
                            <button type="submit" class="btn btn-primary" wire:click="store">Guardar</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PRODUCTO</th>
                            <th>UNIDAD MEDIDA</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>PRODUCTO</th>
                            <th>UNIDAD MEDIDA</th>
                            <th>OPCIONES</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (!empty($productos))
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->producto }}</td>
                                    <td>{{ $producto->unidad_medida }}</td>
                                    <td>
                                        <button class="btn btn-danger" wire:click="select({{ $producto->id }})"
                                            data-toggle="modal" data-target="#deleteModal">Eliminar</button>




                                        <button class="btn btn-success" data-toggle="modal"
                                            wire:click="edit({{ $producto->id }})"
                                            data-target="#editModal">Editar</button>
                                    </td>

                                </tr>
                            @endforeach

                        @endif

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Producto Modal-->

        <div class="modal fade" id="deleteModal" wire:ignore.self tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar el
                            producto</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="from-label">Nombre: {{$nombreproducto}}</label>
                         
                        </div>
                        <div class="mb-3">
                            <label for="" class="from-label">Unidad: {{$nombreproducto}}</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  wire:click="clear" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" wire:click="delete()"
                            data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Producto Modal-->
        <div class="modal fade" id="editModal" wire:ignore.self tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actulalizar el producto</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Producto</label>
                            <input type="text" class="form-control" wire:model.lazy="nombreproducto"
                                id="nombreproducto" placeholder="Producto..." >
                            @error('nombreproducto')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Unidad Medida</label>
                            <input type="email" class="form-control" id="unidad" wire:model.lazy="unidad"
                                placeholder="medida...">
                            @error('unidad')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" wire:click="clear" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" wire:click="update">Guardar Cambios</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
