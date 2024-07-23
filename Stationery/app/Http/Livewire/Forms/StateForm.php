<?php

namespace App\Http\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\State;
use Illuminate\Support\Str;

class StateForm extends Form
{
    public ?State $state;

    public $id = '';

    #[Validate('required|max:100', translate: true)]
    public $name = '';

    public function setState(State $state): void
    {
        $this->state = $state;
        $this->id = $state->id;
        $this->name = $state->name;
    }

    public function save()
    {
        $this->validate();
        if (!is_null($this->state->id)) {
            $this->state->update([
                'name' => $this->name,
            ]);
        } else {
            State::create([
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
            $this->state = new State();
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
