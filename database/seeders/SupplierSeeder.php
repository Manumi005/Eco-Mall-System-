<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'Sname' => 'Supplier One',
                'Saddress' => '123 Supplier Street',
                'Sphone' => '1234567890',
                'Semail' => 'supplier1@example.com',
                'Product' => 'Product A',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Sname' => 'Supplier Two',
                'Saddress' => '456 Supplier Lane',
                'Sphone' => '0987654321',
                'Semail' => 'supplier2@example.com',
                'Product' => 'Product B',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
