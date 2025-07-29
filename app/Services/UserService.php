<?php

namespace App\Services;

use App\Mail\UserConfirmMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    public function getuser(){
        $data = User::get();
        return $data;
    }
    public function getuserbyid($id){
        $user = User::find($id)->get();
        return $user;
    }
}
