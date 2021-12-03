<?php

namespace Modules\ArSys\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Role;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Student;
use Auth;
class ArSysController extends Controller
{
    public function index()
    {
        $user = User::where('sso_username', cas()->user())->first();
        if($user == null){
            if (strlen(cas()->user()) > 7){

                $user = User::create([
                    'sso_username' => cas()->user(),
                ]);
                if(cas()->user() == '197608272009121001'){
                    $user->attachRole('admin');
                    $user->attachRole('faculty');
                }else{
                    $user->attachRole('faculty');
                }
                $faculty = Faculty::where('sso_username', cas()->user())->first();
                if($faculty != null){
                    $user->update([
                        'name' => $faculty->code,
                    ]);

                    $faculty->update([
                        'user_id' => $user->id,
                    ]);
                }

            }else{
                $user = User::create([
                    'name' => 's'.cas()->user(),
                    'sso_username' => cas()->user()
                ]);
                $user->attachRole('student');
                $student = Student::where('code', $user->name)->first();
                if($student == null){
                    return redirect()->route('arsys.profile.student');
                }else{
                    $student->update([
                        'user_id' => $user->id,
                    ]);
                }
            }
        }

        $user = User::where('sso_username', cas()->user())->firstorfail();
        Auth::login($user);

        return redirect()->route('arsys.home');

    }

    public function indexx(){
        $user = User::where('sso_username', '197608272009121001')->firstorfail();
        Auth::login($user);
        return redirect()->route('arsys.home');
    }



   public function home(){

        $user = Auth::user();

        if ($user != null && $user->hasRole('student')){


            return view('arsys::student');
        }elseif ($user != null && $user->hasRole('faculty')){

            return view('arsys::faculty');
        }elseif ($user != null && $user->hasRole('admin')){
            return view('arsys::admin');
        }
   }


   public function logout(){
    \Session::flush();
    cas()->logout();
    return redirect('/');
   }
}
