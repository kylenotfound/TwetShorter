<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Exception;

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


    public function redirectToGithubProvider() {
        return Socialite::driver('github')->redirect();
    }


    public function redirectToGoogleProvider() {
      return Socialite::driver('google')->redirect();
    }


    public function redirectToTwitterProvider() {
      return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGithubProviderCallback() {
      $githubUser = Socialite::driver('github')->user();

      $user = User::where('external_id', $githubUser->getId())->first();
      try{
        if (!$user) {
          $user = User::create([
            'email' => $githubUser->getEmail(),
            'name' => $githubUser->getName(),
            'external_id' => $githubUser->getId(),
            'user_source_type' => 'GITHUB'
          ]);
        }

      // login the user
      
        Auth::login($user, true);
      } catch (Exception $e) {
        return redirect('login')->withErrors(["errors" => "error"]);
      }
      

      return redirect('dash');
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleGoogleProviderCallback() {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('external_id', $googleUser->getId())->first();

    if (!$user) {
      $user = User::create([
        'email' => $googleUser->getEmail(),
        'name' => $googleUser->getName(),
        'external_id' => $googleUser->getId(),
        'user_source_type' => 'GOOGLE'
      ]);
    }

    // login the user
    Auth::login($user, true);

    return redirect('dash');
}

  /**
     * Obtain the user information from Twitter.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterProviderCallback() {
      $twitterUser = Socialite::driver('google')->user();

      $user = User::where('external_id', $twitterUser->getId())->first();

      if (!$user) {
        $user = User::create([
          'email' => $twitterUser->getEmail(),
          'name' => $twitterUser->getName(),
          'external_id' => $twitterUser->getId(),
          'user_source_type' => 'TWITTER'
        ]);
      }

      // login the user
      Auth::login($user, true);

      return redirect('dash');
  }

}
