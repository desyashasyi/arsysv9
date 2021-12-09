<?php

namespace Modules\ArSys\Http\Livewire\Todo;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Todo;
use Auth;


class Create extends Component
{
    use WithFileUploads;
    public $researchId;
    public $todoDuedate;
    public $todoTitle;
    public $todoNotes;
    public $todoFile;
    public $todoUrl;
    public $user;
    public $creator;
    public $creatorType;
    public $filename;

    protected $listeners = ['createTodoComponent' => 'createTodo',
                            'todoCompleted' => 'todoCompleted',
                            'todoUncompleted' => 'todoUncompleted'];

    public function mount(){
    }

    public function render()
    {
        return view('arsys::livewire.todo.create');
    }

    public function createTodo($id){
       
        $this->emit('createTodoModal');
    }

    
}
