<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class Home extends Component
{
    public $model;
    public $methods = ['editProduct','deleteProduct'];

    public function mount(){
        $this->model = new Product;
    }
    public function render()
    {
        return view('livewire.products.home');
    }
}
