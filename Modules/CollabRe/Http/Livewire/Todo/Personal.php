<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;
use Modules\CollabRe\Entities\CollabreTodoList;
use Modules\CollabRe\Entities\Collabre;
use Modules\CollabRe\Entities\CollabreTodo;
use Auth;

class Personal extends Component
{
    public $listeners = ['disableAddTodo' => 'disableAddTodo', 'todoSaveEmitter' => 'todoSave'];
    public $listId;
    public $addTodo = false;
    public function render()
    {
        $list = CollabreTodoList::where('id', $this->listId)->first();
        $collabre = Collabre::where('id', $list->collabre_id)->first();
        return view('collabre::livewire.todo.personal', compact('list', 'collabre'));
    }
    public function mount($list_id){
        $this->listId = $list_id;
    }

    public function enableTodo(){
        $this->addTodo = true;
    }
    public function disableTodo(){
        $this->addTodo = false;
    }
    public function todoSave($data){
        
        $duedate;
        if($data['endDate'] != null){
            $duedate = $data['startDate'];
        }else{
            $duedate = $data['dueDate'];
        }

        $creatorRole;
        $creatorId;
        if(strlen(Auth::user()->sso_username > 7)){
            $creatorRole = 1;
            $creatorId=Auth::user()->faculty->id;
        }else{
            $creatorRole = 2;
            $creatorId=Auth::user()->student->id;
        }
        CollabreTodo::create([
            'list_id' => $this->listId,
            'title' => $data['title'],
            'dueDate' => $duedate,
            'endDate' => $data['endDate'],
            'notes' => $data['notes'],
            'creator_id' => $creatorId,
            'creator_role' => $creatorRole,

        ]);
        $this->disableTodo();
    }

    public function completeTodo($id, $status){
        CollabreTodo::where('id', $id)->update([
            'completed' => $status,
        ]);
    }

    public function viewTodo($id){
        return redirect()->route('collabre.todo.view', ['todo_id' => $id]);
    }
}