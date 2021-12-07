<?php

namespace Modules\ArSys\Http\Livewire\User\Specialization;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use App\Models\User;

class LoginAs extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $userID;
 
    public function render()
    {

        $users = User::whereHas('student', function($query){
                    $query->where('specialization_id', Auth::user()->faculty->specialization_id);
                })
                ->orderBy('name', 'ASC')
                ->paginate(10);


        if($this->search != null){
            $users = User::where('name','like', '%'.$this->search.'%')

                    ->whereHas('student', function($query){
                        $query->where('first_name','like', '%'.$this->search.'%')
                                ->where('specialization_id', Auth::user()->faculty->specialization_id);
                    })
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
        }
        return view('arsys::livewire.user.specialization.login-as', compact('users'));
    }

    public function loginAs($user_id){

        //$user = User::where('id', $user_id)->first();
        $user = User::where('id', $user_id)->firstorfail();
        Auth::login($user);
        //toast('Login as '.$user->name.'-'.$user->roles->first()->display_name.'success','success');
        /*$this->alert(
            'success',
            'Login as '.$user->name.' success'
        );
        */
        return redirect()->route('arsys.home');
    }
   
}
