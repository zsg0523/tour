<?php

namespace App\Http\Requests\Api;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:6',
                ];
                break;
            case 'PATCH':
                $userId = \Auth::guard('api')->id();

                return [
                    'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' .$userId,
                ];

                break;
            default:
                # code...
                break;
        }
        
    }


    
}
