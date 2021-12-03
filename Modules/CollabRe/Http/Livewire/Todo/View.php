<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;
use Modules\CollabRe\Entities\CollabreTodo;

class View extends Component
{
    public $todoId;
    public function render()
    {
        $todo = CollabreTodo::where('id', $this->todoId)->first();
        return view('collabre::livewire.todo.view', compact('todo'));
    }

    public function mount($todo_id){
        $this->todoId = $todo_id;
    }
}
