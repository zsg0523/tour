<?php

namespace App\Http\Controllers\Website;

use App\Models\{User, NewsLetter};
use Illuminate\Http\Request;
use App\Events\RegisteredByApi;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use App\Transformers\UserTransformer;


class UsersController extends Controller
{
	/** [store 邮箱注册] */
    public function store(UserRequest $request)
    {
    	// 创建用户
    	$user  = User::create([
    		'name' => $request->username,
    		'email' => $request->email,
            'password' => bcrypt($request->password),
    	]);

    	// 触发事件发送激活邮件
    	event(new RegisteredByApi($user));

    	// 返回用户信息
    	return $this->response->item($user, new UserTransformer())->setMeta([
            'message' => '注册成功,激活邮件已经发至您的邮箱,请注意查收',
            'status_code' => 201,
        ])->setStatusCode(201);
    }


    /** [markEmailAsVerified 邮箱激活] */
    public function markEmailAsVerified(Request $request, User $id)
    {
        
        if ($id->hasVerifiedEmail()) {
            abort(401, '邮箱已激活');
        }

        // 激活邮箱
        $id->markEmailAsVerified();

        // 返回token,免密登录
        $token = \Auth::guard('api')->fromUser($id);

        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    /**
     * [testUrl https://wennoanimal.com/animalGame/website/#/VerifyEmail/57/1589519456/25742403efd1108cf23bda65eb7e7f7074c1f5d0ba7bc572949faf3162c429ca]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function testUrl(Request $request)
    {
        // 临时签名路由,3天后过期
        $url  = URL::temporarySignedRoute(
                    'api.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 4320)),
                    ['id' => 44]
                );

        $url_array = convertUrlQuery($url);
        $id = 44;
        $expire = strtotime(Carbon::now()->addMinutes(Config::get('auth.verification.expire', 4320)));
        $signature = $url_array['signature'];

        $web_url = url("animalGame/website/#/VerifyEmail/" . $id . '/' . $expire . '/' . $signature);

        // 激活邮箱接口，激活邮箱界面
        dd($url, $web_url);
    }

    /** [me 当前登录用户信息] */
    public function me()
    {
        return $this->response->item($this->user(), new USerTransformer());
    }

    /** [update 编辑个人信息] */
    public function update(UserRequest $request)
    {
        $user = $this->user();
        
        $attributes = $request->only(['name']);

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    /** [newsLetter newsletter登记] */
    public function newsLetter(Request $request)
    {
        // 验证是否有效邮箱
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'unique:news_letters'],
        ]);

        // 验证通过
        $newsLetter = NewsLetter::create(['email' => $request->email]);

        return $this->response->array([
            'message' => 'Sign up success.',
            'status_code' => 201,
        ]);
    }



}
