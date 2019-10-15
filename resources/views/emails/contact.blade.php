@component('mail::message')

## Name: {{ $name }}
---
## Email: {{ $email }}
---
##Message: {{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent