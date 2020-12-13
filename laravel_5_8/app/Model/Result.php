<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Quiz;

class Result extends Model{
    protected $guard = [];
    protected $fillable = ['EI', 'SN', 'TF', 'JP'];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function getMBTIAttribute(){
        return [
            'EI'    =>  $this->EI > 0 ? 1 : ($this->EI == 0 ? 0 : -1),
            'SN'    =>  $this->SN > 0 ? 1 : ($this->SN == 0 ? 0 : -1),
            'TF'    =>  $this->TF > 0 ? 1 : ($this->TF == 0 ? 0 : -1),
            'JP'    =>  $this->JP > 0 ? 1 : ($this->JP == 0 ? 0 : -1),
        ];
    }
    public function getMbtiStringAttribute(){
        return ($this->EI > 0 ? "I": "E") . ($this->SN > 0 ? "N":"S") . ($this->TF > 0 ? "F":"T") . ($this->JP > 0 ?"P":"J");
    }
}