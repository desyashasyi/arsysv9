<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;

class ViewIdx extends Component
{
    public $todoId;
    public function render()
    {
        return view('collabre::livewire.todo.view-idx', ['todo_id' => $this->todoId])->layout('adminlte::page');
    }

    public function mount($todo_id){
        $this->todoId = $todo_id;
    }
}
