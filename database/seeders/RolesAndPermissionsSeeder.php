<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $user = User::create([
            'name' => 'Fidel Leandro',
            'email' => 'fidelleandro@msn.com',
            'password' => bcrypt('12345678'),
        ]);

        $permissions = ['create', 'edit', 'delete', 'view', 'search'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);
        $role = Role::findByName('admin'); 
        $user->assignRole($role); 
        $roleAdmin->givePermissionTo(Permission::all());
        $roleUser->givePermissionTo(Permission::all());
        $roleEditor->givePermissionTo(['create', 'edit']);
    }
}
