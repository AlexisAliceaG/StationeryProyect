<?php

namespace App\Http\Livewire\Suppliers;

use App\Http\Livewire\Forms\SupplierForm;
use Livewire\Component;
use App\Models\Supplier;

class Modal extends Component
{
    public SupplierForm $form;
    public $supplierId;
    protected $listeners = ['editSupplier','deleteSupplier'];
    public function mount()
    {
        $supplierId = null;
        $this->form->setSupplier(new Supplier());

    }
    public function editSupplier($id): void
    {
        $this->supplierId = $id;
        $this->form->setSupplier(Supplier::findOrFail($id));
        $this->dispatch('showModal');
    }

    public function deleteSupplier($id): void
    {
        $this->supplierId = $id;
        Supplier::findOrFail($this->supplierId)->delete();
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
        return view('livewire.suppliers.modal');
    }
}
