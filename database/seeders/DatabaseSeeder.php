<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class
        ]);
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@okh.com',
        ]);

        $p1 = User::factory()->create([
            'name' => 'p1',
            'email' => 'p1@okh.com',
        ]);

        $p2 = User::factory()->create([
            'name' => 'p2',
            'email' => 'p2@okh.com',
        ]);

        User::factory()->create([
            'name' => 'u1',
            'email' => 'u1@okh.com',
        ]);

        User::factory()->create([
            'name' => 'u2',
            'email' => 'u2@okh.com',
        ]);

        User::factory()->create([
            'name' => 'u3',
            'email' => 'u3@okh.com',
        ]);

        $user->assignRole('admin');
        $p1->assignRole('basic_publisher');
        $p2->assignRole('pro_publisher');
        Post::factory(20)->create();
    }
}
