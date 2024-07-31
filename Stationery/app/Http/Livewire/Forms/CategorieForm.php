<?php

namespace App\Http\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use App\Models\Categorie;

class CategorieForm extends Form
{
    public ?Categorie $categorie;

    public $id = '';

    #[Validate('required|max:100', translate: true)]
    public $name = '';

    public function setCategorie(Categorie $categorie): void
    {
        $this->categorie = $categorie;
        $this->id = $categorie->id;
        $this->name = $categorie->name;
    }

    public function save()
    {
        $this->validate();
        if (!is_null($this->categorie->id)) {
            $this->categorie->update([
                'name' => $this->name,
            ]);
        } else {
            Categorie::create([
                'id' => Str::uuid(),
                'name' => $this->name,
            ]);
        }
        $this->cancel();
    }

    public function reset(...$properties)
    {
        if (empty($properties)) {
            $this->id = '';
            $this->name = '';
            $this->categorie = new Categorie();
        } else {
            foreach ($properties as $property) {
                $this->{$property} = null;
            }
        }
    }

    public function cancel()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
