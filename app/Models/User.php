<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    protected $fillable = ['name', 'email', 'password', 'role', 'company_id'];

public function company()
{
    return $this->belongsTo(Company::class);
}

public function shortUrls()
{
    return $this->hasMany(ShortUrl::class);
}
}
