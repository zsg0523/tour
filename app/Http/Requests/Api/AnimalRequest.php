<?php

namespace App\Http\Requests\Api;

class AnimalRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [

                ];
                break;
            
            default:
                # code...
                break;
        }
    }
}
