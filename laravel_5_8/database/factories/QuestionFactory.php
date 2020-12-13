<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //
        'question_str' =>  Str::random(10),
        'direction'     =>  array_rand([1, -1]),
        'dimension'    =>  array_rand(['EI', 'SN', 'TF', 'JP'])
    ];
});
