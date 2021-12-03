<?php

namespace Modules\ArSys\Http\Livewire\Profile\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Student;
use Auth;

class Home extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(){
    }
    public function render()
    {
        $user = Auth::user();
        $profile = Student::where('code', $user->name)->first();

        return view('arsys::livewire.profile.student.home', compact('profile'));
    }


}
