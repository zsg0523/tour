@component('mail::message')
# 订阅电子报

我们很高兴您的加入！

您已成功注册 Wenno 电子报。我们会定期向您发送最新优惠和有趣的动物知识.

探索我们的动物模型:
@component('mail::button', ['url' => 'https://www.wennoanimal.com/website/?#/Product', 'color' => 'success'])
浏览
@endcomponent

我们很快会再见！

<p style = "color:#ddd;font-size:14px;">您收到此邮件是因为您已经注册了我们的电子报.</p>

@component('mail::button', ['url' => config('app.url') . '/api/unsubscribe?email=' . $email, 'color' => 'primary'])
退订
@endcomponent

@endcomponent