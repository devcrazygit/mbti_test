<?php

namespace App\Http\Services;

use App\Model\Quiz;

class QuizService{

    public function calc(Quiz $result){
        $mbti = [
            'EI'    =>  0,
            'SN'    =>  0,
            'TF'    =>  0,
            'JP'    =>  0,
        ];
        for($i = 1; $i <= 10; $i++){
            $q_k = 'question'.$i;
            [$dimension, $point] = $this->calcUnit($result->$q_k, $result['answer' . $i]);
            $mbti[$dimension] += $point;
        }
        foreach($mbti as $k => $v){
            if(empty($v)){
                $mbti[$k] = -1;
            }
        }
        return $mbti;
    }

    public function calcUnit($question, $answer){
        return [$question->dimension , $question->direction * ($answer - 4)];
    }
    
}