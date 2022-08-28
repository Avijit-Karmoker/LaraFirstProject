@component('mail::message')
# Congratulations!

Your account opened successfully by {{ $created_by }}, please use below information to login!

@component('mail::panel')
# Email address: {{ $email }}
# Password: {{ $password }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
