@component('mail::message')
# {{ $subject }}

{{ $content }}

See you soon!

<p style = "color:#ddd;font-size:14px;">You’re receiving this because you’ve signed up for a new account.</p>

@component('mail::button', ['url' => config('app.url') . '/api/unsubscribe?email=' . $email, 'color' => 'primary'])
Unsubscribe
@endcomponent

@endcomponent
