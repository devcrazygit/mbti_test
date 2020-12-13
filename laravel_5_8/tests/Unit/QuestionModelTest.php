<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Question;

class QuestionModelTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFindOne()
    {
        print("\n" . __CLASS__ . "/" . __METHOD__ . "\n");
        $question = factory(Question::class)->create();
        $question->save();
        print($question->question_str . "===" . Question::first()->question_str . "\n");
        $this->assertEquals($question->question_str, Question::first()->question_str);
        print('ok');

    }
}
