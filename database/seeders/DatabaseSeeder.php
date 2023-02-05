<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();

        Admin::create([
            'fname' => 'Ahmed',
            'lname' => 'Almabhoh',
            'email' => 'almabhoh@ot.com.sa',
            'phone' => '0567077653',
            'password' => Hash::make('password'),
            'status' => 'active',
            // 'status' => 'active',
        ]);
    }
}
