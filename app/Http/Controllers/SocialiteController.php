<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback( ){
        $userFormGoogle = Socialite::driver('google')->stateless()->user();
    }
}
