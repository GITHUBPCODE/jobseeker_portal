<x-mail::message>
# Hi {{ $user->name }}

Welcome to jobseeker portal. Your email and password below mentioned.
<br>
Email: {{ $user->email }}<br>
Passwaord: 12345678
<br></br>
@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
