<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
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
            'email' => 'admin@admin.com',
            'jenis_kelamin' => 'laki-laki',
            'jabatan' => 'admin',
            'divisi' => 'admin',
            'alamat' => 'bandung',
            'password' => bcrypt('password'),
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        DB::table('model_has_roles')->insert([
            ['role_id' => 1,
             'model_type' => 'App\Models\User',
             'model_id' => 1
            ]
        ]);
    }
}
