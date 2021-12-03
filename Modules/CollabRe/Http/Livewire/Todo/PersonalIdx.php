<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;

class PersonalIdx extends Component
{
    public $listId;
    public function render()
    {
        return view('collabre::livewire.todo.personal-idx', ['list_id' => $this->listId])->layout('adminlte::page');
    }

    public function mount($list_id){
        $this->listId = $list_id;
    }
}