<?php

namespace App\Http\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;
use App\Models\Supplier;

class SupplierForm extends Form
{
    public ?Supplier $supplier;

    public $id = '';

    #[Validate('required|max:100', translate: true)]
    public $name = '';

    #[Validate('required|max:100', translate: true)]
    public $manager = '';

    #[Validate('required|email|min:10', translate: true)]
    public $email = '';

    #[Validate('required|int', translate: true)]
    public $phone = '';

    #[Validate('required|max:250', translate: true)]
    public $address = '';

    public function setsupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
        $this->id = $supplier->id;
        $this->name = $supplier->name;
        $this->manager = $supplier->manager;
        $this->email = $supplier->email;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
    }

    public function save()
    {
        $this->validate();
        if (!is_null($this->supplier->id)) {
            $this->supplier->update([
                'name' => $this->name,
                'manager' => $this->manager,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
        } else {
            Supplier::create([
                'id' => Str::uuid(),
                'name' => $this->name,
                'manager' => $this->manager,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
        }
        $this->cancel();
    }

    public function reset(...$properties)
    {
        if (empty($properties)) {
            $this->id = '';
            $this->name = '';
            $this->manager = '';
            $this->email = '';
            $this->phone = '';
            $this->address = '';
            $this->supplier = new Supplier();
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
