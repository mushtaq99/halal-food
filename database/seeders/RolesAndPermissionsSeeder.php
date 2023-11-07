<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // users
        $users = $this->createUsers();

        // roles
        $superAdminRole = Role::create(['name' => 'Super admin', 'slug' => 'super-admin']);
        $editorRole = Role::create(['name' => 'Editor', 'slug' => 'editor']);
        $authorRole = Role::create(['name' => 'Author', 'slug' => 'author']);


        // permissions
        $createPostPermission = Permission::create(['name' => 'Create post', 'slug' => 'create-post']);
        $updatePostPermission = Permission::create(['name' => 'Update post', 'slug' => 'update-post']);
        $deletePostPermission = Permission::create(['name' => 'Delete post', 'slug' => 'delete-post']);

        // assign permissions to roles
        $editorRole->permissions()->save($updatePostPermission);
        $authorRole->permissions()->saveMany([$createPostPermission, $deletePostPermission]);
//
//        // assign roles to users
        $users['editor']->roles()->save($editorRole);
        $users['author']->roles()->save($authorRole);
        $users['super-admin']->roles()->save($superAdminRole);

    }

    private function createUsers(): array
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);

        $editor = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@mail.com',
            'password' => Hash::make('password'),
        ]);

        $author = User::factory()->create([
            'name' => 'Author',
            'email' => 'author@mail.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);


        return [
            'super-admin' => $superAdmin,
            'editor' => $editor,
            'author' => $author,
            'user' => $user,
        ];
    }
}
