<?php

namespace App\Http\Livewire\States;

use Livewire\Component;
use App\Models\State;

class Home extends Component
{
    public array $headers;
    public $model;
    public string $direction;
    public array $sortBy;
    public int $pagination;
    public $methods;
    public $selectedStateId;

    public function mount(){
        $this->search = '';
		$this->sortBy = ['name'];
		$this->direction = 'ASC';
		$this->pagination = 5;
        $this->model = new State;
        $this->methods = ['editState','deleteState'];
        $this->headers = [
			'id' => ['hide' => true, 'cripted' => true,'search'=> false,'sort'=>false],
			'name'  => ['hide' => false, 'label' => 'Nombre','search'=> true,'sort'=>true],
		];
    }

    public function render()
    {
        return view('livewire.states.home');
    }
}
