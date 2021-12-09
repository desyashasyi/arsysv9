<?php

namespace Modules\ArSys\Http\Livewire\Todo;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Todo;
use Auth;


class CreateB extends Component
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

    /*protected $listeners = ['createTodoComponent' => 'createTodo',
                            'todoCompleted' => 'todoCompleted',
                            'todoUncompleted' => 'todoUncompleted'];
                            */

    public function mount(){
    }

    public function render()
    {
        return view('arsys::livewire.todo.create');
    }

    public function createTodo($id){
        $this->todoNotes = '';
        $this->todoTitle = '';
        $this->todoFile = '';
        $this->todoUrl = '';
        $this->researchId = $id;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('createTodoModal');
    }

    public function todoStore(){

        $url = $this->validate_url($this->todoUrl);
        if($this->todoUrl != null){
            if(!$url){
                $this->validate([
                    'todoUrl' => "url",
                ]);
            }
        }

        if($this->todoFile != null){
            $this->validate([
                'todoFile' => "required|mimetypes:application/pdf|max:10000",
            ]);
            $this->ilename = $this->todoFile->store('todo', 'public');
        }

        $this->validate([
            'todoNotes' => 'required',
            'todoTitle' => 'required',
            'todoDuedate' => 'required',
        ]);

        if($this->user->sso_username > 8){
            $this->creator = $this->user->faculty->id;
            $this->creatorType = 1;
        }else{
            $this->creator = $this->user->student->id;
            $this->creatorType = 2;
        }


        Todo::create([
            'todo_title' => $this->todoTitle,
            'todo_notes' => $this->todoNotes,
            'todo_duedate' => $this->todoDuedate,
            'research_id' => $this->researchId,
            'creator_id' => $this->creator,
            'creator_type' => $this->creatorType,
            'document_file' => $this->filename,
            'document_url' => $this->todoUrl,
        ]);
        session()->flash('success', 'Research todo has been successfully created');
        $this->emit('refreshResearchIndex');
    }

    public function todoCompleted($id){
        Todo::where('id', $id)->update([
            'completed' => true,
        ]);
        $this->emit('refreshResearchIndex');
    }

    public function todoUncompleted($id){
        Todo::where('id', $id)->update([
            'completed' => false,
        ]);
        $this->emit('refreshResearchIndex');
    }

    function validate_url( $url ) {
        $url = trim( $url );

        return (
            ( strpos( $url, 'http://' ) === 0 || strpos( $url, 'https://' ) === 0 ) &&
            filter_var(
                $url,
                FILTER_VALIDATE_URL,
                FILTER_FLAG_SCHEME_REQUIRED || FILTER_FLAG_HOST_REQUIRED
            ) !== false
        );
    }
    public function closeModal(){
    }
}
