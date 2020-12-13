<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {
    
    return [
        //
        'question1_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question2_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question3_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question4_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question5_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question6_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question7_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question8_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question9_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'question10_id'  =>  function(){
            return factory(App\Model\Question::class)->create()->id;
        },
        'answer1'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer2'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer3'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer4'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer5'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer6'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer7'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer8'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer9'        =>  array_rand([1,2,3,4,5,6,7]),
        'answer10'        =>  array_rand([1,2,3,4,5,6,7]),
        'email'          => $faker->email,
    ];
});
