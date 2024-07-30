<div>
    <div class="form-group text-center">
        <label for="products">Agregar Productos</label>
        <div class="form-group col-12 row">
            <div class="col-md-6">
                <select wire:model="selectedProduct" class="form-control mt-2 @error('selectedProduct') is-invalid @enderror">
                    <option value="">Selecciona un Producto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('selectedProduct')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <input type="number" wire:model="productQuantities" class="form-control mt-2 @error('productQuantities') is-invalid @enderror" placeholder="Cantidad">
                @error('productQuantities')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <button type="button" wire:click="addProduct" class="btn btn-primary col-12 mt-2">Agregar</button>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="saveSale">
        <div class="form-group table-responsive text-center">
            <label for="selectedProducts">Productos Seleccionados</label>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($quantities))
                        <tr>
                            <td colspan="4">
                                No hay productos seleccionados.
                            </td>
                        </tr>
                    @else
                        @foreach ($quantities as $item)
                            @php
                                $product = $products->find($item['productId']);
                            @endphp
                            @if ($product)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $product->name }}"
                                            disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $item['quantity'] }}"
                                            disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $product->price }}"
                                            disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            value="{{ $product->price * $item['quantity'] }}" disabled>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="text-center">
                <strong>Total</strong>
            </div>
            <input type="text" class="form-control col-4 mr-auto ml-auto text-center" style="font-weight: bold" value="{{ $total }}" disabled>
        </div>

        <!-- Row for Save Button -->
        <div class="row mb-2">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Guardar Venta</button>
            </div>
        </div>

        <!-- Row for Cancel Button -->
        <div class="row">
            <div class="col text-center">
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancelar</button>
            </div>
        </div>
    </form>
</div>
