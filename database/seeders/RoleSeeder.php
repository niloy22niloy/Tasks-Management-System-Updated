<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Category']);
        Permission::create(['name' => 'Project']);
        Permission::create(['name' => 'Role']);
        Permission::create(['name' => 'Member']);
        Permission::create(['name' => 'own task']);
        Permission::create(['name' => 'my_task_members_list']);
        Permission::create(['name' => 'Delete']);
        

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Super_Admin']);
        $role->givePermissionTo(['Category', 'Project','Role','Member','own task','my_task_members_list','Delete']);

        // or may be done by chaining
        $role = Role::create(['name' => 'Author'])
            ->givePermissionTo(['Category', 'Project','Member','my_task_members_list']);

        $role = Role::create(['name' => 'Member']);
        $role->givePermissionTo(['Member','own task']);
    }
}
