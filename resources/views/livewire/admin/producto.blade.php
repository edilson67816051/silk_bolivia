<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de los Productos
            </h5>

            <a class="dropdown-item" href="#" wire:click ="clear"; data-toggle="modal" data-target="#productoModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Nuevo Producto
            </a>

            <!-- Modal Nuevo Producto-->
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
                            @if ($image)
                                <div class="mb-3">
                                    <img src="{{ $image->temporaryUrl() }}" alt="" class="img-fluid">

                                </div>
                            @endif


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Codigo</label>
                                <input type="text" class="form-control" wire:model.lazy="codigo" id="codigo"
                                    placeholder="Codigo...">
                                @error('codigo')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Catalago</label>
                                <select name="catalago" id="catalago" wire:model.lazy="catalago" class="form-control"
                                    id="">
                                    <option value="">Seleccione un Catalago...</option>
                                    @foreach ($catalagos as $item)
                                        <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('catalago')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="image" wire:model="image"
                                    accept="image/*">
                            </div>

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror




                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" wire:click="clear"
                                data-dismiss="modal">Salir</button>
                            <button type="submit" class="btn btn-primary" wire:click="save">Guardar</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!---->
        <div class="row">
            @if (!empty($product))
                @foreach ($product as $producto)
                    <div class="col-md-3 mb-3">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/' . $producto->img) }}" class=""
                                alt="Imagen del producto">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->catalago . ' ' . $producto->codigo }}</h5>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-danger" wire:click="select({{ $producto->id }})"
                                    data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                                <button class="btn btn-success" data-toggle="modal"
                                    wire:click="edit({{ $producto->id }})" data-target="#editModal"><i
                                        class="fas fa-edit"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>



        <!-- Modal eliminar producto-->

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
                            <img src="{{ asset('storage/' . $url) }}" class="img-fluid" alt="">
                        </div>

                        <div class="mb-3">
                            <label for="" class="from-label">Catalago : {{ $catalago }}</label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="from-label">Codigo : {{ $codigo }}</label>
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

        <!-- Modal para actulizar el producto -->
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
                        @if ($image)
                            <div class="mb-3">
                                <img src="{{ $image->temporaryUrl() }}" alt="" class="img-fluid">

                            </div>
                        @else
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $url) }}" class="img-fluid" alt="">
                            </div>
                        @endif


                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Catalago :</label>
                            <select name="catalago" id="catalago" wire:model.lazy="catalago" class="form-control"
                                id="">
                                <option value="">Seleccione un Catalago...</option>
                                @foreach ($catalagos as $item)
                                    <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            @error('catalago')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Codigo :</label>
                            <input type="email" class="form-control" id="unidad" wire:model.lazy="codigo"
                                placeholder="medida...">
                            @error('unidad')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="image" wire:model="image"
                                accept="image/*">
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
