<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de los Catálagos
            </h5>

            <a class="dropdown-item" href="#" wire:click ="clear"; data-toggle="modal" data-target="#catalagoModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Nuevo Catalago
            </a>
            <!-- catalago Modal-->
            <div class="modal fade" id="catalagoModal" wire:ignore.self tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Catálagos</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">catalago</label>
                                <input type="text" class="form-control" wire:model.lazy="nombrecatalago"
                                    id="nombrecatalago" placeholder="catalago...">
                                @error('nombrecatalago')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" wire:click="clear"
                                data-dismiss="modal">Salir</button>
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
                            <th>NOMBRE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>OPCIONES</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (!empty($catalagos))
                            @foreach ($catalagos as $catalago)
                                <tr>
                                    <td>{{ $catalago->id }}</td>
                                    <td>{{ $catalago->nombre }}</td>
                                    <td>
                                        <button class="btn btn-danger" wire:click="select({{ $catalago->id }})"
                                            data-toggle="modal" data-target="#deleteModal">Eliminar</button>




                                        <button class="btn btn-success" data-toggle="modal"
                                            wire:click="edit({{ $catalago->id }})"
                                            data-target="#editModal">Editar</button>
                                    </td>

                                </tr>
                            @endforeach

                        @endif

                    </tbody>
                </table>
                <div class="float-end"> {{ $catalagos->links() }}</div>
            </div>
        </div>

        <!-- catalago Modal-->

        <div class="modal fade" id="deleteModal" wire:ignore.self tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar el
                            catalago</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="from-label">Nombre: {{ $nombrecatalago}}</label>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" wire:click="clear"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" wire:click="delete()"
                            data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Catalago Modal-->
        <div class="modal fade" id="editModal" wire:ignore.self tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actulalizar el Catalago</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Catalago</label>
                            <input type="text" class="form-control" wire:model.lazy="nombrecatalago"
                                id="nombrecatalago" placeholder="catalago...">
                            @error('nombrecatalago')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" wire:click="clear"
                            data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" wire:click="update">Guardar Cambios</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

