<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Models\User;
use App\Events\RegisteredByApi;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use Overtrue\Socialite\SocialiteManager;

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

    public function socialStore($type, SocialAuthorizationRequest $request)
    {
        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {
                // 可以使用code获取acces_token
                $response = $driver->getAccessTokenResponse($code);
                $token = Arr::get($response, 'access_token');
            } else {
                //  也可以直接使用access_token
                $token = $request->access_token;

                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }
            // 获取第三方授权用户信息
            $oauthUser = $driver->userFromToken($token);

        } catch (Exception $e) {
            throw new AuthenticationException('参数错误，未获取用户信息');
        }

        switch ($type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    // $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('openid', $oauthUser->getId())->first();
                }

                // 没有用户，默认创建一个用户
                if (!$user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        // 'avatar' => $oauthUser->getAvatar(),
                        'openid' => $oauthUser->getId(),
                    ]);
                }
                break;
        }

        $token=\Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token);

    }
    /** [facebook facebook 授权登录页面] */
    public function facebook()
    {
      return \Socialite::with('facebook')->redirect();
    }
    
    /**
     * [facebook_callback 回调地址，.env中需要配置，facebook应用中需要设置有效 OAuth 跳转 URI eg:https://www.wennoanimal.com/api/facebook_callback]
     * @return [type] [description]
     */
    public function facebook_callback()
    {
        $oauthUser = \Socialite::with('facebook')->user();
        // 检查是否已有邮箱注册身份，有则绑定
        $user = User::where('email', $oauthUser->getEmail())->first();
        // 没有用户信息创建该用户
        if (!$user) {
            $user = User::create([
                'name' => $oauthUser->getName(),
                'email' => $oauthUser->getEmail(),
                'oauth_type' => 'facebook',
                'openid' => $oauthUser->getId(),
            ]);
        } else {
            $update = User::where('email', $oauthUser->getEmail())->update([
                'oauth_type' => 'facebook',
                'openid' => $oauthUser->getId(),
            ]);
        }

        $token=\Auth::guard('api')->fromUser($user);

        // return $this->respondWithToken($token);
        return redirect('https://www.wennoanimal.com/animalGame/website/#/OtherLogin?token=' . $token);
    }

    /** [google_callback google 授权登录页面] */
    // public function google()
    // {
    //   return \Socialite::driver('google')->redirect();
    // }
    
    // /**
    //  * [google_callback 回调地址，.env中需要配置，google应用中需要设置有效 OAuth 跳转 URI eg:https://www.wennoanimal.com/api/google_callback]
    //  * @return [type] [description]
    //  */
    // public function google_callback()
    // {
    //     $oauthUser = \Socialite::driver('google')->user();
    //     // 检查是否已有邮箱注册身份，有则绑定
    //     $user = User::where('email', $oauthUser->getEmail())->first();
    //     // 没有用户信息创建该用户
    //     if (!$user) {
    //         $user = User::create([
    //             'name' => $oauthUser->getName(),
    //             'email' => $oauthUser->getEmail(),
    //             'oauth_type' => 'google',
    //             'openid' => $oauthUser->getId(),
    //         ]);
    //     } else {
    //         $update = User::where('email', $oauthUser->getEmail())->update([
    //             'oauth_type' => 'google',
    //             'openid' => $oauthUser->getId(),
    //         ]);
    //     }

    //     $token=\Auth::guard('api')->fromUser($user);

    //     // return $this->respondWithToken($token);
    //     return redirect('https://www.wennoanimal.com/animalGame/website/#/OtherLogin?token=' . $token);
    // }


    /** [google_callback google 授权登录页面] */
    public function google()
    {
      $config = [
            'google' => [
                'client_id'     => '539496292177-aecj7ktukf7a507v7u9098ihs7225k3s.apps.googleusercontent.com',
                'client_secret' => 'L8Lv4O1D99I6C-TlG1UgJn6S',
                'redirect'      => 'https://www.wennoanimal.com/api/google_callback',
            ],
        ];

        $socialite = new SocialiteManager($config);

        $response = $socialite->driver('google')->redirect();

        return $response;
    }
    
    /**
     * [google_callback 回调地址，.env中需要配置，google应用中需要设置有效 OAuth 跳转 URI eg:https://www.wennoanimal.com/api/google_callback]
     * @return [type] [description]
     */
    public function google_callback()
    {

        $config = [
            'google' => [
                'client_id'     => '539496292177-aecj7ktukf7a507v7u9098ihs7225k3s.apps.googleusercontent.com',
                'client_secret' => 'L8Lv4O1D99I6C-TlG1UgJn6S',
                'redirect'      => 'https://www.wennoanimal.com/api/google_callback',
            ],
        ];

        $socialite = new SocialiteManager($config);

        $oauthUser = $socialite->driver('google')->user();
        
        // 检查是否已有邮箱注册身份，有则绑定
        $user = User::where('email', $oauthUser->getEmail())->first();
        // 没有用户信息创建该用户
        if (!$user) {
            $user = User::create([
                'name' => $oauthUser->getName(),
                'email' => $oauthUser->getEmail(),
                'oauth_type' => 'google',
                'openid' => $oauthUser->getId(),
            ]);
        } else {
            $update = User::where('email', $oauthUser->getEmail())->update([
                'oauth_type' => 'google',
                'openid' => $oauthUser->getId(),
            ]);
        }

        $token=\Auth::guard('api')->fromUser($user);

        // return $this->respondWithToken($token);
        return redirect('https://www.wennoanimal.com/animalGame/website/#/OtherLogin?token=' . $token);
    }
























}
