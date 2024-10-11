<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrcreate([
            'email' => 'superadmin@admin.com',
        ],[
            'name' => 'Usman Ali Sarwar',
            'email' => 'superadmin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('DevTeam@123'), // You should hash the password for security
            'role_id' => 1
        ]);

        User::updateOrcreate([
            'email' => 'admin@admin.com',
        ],[
            'name' => 'Admin Usman',
            'email' => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('DevTeam@123'), // You should hash the password for security
            'role_id' => 2
        ]);
    }
}
