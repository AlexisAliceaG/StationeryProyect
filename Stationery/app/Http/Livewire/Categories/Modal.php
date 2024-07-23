<?php

namespace App\Http\Livewire\Categories;

use App\Http\Livewire\Forms\CategorieForm;
use Livewire\Component;
use App\Models\Categorie;

class Modal extends Component
{
    public CategorieForm $form;
    public $categorieId;
    protected $listeners = ['editCategorie','deleteCategorie'];

    public function mount()
    {
        $categorieId = null;
        $this->form->setCategorie(new Categorie());

    }
    public function editCategorie($id): void
    {
        $this->CategorieId = $id;
        $this->form->setCategorie(Categorie::findOrFail($id));
        $this->dispatch('showModal');
    }

    public function deleteCategorie($id): void
    {
        $this->categorieId = $id;
        Categorie::findOrFail($this->categorieId)->delete();
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
        return view('livewire.categories.modal');
    }
}
