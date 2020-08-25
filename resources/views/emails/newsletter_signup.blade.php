@component('mail::message')
# Newsletter Signup Confirmation Email

We’re glad to have you!

You’ve successfully signed up for Wenno newsletter. We’ll be sending you the latest deal and interesting facts regularly.

Explore our animal figurines:
@component('mail::button', ['url' => 'https://www.wennoanimal.com/website/?#/Product', 'color' => 'success'])
View
@endcomponent

See you soon!

<p style = "color:#ddd;font-size:14px;">You’re receiving this because you’ve signed up for a new account.</p>

@component('mail::button', ['url' => config('app.url') . '/api/unsubscribe?email=' . $email, 'color' => 'primary'])
Unsubscribe
@endcomponent

@endcomponent