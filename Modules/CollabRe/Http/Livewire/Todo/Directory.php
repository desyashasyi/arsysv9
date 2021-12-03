<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;
use Modules\Collabre\Entities\CollabreTodoList;
use Modules\Collabre\Entities\Collabre;
use Modules\Collabre\Entities\CollabreTodo;
use Livewire\WithPagination;
use Auth;
use Modules\CollabRe\Http\Livewire\Editor\Trix; 
class Directory extends Component
{
    public $newListFlag;
    public $newList;
    public $collabreId;
    public $addTodo;
    public $listId;
    public $description;
    public $enableTrixEditor;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $listeners = ['todoSaveEmitter' => 'todoSave',  Trix::EVENT_VALUE_UPDATED];// trix_value_updated()];
   

    public function trix_value_updated($value){
        $this->description = $value;
    }
    public function render()
    {
        $todoLists;
        if($this->collabreId){
            $todoLists = CollabreTodoList::where('collabre_id',$this->collabreId)->get();
        }
        $collabre = Collabre::where('id', $this->collabreId)->first();
        return view('collabre::livewire.todo.directory', compact('todoLists', 'collabre'))->layout('adminlte::page');
    }

    public function mount($collabre_id){
        $this->collabreId = $collabre_id;
    }
    public function enableNewList(){
        $this->newListFlag = true;
        $this->disableTodo();
        
    }

    public function disableNewList(){
        $this->newListFlag = false;
        $this->enableTrixEditor = false;
    }

    
    public function submitNewList(){
        $this->validate([
            'newList' => 'required',
        ]);

        $description = null;
        if($this->description){
            $description = $this->description;
        }

        $creatorRole = null;
        $creatorId = null;
        if(strlen(Auth::user()->sso_username > 7)){
            $creatorRole = 1;
            $creatorId=Auth::user()->faculty->id;
        }else{
            $creatorRole = 2;
            $creatorId=Auth::user()->student->id;
        }

        CollabreTodoList::create([
            'collabre_id' => $this->collabreId,
            'title' => $this->newList,
            'creator_id' => Auth::user()->id,
            'description' =>  $description,
            'creator_id' => $creatorId,
            'creator_role' => $creatorRole,
        ]);
        $this->newListFlag = false;
        //return redirect()->route('collabre.todo.new-list')
    }

    public function enableTrixEditor(){
        $this->enableTrixEditor = true;
    }

    public function personalTodo($id){
        return redirect()->route('collabre.todo.personal', ['list_id' => $id]);
    }

    public function enableTodo($list_id){
        $this->addTodo = true;
        $this->listId = $list_id;
        $this->disableNewList();
    }
    public function disableTodo(){
        $this->addTodo= false;
        $this->listId = null;
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
