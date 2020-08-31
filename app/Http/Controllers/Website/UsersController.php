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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsSignUp;
use App\Mail\UserRegister;


class UsersController extends Controller
{
	/** [store 邮箱注册] */
    public function store(UserRequest $request)
    {
        $is_newsletter = 0;
        // 当前邮箱是否接受newsletter
        if ($request->is_newsletter) {
            NewsLetter::firstOrCreate(['email' => $request->email]);
            // 发送newsletter邮件
            Mail::to($request->email)->send(new NewsSignUp($request->email));
            $is_newsletter = 1;
        }
        // 创建用户
        $user  = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'language' => $request->language,
            'password' => bcrypt($request->password),
            'is_newsletter' => $is_newsletter,
        ]);
        
    	// 触发事件发送激活邮件
    	event(new RegisteredByApi($user));

    	// 返回用户信息
    	return $this->response->item($user, new UserTransformer())->setMeta([
            'message' => '注册成功,激活邮件已经发至您的邮箱,请注意查收',
            'status_code' => 201,
        ])->setStatusCode(201);
    }

    // newsletter 设置
    public function markAsNewsLetter(Request $request)
    {
        $is_newsletter = $request->is_newsletter;

        // 更新个人订阅状态
        $users = $this->user()->update(['is_newsletter' => $is_newsletter]);
        // 删除或增加newsletter邮箱
        switch ($is_newsletter) {
            case '1':
                NewsLetter::firstOrCreate(['email' => $this->user()->email]);
                break;
            
            default:
                NewsLetter::where(['email' => $this->user()->email])->delete();
                break;
        }

        return $this->response->array([
            'status_code' => 201,
            'message' => 'set success!'
        ]);
    }


    /** [markEmailAsVerified 邮箱激活] */
    public function markEmailAsVerified(Request $request, User $id)
    {
        
        if ($id->hasVerifiedEmail()) {
            abort(401, '邮箱已激活');
        }

        // 激活邮箱
        $id->markEmailAsVerified();

        // 发送注册成功邮件
        Mail::to($id->email)->send(new UserRegister($id->email,  $id->password));

        // 返回token,免密登录
        $token = \Auth::guard('api')->fromUser($id);

        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    /**
     * [testUrl https://wennoanimal.com/website/#/VerifyEmail/57/1589519456/25742403efd1108cf23bda65eb7e7f7074c1f5d0ba7bc572949faf3162c429ca]
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

        $web_url = url("/website/#/VerifyEmail/" . $id . '/' . $expire . '/' . $signature);

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
        
        $attributes = $request->only(['name', 'language']);

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    /** [newsLetter newsletter登记] */
    public function newsLetter(Request $request)
    {
        // 验证是否有效邮箱
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 验证通过
        $newsLetter = NewsLetter::firstOrCreate(['email' => $request->email]);

        // 发送登记成功通知邮件
        Mail::to($request->email)->send(new NewsSignUp($request->email));

        return $this->response->array([
            'message' => 'Sign up success.',
            'status_code' => 201,
        ]);
    }

    /** [unsubscribe 取消邮件订阅] */
    public function unsubscribe(Request $request)
    {
        $email = $request->email;

        NewsLetter::where('email', $email)->delete();

        return view('pages.success', ['msg' => 'Unsubscribed successfully!']);
    }


    /** [forgetPassword 忘记密码] */
    public function forgotPassword(Request $request)
    {
        $verifyData = \Cache::get($request->verification_key);
                
        if (!$verifyData) {
           abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        // 参数验证
        $request->validate([
            'password' => 'required|alpha_dash|min:6',
            'verification_key' => 'required|string',
            'verification_code' => 'required|string',
        ]);

        // 更新密码
        User::where(['email' => $verifyData['email']])->update(['password' => bcrypt($request->password)]);

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        return $this->response->array([
            'status_code' => 201,
            'message' => 'password set success!'
        ]);
    }

    /** [changePassword 更换密码] */
    public function changePassword(Request $request)
    {
        // 参数验证
        $request->validate([
            'password' => 'required|alpha_dash|min:6',
            'new_password' =>'required|alpha_dash|min:6｜confirmed',
            'new_password_confirmation'=>'required|same:new_password',
        ]);

        // 验证密码是否正确
        if (!Hash::check($request->password, $this->user()->password)) {
            abort(404, 'password wrong!');
        }
        
        // 更新密码
        $this->user()->fill(['password' => Hash::make($request->new_password)])->save();

        return $this->response->array([
            'status_code' => 201,
            'message' => 'password set success!'
        ]);
    }



}
