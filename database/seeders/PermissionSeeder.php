<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit articles');
        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('publish articles');
        $role2->givePermisgivesionTo('unpublish articles');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'username' => 'user',
            'name' => 'Example User',
            'email' => 'test@example.com',
            'password' => bcrypt('123')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'username' => 'admin',
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt("123")
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'username' => 'super',
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
            'password' => bcrypt("123")
        ]);
        $user->assignRole($role3);
    }
}
