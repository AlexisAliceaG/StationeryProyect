<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public array $headers;
    public $search;
    public $sortBy;
    public $direction;
    public $model;
    public $pagination;
    public $methods;

    protected $listeners = ['RefreshTable' => '$refresh'];

    public function mount($model)
    {
        $this->model = $model;
    }

    public function render()
    {
        $query = $this->model::query();

        foreach ($this->headers as $field => $attributes) {
            if ($attributes['search'] && !empty($this->search)) {
                $query->Orwhere($field, 'like', '%' . $this->search . '%');
            }
        }

        foreach ($this->sortBy as $field) {
            if ($this->headers[$field]['sort'] ?? false) {
                $query->orderBy($field, $this->direction);
            }
        }

        $data = $query->paginate($this->pagination);

        return view('livewire.components.table', [
            'data' => $data,
        ]);
    }

    public function sort($column): void
    {
        if (in_array($column, $this->sortBy)) {
            $this->direction = ($this->direction == 'ASC' ? 'DESC' : 'ASC');
            return;
        }
        $this->sortBy = [$column];
        $this->direction = 'ASC';
    }

    public function edit($id)
    {
        $this->dispatch($this->methods[0], $id);
    }

    public function delete($id)
    {
        $this->dispatch($this->methods[1], $id);
    }
}
