@component('mail::message')
# New message arrived

@component('mail::panel')
<p>Name: {{ $info['name'] }}</p>
<p>Email: {{ $info['email'] }}</p>
<p>Message: {{ $info['message'] }}</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
