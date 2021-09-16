<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserSourceType;

use Auth;

class User extends Authenticatable {
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'external_id', 'user_source_type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSourceType() {
        return $this->user_source_type;
    }
}
