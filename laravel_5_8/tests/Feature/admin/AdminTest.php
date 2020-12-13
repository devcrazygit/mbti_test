<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected $token;
    protected $user;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCase()
    {
        $this->seed();
        print("\nAdmin login\n");
        $this->adminLogin();

        print("\nmake quiz result\n");
        $count = 3;
        $this->makeQuizResult($count);
        
        print('get result for user');
        $response = $this->tokenHeader()
            ->get('api/admin/get/?per_page=10&sort_field=created_at&sort_order=desc');
        // print_r($response->getContent());
        $response->assertStatus(200);

        $res = \json_decode($response->getContent());
        $len = count($res->data);
        $this->assertGreaterThan($len, 10);
        $this->assertEquals($len, $count % 10);

        $quiz_id = $res->data[0]->id;
        print('get questions and answers for a quiz');
        $response = $this->tokenHeader()
            ->get('api/admin/questions/' . $quiz_id);
        $response->assertStatus(200);
        
    }

    protected function adminLogin(){
        print("\nAdminLoginTest\n");
        $user = factory(User::class)->create();
        $response = $this->json('POST', '/api/login', [
            'email' =>  $user->email,
        ]);
        $response->assertStatus(200);
        // $this->assertNotNull($response->baseResponse->data->access_token);
        $cont = \json_decode($response->getContent());
        $this->assertNotNull($cont->access_token);
        $this->token = $cont->access_token;
        $this->user = $user;
    }
    protected function tokenHeader($token = null){
        $token = empty($token) ? $this->token : $token;
        
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    protected function makeQuizResult($n = 1){

        for($i = 0; $i < $n; $i++){
            $this->json('POST','api/submit', [
                'result'    =>  [
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                    [ 'id' => \rand(1, 10) , 'value' => \rand(1, 7)],
                ],
                'email' =>  $this->user->email
            ]);
        }
    }

}
