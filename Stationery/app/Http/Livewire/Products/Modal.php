<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Http\Livewire\Forms\ProductsForm;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\State;
use App\Models\Supplier;

class Modal extends Component
{
    public ProductsForm $form;
    public $ProductId;
    public $categorieData;
    public $stateData;
    public $supplierData;

    protected $listeners = ['editProduct','deleteProduct'];

    public function mount()
    {
        $ProductId = null;
        $this->categorieData = Categorie::all();
        $this->stateData = State::all();
        $this->supplierData = Supplier::all();
        $this->form->setProduct(new Product());

    }

    public function editProduct($id): void
    {
        $this->ProductId = $id;
        $this->form->setProduct(Product::findOrFail($id));
        $this->dispatch('showModal');
    }

    public function deleteProduct($id): void
    {
        $this->ProductId = $id;
        Product::findOrFail($this->ProductId)->delete();
        $this->dispatch('RefreshTable');

    }

    public function save(): void
    {
        $this->form->save();
        $this->dispatch('RefreshTable');
        $this->dispatch('hideModal');
    }

    public function cancel(): void
	{
        $this->form->cancel(); 
	}

    public function render()
    {
        return view('livewire.products.modal');
    }
}
