<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'dob' => '1990-01-01',
            'password' => bcrypt('password'), // Ensure to hash the password
        ]);
    }
}
