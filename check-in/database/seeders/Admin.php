<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_number' => '+6281320477896',
            'address' => 'jalan testing data',
            'is_special_user' => 2,
            'has_restaurant' => 0,
            'image' => 'public/picture/20230402_135238_Dinner.jpg',
            'remember_token' => Str::random(10),
        ]);
    }
}
