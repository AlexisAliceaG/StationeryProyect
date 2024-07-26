<div class="col-12 row">
    <x-adminlte-button name="triggerModal" data-toggle="modal" data-target="#add" class="m-2 bg-primary" icon="fas fa-plus"
        label="Crear Producto" />

    <div wire:ignore.self class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="Product modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Producto</h5>
                    <button type="button" class="close" wire:click="cancel" aria-label="Close" label="Dismiss"
                        data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="text-center mb-4" wire:ignore>
                            <div class="form-group">
                                <img id="preview-image" class="d-block w-25 h-25 mr-auto ml-auto"
                                    src="{{ asset('storage/' . $image_url) }}" alt="Imagen de producto">
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="form-label">Imagen del Producto</label>
                                <input type="file" wire:model.live="image_url" id="image-input"
                                    class="form-control @error('form.image_url') is-invalid @enderror"
                                    placeholder="Agregue una imagen...">
                                @error('form.image_url')
                                    <div class="custom-invalid-feedback" style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputName" class="form-label">Nombre del Producto</label>
                                <input type="text" wire:model.live="form.name"
                                    class="form-control @error('form.name') is-invalid @enderror"
                                    placeholder="Agregue un nombre...">
                                @error('form.name')
                                    <div class="custom-invalid-feedback" style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputDescription" class="form-label">Descripción del Producto</label>
                                <input type="text" wire:model.live="form.description"
                                    class="form-control @error('form.description') is-invalid @enderror"
                                    placeholder="Agregue una descripción...">
                                @error('form.description')
                                    <div class="custom-invalid-feedback" style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPrice" class="form-label">Precio del Producto</label>
                                <input type="number" min="0" step="0.01"  wire:model.live="form.price"
                                    class="form-control @error('form.price') is-invalid @enderror"
                                    placeholder="Agregue un precio...">
                                @error('form.price')
                                    <div class="custom-invalid-feedback" style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStock" class="form-label">Inventario del Producto</label>
                                <input type="number" min="0" wire:model.live="form.stock_quantity"
                                    class="form-control @error('form.stock_quantity') is-invalid @enderror"
                                    placeholder="Agregue un inventario...">
                                @error('form.stock_quantity')
                                    <div class="custom-invalid-feedback" style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCategorie">Categoría</label>
                                <select class="custom-select @error('form.categorie_id') is-invalid @enderror"
                                    wire:model.live="form.categorie_id">
                                    <option value="">Selecciona una Categoría</option>
                                    @foreach ($categorieData as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @error('form.categorie_id')
                                    <span class="custom-invalid-feedback" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Estado</label>
                                <select class="custom-select @error('form.state_id') is-invalid @enderror"
                                    wire:model.live="form.state_id">
                                    <option value="">Selecciona un Estado</option>
                                    @foreach ($stateData as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @error('form.state_id')
                                    <span class="custom-invalid-feedback" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputSupplier">Proveedor</label>
                                <select class="custom-select @error('form.supplier_id') is-invalid @enderror"
                                    wire:model.live="form.supplier_id">
                                    <option value="">Selecciona un Proveedor</option>
                                    @foreach ($supplierData as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @error('form.supplier_id')
                                    <span class="custom-invalid-feedback" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="cancel" class="btn btn-secondary"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        window.addEventListener('showModal', event => {
            $('#add').modal('show');
        });
        window.addEventListener('hideModal', event => {
            $('#add').modal('hide');
        });

        document.getElementById('image-input').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        window.addEventListener('resetImage', event => {
            document.getElementById('preview-image').src = event.detail[0].image_url;
            document.getElementById('image-input').value = null;
        });
        window.addEventListener('editImage', event => {
            document.getElementById('preview-image').src = event.detail[0].image_url;
        });
    </script>
@endpush
