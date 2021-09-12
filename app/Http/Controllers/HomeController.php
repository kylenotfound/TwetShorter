<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Twet;
use Auth;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $userId = $user->getId();

        $twets = Twet::all()->where('user_id', '=', $userId);

        return view('dash' , [
            'twets' => $twets
        ]);
    }
}
