<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Quiz;
use App\User;

class AdminController extends Controller{

    public function get(Request $request){
        if($request->has('per_page')){
            $per_page = $request->get('per_page');
        }else{
            $per_page = 5;
        }
        $user = auth()->user();
        
        $quizzes = $user->quizzes();
        if($request->has('sort_field')){
            $orientation = $request->has('sort_order') ? $request->input("sort_order") : "desc";
            $quizzes = $quizzes->orderBy($request->input("sort_field"), $orientation);
        }
        $items = $quizzes->paginate($per_page);
        // return $items;
        $res = [];
        foreach($items as $item){
            $res[] = [
                'id'            =>  $item->id,
                'created_at'    =>  $item->created_at,
                'mbti'          =>  $item->result->mbti_string
            ];
        }
        return response()->json([
            'data'  =>  $res,
            'current_page'  =>  $items->currentPage(),
            'last_page'     =>  $items->lastPage(),
            'per_page'      =>  $items->perPage(),
            'total'         =>  $items->total(),
        ]);
    }
    public function getQuestions(Quiz $quiz){
        $user = auth()->user();
        if($quiz->user != $user){
            return response()->json([
                'status'    =>  'error',
            ], 401);
        }
        $res = [];
        for($i = 1; $i < 11; $i++){
            $q_str = "question$i";
            $a_str = "answer$i";
            $res[] =[
                'question_str' => $quiz->$q_str->question_str,
                'value'        => "{$quiz->$a_str}",
            ];
        }
        return $res;
    }
}