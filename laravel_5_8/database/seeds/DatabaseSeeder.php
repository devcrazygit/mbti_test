<?php

use Illuminate\Database\Seeder;
use App\Model\Question;
use App\Model\TestResult;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Question::create([
            'question_str'      => "You find it takes effort to introduce yourself to other people.",
            'dimension'     => "EI",
            'direction'     => 1
        ]);
        Question::create([
            'question_str'      => "You consider yourself more practical than creative.",
            'dimension'     => "SN",
            'direction'     => -1
        ]);
        Question::create([
            'question_str'      => "Winning a debate matters less to you than making sure no one gets upset.",
            'dimension'     => "TF",
            'direction'     => 1
        ]);
        Question::create([
            'question_str'      => "You get energized going to social events that involve many interactions.",
            'dimension'     => "EI",
            'direction'     => -1
        ]);
        Question::create([
            'question_str'      => "You often spend time exploring unrealistic and impractical yet intriguing ideas.",
            'dimension'     => "SN",
            'direction'     => 1
        ]);
        Question::create([
            'question_str'      => "Deadlines seem to you to be of relative rather than absolute importance.",
            'dimension'     => "JP",
            'direction'     => 1
        ]);
        Question::create([
            'question_str'      => "Logic is usually more important than heart when it comes to making important decisions.",
            'dimension'     => "TF",
            'direction'     => -1
        ]);
        Question::create([
            'question_str'      => "Your home and work environments are quite tidy.",
            'dimension'     => "JP",
            'direction'     => -1
        ]);
        Question::create([
            'question_str'      => "You do not mind being at the center of attention.",
            'dimension'     => "EI",
            'direction'     => -1
        ]);
        Question::create([
            'question_str'      => "Keeping your options open is more important than having a to-do list.",
            'dimension'     => "JP",
            'direction'     => 1
        ]);
        
    }
}
