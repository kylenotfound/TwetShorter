<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller {
    use AuthenticatesUsers;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider() {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback() {
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('provider_id', $githubUser->getId())->first();

        if (!$user) {
          $user = User::create([
            'email' => $githubUser->getEmail(),
            'name' => $githubUser->getName(),
            'provider_id' => $githubUser->getId(),
          ]);
        }

        // login the user
        Auth::login($user, true);

        return redirect('dash');
    }
}
