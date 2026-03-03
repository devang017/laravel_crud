<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Role::create(['name' => 'admin', 'slug' => 'admin', 'description' => 'Administrator with full permissions']);
        Role::create(['name' => 'author', 'slug' => 'author', 'description' => 'Author with permissions to create and manage their own content']);

        Permission::create(['name' => 'create author', 'slug' => 'create_author', 'description' => 'Permission to create new authors']);
        Permission::create(['name' => 'edit author', 'slug' => 'edit_author', 'description' => 'Permission to edit existing authors']);
        Permission::create(['name' => 'delete author', 'slug' => 'delete_author', 'description' => 'Permission to delete authors']);

        Permission::create(['name' => 'create post', 'slug' => 'create_post', 'description' => 'Permission to create new posts']);
        Permission::create(['name' => 'edit post', 'slug' => 'edit_post', 'description' => 'Permission to edit existing posts']);
        Permission::create(['name' => 'delete post', 'slug' => 'delete_post', 'description' => 'Permission to delete posts']);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
