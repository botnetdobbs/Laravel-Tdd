<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id' => 1,
        'body' => $faker->sentence,
        'author' => $faker->name
    ];
});
