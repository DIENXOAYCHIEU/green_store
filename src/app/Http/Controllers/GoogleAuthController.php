<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Account;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Throwable;
use function Symfony\Component\Clock\now;

class GoogleAuthController extends BaseController
{
    /**
     * Redirect the user to Google’s OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect('/login')->with('error', 'Google authentication failed.');
        }

        $existingUser = Account::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = Account::create([
                'username' => $user->getName() ?? 'user_' . Str::random(5),
                'email' => $user->getEmail(),
                'phone' => null,
                'password' => null,
                'email_verified_at' => now(),
                'avatar' => $user->getAvatar(),
                'role_id' => 1
            ]);

            Auth::login($newUser);
        }
        if(empty(Auth::user()->password) || Auth::user()->password == null){
            return redirect('/password');
        }
        return redirect('/');
    }
}