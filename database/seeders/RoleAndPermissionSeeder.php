<?php

namespace Database\Seeders;

use Database\Factories\RoleAndPermissionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        // Create roles and assign existing permissions
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('create');
        $role->givePermissionTo('update');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all()); // Assign all permissions to admin
    }
}
