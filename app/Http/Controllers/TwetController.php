<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twet;
use App\User;

class TwetController extends Controller {

    public function index() {
        return view('twet');
    }

    public function store(Request $request) {

        $twet = new Twet;
        $uniqueTwetid = $twet->generateTwetId();

        $twetData = [
            'twet_id' => $uniqueTwetid,
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'message' => $request->input('message')
        ];

        $twet->fill($twetData);
        $twet->save();
        $twet->refresh();

        return redirect()->route('twet', ['id' => $uniqueTwetid]);

    }

    public function show($id) {
        $message = Twet::where('twet_id', $id)->first();
        return view('twet', [
            'message' => $message->getTwetMsg(),
        ]);
    }
    
}
