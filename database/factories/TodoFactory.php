<?php

use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        'body' => 'This is a todo',
        'owner_id' => function() {
            return factory('App\User')->create()->id;
        },
    ];
});
