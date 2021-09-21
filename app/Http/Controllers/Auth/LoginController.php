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
      try{
        $githubUser = Socialite::driver('github')->user();
        $authUser = $this->findOrCreateUser($githubUser, 'GITHUB');
        Auth::login($authUser, true);
      } catch (Exception $e) {
        return redirect('login')->withErrors(["errors" => "An account has already been created with the email address provided!"]);
      }
      
      return redirect('dash');
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleGoogleProviderCallback() {
    try{
      $googleUser = Socialite::driver('google')->user();
      $authUser = $this->findOrCreateUser($googleUser, 'GOOGLE');
      Auth::login($authUser, true);
    } catch (Exception $e) {
      return redirect('login')->withErrors(["errors" => "An account has already been created with the email address provided!"]);
    }
    
    return redirect('dash');
}

  /**
     * Obtain the user information from Twitter.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterProviderCallback() {
      try{
        $twitterUser = Socialite::driver('twitter')->user();
        $authUser = $this->findOrCreateUser($twitterUser, 'TWITTER');
        Auth::login($authUser, true);
      } catch (Exception $e) {
        return redirect('login')->withErrors(["errors" => "An account has already been created with the email address provided!"]);
      }
      
      return redirect('dash');
  }

  public function findOrCreateUser ($socialUser, $type) {
    if ($authUser = User::where('external_id', $socialUser->id)->first()) {
      return $authUser;
    }
    
    return User::create([
      'email' => $socialUser->getEmail(),
      'name' => $socialUser->getName(),
      'external_id' => $socialUser->getId(),
      'user_source_type' => $type
    ]);
  }

}
