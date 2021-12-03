<?php

namespace Modules\ArSys\Http\Livewire\User;
use Modules\ArSys\Rules\isValidPassword;

use Livewire\Component;

class MobileActivation extends Component
{
    public $mobileActivation = false;
    public $user = [
        "password" => "",
        "confirm_password" => "",
        "email" => "",
    ];
    public function render()
    {
        return view('arsys::livewire.user.mobile-activation');
    }

    public function activate(){
        $this->mobileActivation = true;
    }

    public function saveLoginCredential(){
        $this->validate([
            'user.password' => [
                                    'required',
                                    'string',
                                    new isValidPassword,
                                ],
            'user.confirm_password' => [
                                            'required',
                                            'string',
                                            new isValidPassword,
                                            'confirmed',
                                        ],
            'user.email' => 'required|email|unique',
        ]);
    }
}
