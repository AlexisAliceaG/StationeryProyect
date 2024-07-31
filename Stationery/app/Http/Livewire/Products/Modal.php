<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Http\Livewire\Forms\ProductsForm;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\State;
use App\Models\Supplier;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Modal extends Component
{
    use WithFileUploads;
    public ProductsForm $form;
    public $ProductId;
    public $categorieData;
    public $stateData;
    public $supplierData;
    public $image_url;

    protected $listeners = ['editProduct', 'deleteProduct'];

    public function mount()
    {
        $ProductId = null;
        $this->image_url = 'uploads/default.png';
        $this->categorieData = Categorie::all();
        $this->stateData = State::all();
        $this->supplierData = Supplier::all();
        $this->form->setProduct(new Product());
    }

    public function editProduct($id): void
    {
        $this->ProductId = $id;
        $this->form->setProduct(Product::findOrFail($id));
        $this->image_url = $this->form->image_url;
        $this->dispatch('editImage', ['image_url' => asset('storage/' . $this->form->image_url)]);
        $this->dispatch('showModal');
    }

    public function deleteProduct($id): void
    {
        $this->ProductId = $id;
        $this->dispatch('addDelete');
    }

    public function deleteConfirm(): void
    {
        Product::findOrFail($this->ProductId)->delete();
        $this->dispatch('RefreshCard');
    }

    public function save(): void
    {
        if ($this->image_url != 'uploads/default.png' && !Storage::exists('public/' . $this->image_url)) {
            $this->form->image_url = $this->image_url->store('uploads', 'public');
        }
        $this->form->save();
        $this->dispatch('RefreshCard');
        $this->dispatch('hideModal');
        if ($this->ProductId) {
            $this->dispatch('EditSuccess');
        } else {
            $this->dispatch('addSuccess');
        }
        $this->ProductId = null;
    }

    public function cancel(): void
    {
        $this->dispatch('resetImage', ['image_url' => asset('storage/uploads/default.png')]);
        $this->form->cancel();
    }

    public function render()
    {
        return view('livewire.products.modal');
    }
}
