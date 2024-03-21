<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //password hash
        $password = password_hash('12345678',PASSWORD_DEFAULT);

        //Insert data baru dengan  role  admin ke tabel users
        DB::table('users')->insert([
           'username' =>  'admincrm',
           'email'  => 'admincrm563@gmail.com',
           'password' => $password,
           'role' =>  'admin'
        ]);
    }
}
