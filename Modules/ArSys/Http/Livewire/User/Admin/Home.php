<?php

namespace Modules\ArSys\Http\Livewire\User\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use App\Models\User;
use App\Models\Role;
use Modules\ArSys\Entities\Faculty;

class Home extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $faculty;
    public $userID;
    public $modalAssignRole = null;
    public $facultyID;

    public function render()
    {

        $users = User::orderBy('name', 'ASC')->paginate(10);

        $roles = Role::all();

        if($this->search != null){
            $users = User::where('name','like', '%'.$this->search.'%')

            ->orWhereHas('faculty', function($query){
                $query->where('first_name','like', '%'.$this->search.'%');
            })
            ->orWhereHas('student', function($query){
                $query->where('first_name','like', '%'.$this->search.'%');
            })
            ->orderBy('name', 'ASC')
            ->paginate(10);
        }

        if($this->modalAssignRole){
            $this->faculty = Faculty::where('id', $this->facultyID)->first();
        }

        return view('arsys::livewire.user.admin.home', compact('users','roles'));
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

    public function assignRole($faculty_id, $user_id){
        $this->facultyID = $faculty_id;
        $this->modalAssignRole = true;
        $this->userID = $user_id;
    }

    public function addRole($role_id){
        $role = Role::where('id', $role_id)->first();
        $user = User::find($this->userID);

        $user->attachRole($role->name);
    }

    public function removeRole($role_id){
        $role = Role::where('id', $role_id)->first();
        $user = User::find($this->userID);

        $user->detachRole($role->name);
    }
}
