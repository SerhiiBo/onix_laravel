<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 2; $i++) {
            $user = User::factory()->create();
            Post::factory(rand(1, 5))->create([
                "user_id" => $user->id,
            ]);
        }
    }
}
