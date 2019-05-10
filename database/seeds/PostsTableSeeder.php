<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use App\Post;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::truncate();
        $user = factory(User::class)->create();

        Post::truncate();
        for ($i=0; $i < 100; $i++) { 
            Post::create([
                'user_id' => $user->id,
                'title' => $faker->sentence,
                'body' => $faker->paragraph
            ]);
        }
    }
}
