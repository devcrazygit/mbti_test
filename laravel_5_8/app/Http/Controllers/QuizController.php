<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Question;
use App\Model\Quiz;
use App\Http\Requests\SubmitRequest;
use App\Http\Services\QuizService;
use App\User;
use Illuminate\Support\Facades\Hash;

class QuizController extends Controller{

    protected $quiz_service;

    public function __construct(QuizService $quiz_service){
        $this->quiz_service = $quiz_service;
    }
    
    public function get(Request $request){
        $questions =  Question::inRandomOrder()->limit(10)->get(['question_str', 'id'])->toArray();
        return response()->json([
                'code' => 200,
                'status'    => 'success',
                'questions' => $questions
        ]);
    }
    public function submit(SubmitRequest $request){
        $results = $request->input('result');
        $email = $request->input('email');
        
        $user = User::firstOrCreate(['email' => $email], [
            'name'  =>  str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),
            'password'  =>  Hash::make("123123123")
        ]);
        
        $quiz = new Quiz;
        foreach($results as $key => $result){
            $quiz['question' . ($key + 1) . '_id' ] = $result['id'];
            $quiz['answer' . ($key + 1)] = $result['value'];
        }
        $quiz->email = $email;
        $quiz->save();

        $quiz->user()->associate($user);
        $quiz->save();

        $quiz->refresh();
        
        $mbti = $this->quiz_service->calc($quiz);
        $quiz->result()->create($mbti);
        
        return response()->json($quiz->result->MBTI);
    }
}