@component('mail::message')
# 訂閱電子報

我們很高興您的加入！

您已成功註冊 Wenno 電子報。 我們會定期向您發送最新優惠和有趣的動物知識。

探索我們的動物模型:
@component('mail::button', ['url' => 'https://www.wennoanimal.com/website/?#/Product', 'color' => 'success'])
瀏覽
@endcomponent

我們很快會再見！

<p style = "color:#ddd;font-size:14px;">您收到此郵件是因為您已經註冊了我們的電子報.</p>

@component('mail::button', ['url' => config('app.url') . '/api/unsubscribe?email=' . $email, 'color' => 'primary'])
退訂
@endcomponent

@endcomponent