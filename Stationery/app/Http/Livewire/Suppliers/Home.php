<?php

namespace App\Http\Livewire\Suppliers;

use Livewire\Component;
use App\Models\Supplier;

class Home extends Component
{
    public array $headers;
    public $model;
    public string $direction;
    public array $sortBy;
    public int $pagination;
    public $methods;
    public $selectedSupplierId;

    public function mount(){
        $this->search = '';
		$this->sortBy = ['name','manager', 'email','phone', 'address'];
		$this->direction = 'ASC';
		$this->pagination = 5;
        $this->model = new Supplier;
        $this->methods = ['editSupplier','deleteSupplier'];
        $this->headers = [
			'id' => ['hide' => true, 'cripted' => true,'search'=> false,'sort'=>false],
			'name'  => ['hide' => false, 'label' => 'Nombre','search'=> true,'sort'=>true],
            'manager'  => ['hide' => false, 'label' => 'Administrador','search'=> true,'sort'=>true],
            'email'  => ['hide' => false, 'label' => 'Correo','search'=> true,'sort'=>true],
            'phone'  => ['hide' => false, 'label' => 'Telefono','search'=> true,'sort'=>true],
            'address'  => ['hide' => false, 'label' => 'Dirección','search'=> true,'sort'=>true],
		];
    }
    public function render()
    {
        return view('livewire.suppliers.home');
    }
}
