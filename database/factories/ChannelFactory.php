<?php

use App\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'description' => $faker->sentence(30)
    ];
});
