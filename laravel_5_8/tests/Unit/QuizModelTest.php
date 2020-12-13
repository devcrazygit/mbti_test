<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Quiz;

class QuizModelTest extends TestCase
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
        $this->withoutExceptionHandling();

        $test_result = factory(Quiz::class)->create();
        $this->assertEquals($test_result->id, Quiz::first()->id);
        
        $this->assertEquals($test_result->question1->id, Quiz::first()->question1->id);
        print('ok');
    }
}
