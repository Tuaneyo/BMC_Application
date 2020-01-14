<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // user front-end dashboard shit
        Permission::create(['name' => 'view canvas']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'view top 4']);

        // User management related stuff.
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'list users']);

        // Assignment management
        Permission::create(['name' => 'list assignments']);
        Permission::create(['name' => 'view assignment']);
        Permission::create(['name' => 'download assignment']);
        Permission::create(['name' => 'judge assignment']);
        Permission::create(['name' => 'delete assignment']);
        Permission::create(['name' => 'add assignment']);
        Permission::create(['name' => 'checkin assignment']);
        Permission::create(['name' => 'add assignment deadline']);


        // Forum management
        Permission::create(['name' => 'list posts']);
        Permission::create(['name' => 'view post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);

        // Forum comments
        Permission::create(['name' => 'list comments']);
        Permission::create(['name' => 'delete comment']);
        Permission::create(['name' => 'create comment']);
        Permission::create(['name' => 'edit comment']);

        // News management
        Permission::create(['name' => 'list notifications']);
        Permission::create(['name' => 'view notification']);
        Permission::create(['name' => 'delete notification']);
        Permission::create(['name' => 'create notification']);
        Permission::create(['name' => 'edit notification']);

        // Role management
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);

        // Progress
        Permission::create(['name' => 'view progress']);


        // Create administrator role along with the required permissions.
        Role::create(['name' => 'administrator'])
            ->givePermissionTo(
                [
                    'edit user',
                    'delete user',
                    'create user',
                    'view user',
                    'list users',
                    'list assignments',
                    'view assignment',
                    'judge assignment',
                    'delete assignment',
                    'add assignment',
                    'checkin assignment',
                    'list posts',
                    'view post',
                    'delete post',
                    'create post',
                    'edit post',
                    'list notifications',
                    'view notification',
                    'delete notification',
                    'create notification',
                    'edit notification',
                    'list roles',
                    'view role',
                    'delete role',
                    'create role',
                    'edit role',
                    'view dashboard',
                    'view progress',
                    'list comments',
                    'delete comment',
                    'create comment',
                    'edit comment',
                    'add assignment deadline'
                ]
            );

        Role::create(['name' => 'docent'])
            ->givePermissionTo(
                [
                    'list assignments',
                    'view assignment',
                    'judge assignment',
                    'delete assignment',
                    'add assignment',
                    'checkin assignment',
                    'list posts',
                    'view post',
                    'delete post',
                    'create post',
                    'edit post',
                    'list notifications',
                    'view notification',
                    'delete notification',
                    'create notification',
                    'edit notification',
                    'view dashboard',
                    'view progress',
                    'add assignment deadline'
                ]
            );

        Role::create(['name' => 'student'])
            ->givePermissionTo(
                [
                    'view user',
                    'list users',
                    'checkin assignment',
                    'list posts',
                    'view post',
                    'delete post',
                    'create post',
                    'edit post',
                    'list notifications',
                    'view notification',
                    'delete notification',
                    'create notification',
                    'edit notification',
                    'view progress',
                    'list comments',
                    'create comment',
                    'edit comment',
                ]
            );

        $user = User::where('email', 'b.hamming@windesheim.nl')->first();
        $user->assignRole(['administrator', 'docent']);

        $users = User::where([
            ['email', '<>', 'b.hamming@windesheim.nl'],
        ])->get();
    }
}
