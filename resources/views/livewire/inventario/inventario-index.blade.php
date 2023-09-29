<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    Buscar Productos
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="search">Buscar</label>
                                <div class="select-wrapper">
                                    <input id="search" wire:model='search' wire:keyup='searchProduct' type="text"
                                        class="form-control select-input" placeholder="Selecciona un producto">
                                    @if ($showlist)
                                        <ul class="list-group select-list">
                                            @if (!empty($results))
                                                @foreach ($results as $result)
                                                    <li class="list-group-item select-option"
                                                        wire:click='getProduct({{ $result->id }})'>
                                                        {{ $result->id . ' ' . $result->producto }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (!empty($product))
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="cantidad">Nombre</label>
                                    <input id="cantidad" class="form-control" type="text"
                                        value="{{ $product->producto }}" name="cantidad" placeholder="Nombre" disabled
                                        onkeyup="calcularPrecio(event)">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="precio">Unidad Medida</label>
                                    <input id="precio" class="form-control" type="text" name="precio"
                                        value="{{ $product->unidad_medida }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="precio">Cantidad</label>
                                    <input id="precio" class="form-control" type="text" name="precio"
                                        value="{{ $cantidad_total . ' /' . $product->unidad_medida }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="sub_total">Costo Unitario</label>
                                    <input id="sub_total" class="form-control" type="text" name="sub_total"
                                        placeholder="Sub Total" value="{{ $costo_unit . ' bs.' }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label for="sub_total">Valor total</label>
                                    <input id="sub_total" class="form-control" type="text" name="sub_total"
                                        placeholder="Sub Total" value="{{ $valor_total . ' bs.' }}" disabled>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-group">
                                    <button class="btn btn-primary" wire:click = 'export({{$search}})'>exel</button>
                                </div>
                            </div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#productoModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Registrar
                            </a>
                        @endif

                    </div>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="tblDetalle">
                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Detalle</th>
                            <th>Cantidad</th>
                            <th>valor</th>
                            <th>Cantidad Total</th>
                            <th>Valor Total</th>
                            <th>Costo Unit</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($product))
                            @foreach ($inventario as $item)
                                <tr>
                                    <th>{{ $item->updated_at }}</th>
                                    <th>{{ $item->detalle }}</th>
                                    <th>{{ $item->cantidad }}</th>
                                    <th>{{ $item->valor }}</th>
                                    <th>{{ $item->cantidad_total }}</th>
                                    <th>{{ $item->valor_total }}</th>
                                    <th>{{ $item->valor_unit }}</th>
                                    <th>
                                        @if ($item->tipo == 'entrada')
                                            <span style="color: green">{{ $item->tipo }}</span>
                                        @else
                                            @if ($item->tipo == 'salida')
                                                <span style="color: red">{{ $item->tipo }}</span>
                                            @else
                                                <span style="color:blue">{{ $item->tipo }}</span>
                                            @endif
                                        @endif
                                    </th>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold">
                            <td>Total Pagar</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    <!-- Producto Modal-->
    <div class="modal fade" id="productoModal" wire:ignore.self tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="form-control"> Tipo</label>
                        <select wire:model.lazy="tipo" class="form-control" id="tipo"
                            aria-label="Default select example">
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                            <option value="devolucion">Devolucion</option>
                        </select>
                        @error('tipo')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Detalle</label>
                        <input type="text" class="form-control" wire:model.lazy="detalle" id="nombreproducto"
                            placeholder="detalle...">


                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Cantidad</label>
                        <input type="email" class="form-control" id="cantidad" wire:model.lazy="cantidad"
                            placeholder="entrada fisica...">
                        @error('cantidad')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Valor</label>
                        <input type="email" class="form-control" id="valor" wire:model.lazy="valor"
                            placeholder="entrada boliviano ...">

                        @error('valor')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary" wire:click="store">Guardar</button>

                </div>
            </div>
        </div>
    </div>

</div>
