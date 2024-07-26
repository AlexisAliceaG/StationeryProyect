<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class Card extends Component
{
    public $model;
    public $methods;

    protected $listeners = ['RefreshCard' => '$refresh'];


    public function mount($model)
    {
        $this->model = $model;
    }

    public function edit($id)
    {
        $this->dispatch($this->methods[0], $id);
    }

    public function delete($id)
    {
        $this->dispatch($this->methods[1], $id);
    }

    public function render()
    {
        $data = $this->model::all();
        return view('livewire.products.card', [
            'data' => $data,
        ]);
    }
}
