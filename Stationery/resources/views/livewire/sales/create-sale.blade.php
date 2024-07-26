<div>
    <div class="form-group">
        <label for="products">Agregar Productos</label>
        <div class="form-group row">
            <div class="col-md-6">
                <select wire:model="selectedProduct" class="form-control @error('selectedProduct') is-invalid @enderror">
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
                <input type="number" wire:model="productQuantities" class="form-control" placeholder="Cantidad">
            </div>
            <div class="col-md-3">
                <button type="button" wire:click="addProduct" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="saveSale">
        <div class="form-group">
            <label for="selectedProducts">Productos Seleccionados</label>
            @if (empty($quantities))
                <div class="text-center">
                    No hay productos seleccionados.
                </div>
            @else
                @foreach ($quantities as $item)
                    @php
                        $product = $products->find($item['productId']);
                    @endphp
                    @if ($product)
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $item['quantity'] }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $product->price }}" disabled>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" value="{{ $product->price * $item['quantity'] }}" disabled>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" value="{{ $total }}" disabled>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Venta</button>
    </form>
</div>
