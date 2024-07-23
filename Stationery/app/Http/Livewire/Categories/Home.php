<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Categorie;

class Home extends Component
{
    public array $headers;
    public $model;
    public string $direction;
    public array $sortBy;
    public int $pagination;
    public $methods;
    public $selectedCategorieId;

    public function mount(){
        $this->search = '';
		$this->sortBy = ['name'];
		$this->direction = 'ASC';
		$this->pagination = 5;
        $this->model = new Categorie;
        $this->methods = ['editCategorie','deleteCategorie'];
        $this->headers = [
			'id' => ['hide' => true, 'cripted' => true,'search'=> false,'sort'=>false],
			'name'  => ['hide' => false, 'label' => 'Nombre','search'=> true,'sort'=>true],
		];
    }
    public function render()
    {
        return view('livewire.categories.home');
    }
}
