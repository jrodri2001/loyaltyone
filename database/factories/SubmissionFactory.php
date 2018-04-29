<?php

use Faker\Generator as Faker;

$factory->define(\App\Submission::class, function (Faker $faker) {
    return [
        'text' => $faker->text()
    ];
});
