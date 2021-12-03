<?php

namespace Modules\CollabRe\Http\Livewire\Todo;

use Livewire\Component;

class DirectoryIdx extends Component
{
    public $collabreId;
    public function render()
    {
        return view('collabre::livewire.todo.directory-idx', ['collabre_id' => $this->collabreId])->layout('adminlte::page');
    }
    public function mount($collabre_id){
        $this->collabreId = $collabre_id;
    }
}
