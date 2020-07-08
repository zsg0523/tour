<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;
use App\Events\RegisteredByApi;
use Auth;

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
            event(new RegisteredByApi($user));
        	abort(401, '邮箱未激活,已发送激活邮件');
        }

        // 生成Token返回前端
        return $this->respondWithToken($token);
    }

    /** [update 更新token] */
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    /** [destroy 删除token] */
    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }


    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function facebook()
    {
      return \Socialite::with('facebook')->redirect();
    }

    public function facebook_callback()
    {
        $oauthUser = \Socialite::with('facebook')->user();
        dd($oauthUser);
        $data = [
            'nickname' => $oauthUser->getNickname(),
            'avatar'   => $oauthUser->getAvatar(),
            'open_id'  => $oauthUser->getId(),
        ];
        return $data;
    }
























}
