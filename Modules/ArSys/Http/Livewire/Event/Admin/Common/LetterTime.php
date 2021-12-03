<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Common;

use Livewire\Component;

class LetterTime extends Component
{
    public $openingDate;
    public $openingTime;
    protected $listeners = ['letterTimeComponent' => 'letterTime'];
    public function render()
    {
        return view('arsys::livewire.event.admin.common.letter-time');
    }

    public function letterTime($letter_id){
        $this->emit('eventLetterTimeModal');
    }

    public function closeModal(){

    }
}
