<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'video_id' => Str::random(11),
        'user_id' => fn() => factory(App\User::class)->create()->id,
    ];
});
