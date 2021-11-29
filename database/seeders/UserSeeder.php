<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
            'provinsi' => '11',
            'kota' => '370',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10)
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'level' => 'pelanggan',
            'fotoprofil' => 'images/user_profile/user.png',
            'email' => 'user@proyek.com',
            'phone' => '08567890123',
            'alamat' => 'Jl. Yang Benar No. 1',
            'provinsi' => '11',
            'kota' => '370',
            'password' => bcrypt('user'),
            'remember_token' => Str::random(10)
        ]);
    }
}
