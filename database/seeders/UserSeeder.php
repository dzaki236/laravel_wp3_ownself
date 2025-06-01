<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567891000',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@gmail.com',
            'phone' => '081234567891011',
            'password' => bcrypt('password'),
            'role' => 'super_admin'
        ]);
        User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'phone' => '081234567891012',
            'password' => bcrypt('password'),
            'role' => 'customer'
        ]);
        User::create([
            'id' => 4,
            'name' => 'Dzaki Ahnaf Zulfikar',
            'email' => 'uidzaki@gmail.com',
            'phone' => null,
            'email_verified_at' => null,
            'password' => 'eyJpdiI6IllLVDMwdzVMdi93U0hIYXlOcnBlK3c9PSIsInZhbHVlIjoiZUJxZUdCekNxQnBoQ0ZQY3BwUTcwQ3pQL0ovYlNXRXFFQ013Vks0NGplaz0iLCJtYWMiOiIyZjMwZTYxYzFlMjg4MGVkZTU2NDI1ZDAxMzcwMDJiOTNkNDFmZDJkZWI1ODc1NjM0ODYxNTAwNWMyMmU3MGRmIiwidGFnIjoiIn0=',
            'foto_profile' => null,
            'role' => 'customer',
            'status' => 'aktif',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
