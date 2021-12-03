<?php

namespace Modules\ArSys\Http\Livewire\Config\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\ArSysConfig;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $configs = ArSysConfig::paginate(5);
        return view('arsys::livewire.config.admin.home', compact('configs'));
    }

    public function setConfig($id){
        $status = ArSysConfig::where('id', $id)->first()->status;
        $toggle = null;
        if($status)
            $toggle = 0;
        else
            $toggle = 1;
        ArSysConfig::find($id)->update([
            'status' => $toggle,
        ]);
    }
}
