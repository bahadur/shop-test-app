<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use App\Enums\ACL\Role as UserRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::firstOrCreate(['name' => UserRole::ADMIN]);
        $C2C =  Role::firstOrCreate(['name' => UserRole::C2C]);
        $C2B = Role::firstOrCreate(['name' => UserRole::C2B]);
    }
}
