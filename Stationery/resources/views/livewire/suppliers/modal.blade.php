<div class="col-12 row">
    <x-adminlte-button name="triggerModal" data-toggle="modal" data-target="#add" class="m-2 bg-primary" icon="fas fa-plus"
        label="Crear Proveedor" />

    <div wire:ignore.self class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="Supplier modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Proveedor</h5>
                    <button type="button" class="close" wire:click="cancel" aria-label="Close" label="Dismiss"
                        data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit="save">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="inputName" class="form-label">Nombre del Provedor</label>
                                <input type="text" wire:model.live="form.name"
                                    class="form-control form-control-lg @error('form.name') is-invalid @enderror"
                                    placeholder="Agregue un nombre...">
                                @error('form.name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName" class="form-label">Nombre del Administrador</label>
                                <input type="text" wire:model.live="form.manager"
                                    class="form-control form-control-lg @error('form.manager') is-invalid @enderror"
                                    placeholder="Agregue un Administrador...">
                                @error('form.manager')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName" class="form-label">Correo</label>
                                <input type="text" wire:model.live="form.email"
                                    class="form-control form-control-lg @error('form.email') is-invalid @enderror"
                                    placeholder="Agregue un Correo...">
                                @error('form.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName" class="form-label">Telefono</label>
                                <input type="text" wire:model.live="form.phone"
                                    class="form-control form-control-lg @error('form.phone') is-invalid @enderror"
                                    placeholder="Agregue un Telefono...">
                                @error('form.phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="inputName" class="form-label">Dirección</label>
                                <input type="text" wire:model.live="form.address"
                                    class="form-control form-control-lg @error('form.address') is-invalid @enderror"
                                    placeholder="Agregue un Dirección...">
                                @error('form.address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="cancel" class="btn btn-secondary" label="Dismiss"
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
            $('#add').modal('toggle');
        });
    </script>
@endpush
