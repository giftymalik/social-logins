<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    public function redirect($channel)
    {
        if (! in_array($channel, ['facebook', 'google'])) {
            return redirect('/login')->with('channel-error', 'Channel not supported');
        }

        return \Socialite::driver($channel)->redirect();
    }

    public function callback($channel)
    {
        return \Socialite::driver($channel)->user()->getEmail();
    }
}
