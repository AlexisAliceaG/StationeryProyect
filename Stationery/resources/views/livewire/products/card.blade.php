<div class="container my-3">
    <div class="row">
        @forelse ($data as $index => $row)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img id="image" class="card-img-top" src="{{ asset('storage/' . $row->image_url) }}"
                        alt="{{ $row->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <h5 class="card-title p-2" style="font-weight: bold">{{ $row->name }}</h5>
                            </div>
                            <div class="col-3">
                                <h5 class="card-title rounded-pill p-2 bg-primary" style="font-weight: bold;">
                                    ${{ $row->price }}</h5>
                            </div>
                        </div>
                        <p class="card-text text-wrap h-25">{{ $row->description }}</p>
                        <p class="card-text rounded-pill p-2 text-center bg-primary" style="font-weight: bold;">
                            {{ $row->stock_quantity }} piezas</p>
                        <div class="row">
                            <div class="col-9">
                                <x-adminlte-button name="Edit" class="m-2 bg-primary rounded-circle" icon="fas fa-pencil-alt"
                                    wire:click="edit('{{ $row->id }}')" />
                            </div>
                            <div class="col-3">
                                <x-adminlte-button name="Delete" class="m-2 bg-primary rounded-circle" icon="fas fa-trash"
                                    wire:click="delete('{{ $row->id }}')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center" role="alert">
                    No hay productos disponibles en este momento.
                </div>
            </div>
        @endforelse
    </div>
</div>
