<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Question;
use App\Model\Result;
use App\User;
use Carbon\Carbon;


class Quiz extends Model{
    protected $guard = [];
    
    public function question1(){
        return $this->belongsTo(Question::class);
    }
    public function question2(){
        return $this->belongsTo(Question::class);
    }
    public function question3(){
        return $this->belongsTo(Question::class);
    }
    public function question4(){
        return $this->belongsTo(Question::class);
    }
    public function question5(){
        return $this->belongsTo(Question::class);
    }
    public function question6(){
        return $this->belongsTo(Question::class);
    }
    public function question7(){
        return $this->belongsTo(Question::class);
    }
    public function question8(){
        return $this->belongsTo(Question::class);
    }
    public function question9(){
        return $this->belongsTo(Question::class);
    }
    public function question10(){
        return $this->belongsTo(Question::class);
    }

    public function result(){
        return $this->hasOne(Result::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute(){
        return (new Carbon($this->attributes['created_at']))->format('Y-m-d H:i:s');
    }
}