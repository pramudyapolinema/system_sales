<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'level' => 'admin',
            'fotoprofil' => 'images/user_profile/user.png',
            'email' => 'admin@proyek.com',
            'phone' => '-',
            'alamat' => '-',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10)
        ]);
    }
}
