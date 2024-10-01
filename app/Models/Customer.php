<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers'; // Specify the table name if different

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'dob',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define any relationships here
    // For example, if you have orders associated with customers
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // You can add more relationships as needed
}
