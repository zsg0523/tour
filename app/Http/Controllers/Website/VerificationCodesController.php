<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests\Api\VerificationCodeRequest;
use Mail;
use Illuminate\Support\Str;

class VerificationCodesController extends Controller
{
    /** [emailCode 获取邮件验证码] */
    public function emailCode(Request $request)
    {
        // 验证参数
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users',
        ]);
        
        // 生产随机四位数
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

        // 发送邮件
        $this->sendEmailConfirmationTo($request->email, $code);

        // 缓存验证码
        $key = 'verificationCode_'.Str::random(15);

        $expiredAt = now()->addMinutes(10);
        // 缓存码十分钟后过期
        \Cache::put($key, [
                            'email' => $request->email, 
                            'code' => $code
                        ], $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }

    /** [sendEmailConfirmationTo 发送邮件] */
    protected function sendEmailConfirmationTo($email, $code)
    {
        $view = 'emails.confirm';
        $data = compact('code');
        $to = $email;
        $subject = "感谢注册 wennoanimal 应用！请确认你的邮箱";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
