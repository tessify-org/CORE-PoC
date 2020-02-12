@component('mail::message')
# Reset your password
Good day {{ $user->first_name }}! You have requested a password reset, if you haven't you can ignore this email.<br>
<br>
Click the button below to change your password.<br>
@component('mail::button', [
    'url' => route('auth.reset-password', [
        'email' => $user->email, 
        'code' => $user->recovery_code
    ])
])
Change your password
@endcomponent
Have a great day,<br>
NNW staff
@endcomponent
