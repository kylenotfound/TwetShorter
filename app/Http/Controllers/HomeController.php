<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Twet;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = User::current();
        $userId = $user->getId();

        $twets = Twet::all()->where('user_id', '=', $userId);

        return view('dash' , [
            'twets' => $twets
        ]);
    }
}
