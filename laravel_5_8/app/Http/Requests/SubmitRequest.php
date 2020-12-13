<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'result'    =>  ['required', 'size:10'],
            'result.*.id'   => ['required'],
            'result.*.value'=> ['required', 'gte:1', 'max:7'],
            'email'     =>  ['required', 'email']
        ];
    }
}