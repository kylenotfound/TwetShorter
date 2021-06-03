<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class Twet extends Model {
    
    /**
     * The table associated with the model
     */
    protected $table = 'twet';

    const TWET_ID = 'twet_id';
    const USER_ID = 'user_id';
    const USER_NAME = 'user_name';
    const MESSAGE = 'message';

    protected $fillable = [
        self::TWET_ID,
        self::USER_ID,
        self::USER_NAME,
        self::MESSAGE,
    ];

    public function getTwetId() {
        return $this->twet_id;
    }

    public function generateTwetId() {
        $twetId = null;
        $existingTwetId = null;

        do {
            $twetId = Str::random(16);
            $existingTwetId = self::where('twet_id', $twetId)->first();
        } while ($existingTwetId != null);

        return $twetId;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getUserId() {
        return $this->user()->getId();
    }

    public function getUserName() {
        return $this->user()->getName();
    }

    public function getTwetMsg() {
        return $this->message;
    }

}
