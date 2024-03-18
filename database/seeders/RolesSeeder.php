<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Roles')->insert([
            [
                'roles_name' => 'Super Admin',
                'roles_code' => 'SADM', // ตัวอย่าง: SADM - Super Admin
            ],
            [
                'roles_name' => 'Moderator',
                'roles_code' => 'MOD', // ตัวอย่าง: MOD - Moderator
            ],
            [
                'roles_name' => 'Editor',
                'roles_code' => 'EDT', // ตัวอย่าง: EDT - Editor
            ],
            [
                'roles_name' => 'Viewer',
                'roles_code' => 'VWR', // ตัวอย่าง: VWR - Viewer
            ],
        ]);
    }
}
