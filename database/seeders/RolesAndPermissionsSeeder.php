<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = ['create posts', 'edit posts', 'delete posts'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);

        // Asignar permisos a roles
        $roleAdmin->givePermissionTo(Permission::all());
        $roleEditor->givePermissionTo(['create posts', 'edit posts']);
    }
}
