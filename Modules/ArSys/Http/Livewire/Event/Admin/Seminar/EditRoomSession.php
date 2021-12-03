<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;

class EditRoomSession extends Component
{
    protected $listeners = ['eventAdminSeminarEditRoomSession' => 'editSession'];
    public function render()
    {
        return view('arsys::livewire.event.admin.seminar.edit-room-session');
    }

    public function editSession(){
        dd('here');
    }
}
