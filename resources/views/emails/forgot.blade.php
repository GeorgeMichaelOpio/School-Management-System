@component('mail::message')
Hello {{$user->name}},

<p>We Understand it happens.</p>

@Component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent