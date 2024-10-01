<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplier extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;

    protected $fillable = [
        'Sname', 'Saddress', 'Sphone', 'Semail', 'Product', 'password',
    ];

    // If you are using hashed passwords, make sure it's hidden
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Optionally, you can cast attributes to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
