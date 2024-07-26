<div>
    <form wire:submit.prevent="saveSale">
        <div class="form-group">
            <label for="saleDate">Fecha</label>
            <input type="date" wire:model="saleDate" class="form-control @error('saleDate') is-invalid @enderror">
            @error('saleDate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="products">Productos</label>
            @foreach ($products as $product)
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                    </div>
                    <div class="col-md-3">
                        <input type="number" wire:model.live="quantities.{{ $product->id }}" class="form-control" placeholder="Cantidad">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{ $product->price }}" disabled>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" value="{{ $total }}" disabled>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Venta</button>
    </form>
</div>
