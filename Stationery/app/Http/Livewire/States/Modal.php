<?php

namespace App\Http\Livewire\States;

use App\Http\Livewire\Forms\StateForm;
use Livewire\Component;
use App\Models\State;

class Modal extends Component
{
    public StateForm $form;
    public $stateId;
    protected $listeners = ['editState','deleteState'];
    public function mount()
    {
        $stateId = null;
        $this->form->setState(new State());

    }
    public function editState($id): void
    {
        $this->stateId = $id;
        $this->form->setState(State::findOrFail($id));
        $this->dispatch('showModal');
    }

    public function deleteState($id): void
    {
        $this->stateId = $id;        
        $this->dispatch('addDelete');
    }
    
    public function deleteConfirm(): void
    {
        State::findOrFail($this->stateId)->delete();
        $this->dispatch('RefreshTable');
    }

    public function save(): void
    {
        $this->form->save();
        $this->dispatch('RefreshTable');
        $this->dispatch('hideModal');
        if($this->stateId){
            $this->dispatch('EditSuccess');
        }else{
            $this->dispatch('addSuccess');            
        }
        $this->stateId = null;
    }

    public function cancel(): void
	{
        $this->form->cancel(); 
	}

    public function render()
    {
        return view('livewire.states.modal');
    }
}
