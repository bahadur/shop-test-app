<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'email' => 'admin@domain.com'
        ], [
            'name' => 'Admin',
            'password' =>bcrypt('12345678'),

        ]);

        $admin->assignRole('admin');
    }
}
