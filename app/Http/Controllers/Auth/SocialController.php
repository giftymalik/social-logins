<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\SocialAccount;

class SocialController extends Controller
{
    public function redirect($channel)
    {
        if (! in_array($channel, ['facebook', 'google'])) {
            return redirect('/login')->with('channel-error', 'Channel not supported');
        }

        return \Socialite::driver($channel)->redirect();
    }

    public function callback($channel, SocialAccount $service)
    {
        $user = $service->fetchUser($channel, \Socialite::driver($channel)->user());

        auth()->login($user);

        return redirect()->to('/home');
    }
}
