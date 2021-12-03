<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;
use Modules\CollabRe\Http\Livewire\Editor\Trix; 

class Add extends Component
{
    public $title;
    public $notes;
    public $dueDateEnable;
    public $dueDate;
    public $startDate;
    public $endDate;
    public $enableTrixEditor;
    public $dueOrNo;
    public function render()
    {
        return view('collabre::livewire.todo.add');
    }

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED // trix_value_updated()
    ];

    public function trix_value_updated($value){
        $this->notes = $value;
    }

    public function enableTrixEditor(){
        $this->enableTrixEditor = true;
    }

    public function save(){
        
        if($this->dueOrNo == 1){
            $this->validate([
                'dueDate' => 'required',
                'title' => 'required',
            ]);
        }

        if($this->dueOrNo == 2){
            $this->validate([
                'startDate' => 'required',
                'endDate' => 'required',
                'title' => 'required',
            ]);
        }else{
            $this->validate([
                'title' => 'required',
            ]);
        }
        
        
        //dd($this->title, $this->dueDate, $this->startDate, $this->endDate, $this->notes);

        $this->emitUp('todoSaveEmitter', ['title' => $this->title, 'dueDate' => $this->dueDate, 'starDate' => $this->startDate, 'endDate' => $this->endDate, 'notes' => $this->notes]);
    }

    public function dueDateSelector(){
        if($this->dueDateEnable == true){
            $this->dueDateEnable = false;
        }
        else{
            $this->dueDateEnable = true;
        }
    }

    public function clearDueDate(){
        $this->dueDate = null;
    }

    public function clearEndDate(){
        $this->endDate = null;
    }

    public function checkDueOrNo(){
        //dd($this->dueOrNo);
    }
}
