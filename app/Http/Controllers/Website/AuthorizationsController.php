<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;

class AuthorizationsController extends Controller
{
	/** [store 登录] */
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;
        // 支持邮箱或手机号登录
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;
        
        // 检查用户名密码是否正确
        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        // 检查邮箱是否激活
        $user = User::where('email', $username)->first();
        if(!$user->hasVerifiedEmail()) {
        	abort(401, '邮箱未激活');
        }

        // 生成Token返回前端
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }
}
