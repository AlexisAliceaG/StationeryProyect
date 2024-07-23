<div>
    <div class="col-12">
        <x-adminlte-input wire:model.live="search" name="search" placeholder="search" igroup-size="md"
            fgroup-class="col-12 col-md-6 mr-2 ml-auto">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                @foreach ($headers as $field => $attributes)
                    @if (!$attributes['hide'])
                        <th
                            @if ($attributes['sort']) wire:click="sort('{{ $field }}')" 
                            style="cursor: pointer;"
                            @else
                            style="cursor: default;" @endif>
                            {{ $attributes['label'] ?? ucfirst($field) }}
                            @if (in_array($field, $sortBy))
                                @if ($direction === 'ASC')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </th>
                    @endif
                @endforeach
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $data->firstItem() + $index }}</td>
                    @foreach ($headers as $field => $attributes)
                        @if (!$attributes['hide'])
                            <td>{{ $row->$field }}</td>
                        @endif
                    @endforeach
                    <td style="width: 150px;">
                        <x-adminlte-button name="Edit" class="m-2 bg-info" icon="fas fa-edit"
                            wire:click="edit('{{ $row->id }}')" />
                        <x-adminlte-button name="Delete" class="m-2 bg-danger" icon="fas fa-trash"
                            wire:click="delete('{{ $row->id }}')" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $data->links() }}
    </div>
</div>
