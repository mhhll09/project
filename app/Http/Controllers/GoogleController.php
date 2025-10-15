<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\{client, catatan};
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $client = client::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('defaultpassword'),
                ]
            );

            Auth::login($client);
            $catatan = catatan::where( 'user', Auth::id() )->get();
            return view('home.dashboard.homepage', compact('client', 'catatan'));
        } catch (\Exception $e) {   
            return redirect('/')->with('error', 'Gagal login dengan Google.');
        }
    }
}
