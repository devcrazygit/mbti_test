<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class SubmitTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCase()
    {
        $this->seed();
        $response = $this->json('POST','api/submit', [
            'result'    =>  [
                [ 'id' => 1, 'value' => 7],
                [ 'id' => 2, 'value' => 7],
                [ 'id' => 3, 'value' => 7],
                [ 'id' => 4, 'value' => 7],
                [ 'id' => 5, 'value' => 7],
                [ 'id' => 6, 'value' => 7],
                [ 'id' => 7, 'value' => 7],
                [ 'id' => 8, 'value' => 7],
                [ 'id' => 9, 'value' => 7],
                [ 'id' => 10, 'value' => 7],
            ],
            'email' =>  'test@example.com'
        ]);
        print("\nQuiz submit test");
        $response->assertStatus(200);
    }
}
