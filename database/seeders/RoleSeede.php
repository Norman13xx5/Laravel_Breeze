<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeede extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $developer = Role::create(['name' => 'developer']);

        Permission::create(['name' => 'Dashboard'])->syncRoles([$admin, $manager, $developer]);
        Permission::create(['name' => 'users.index'])->syncRoles([$admin, $manager, $developer]);
        Permission::create(['name' => 'users.show'])->syncRoles([$admin, $manager, $developer]);
        Permission::create(['name' => 'users.create'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$admin, $manager]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$admin]);
    }
}
