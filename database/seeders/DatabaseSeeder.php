<?php 
namespace Database\Seeders; 
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\MenusSeeder;  

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            MenusSeeder::class,
            ServiceEntitySeeder::class
        ]);
    }
}
