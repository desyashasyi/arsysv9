<?php

namespace Modules\ArSys\Http\Livewire\Config\Admin;

use Livewire\Component;

class AddConfig extends Component
{
    public $listeners = ['emiterConfigAdminAddConfig' => 'addConfig'];
    public function render()
    {
        return view('arsys::livewire.config.admin.add-config');
    }

    public function addConfig(){
        $this->emit('configAdminAddModal');
    }
}
