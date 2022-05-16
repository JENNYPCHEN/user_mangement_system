<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@hello.com',
            'password'=>Hash::make('password'),
            'is_admin'=>'1'
        ]);
        User::create([
            'name'=>'user1',
            'email'=>'user1@hello.com',
            'password'=>Hash::make('password'),
        ]);
        User::create([
            'name'=>'user2',
            'email'=>'user2@hello.com',
            'password'=>Hash::make('password'),
        ]);
    }
}
