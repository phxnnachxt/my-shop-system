<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = bcrypt('123456789');
        DB::table('users')->insert([
            'name' => "todsaporn.saelow",
            'email' => "jackpopula2534@gmail.com",
            'password' => $password,
            'roles_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => "John Doe",
            'email' => "johndoe@example.com",
            'password' => $password,
            'roles_id' => 2
        ]);
        DB::table('users')->insert([
            'name' => "user 1",
            'email' => "user1@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 2",
            'email' => "user2@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
    }
}
