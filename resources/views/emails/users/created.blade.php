@component('mail::message')

# User Created

## Welcome, {{ $full_name }}


@component('mail::button', ['url' => $url, 'color' => 'success'])
Test Button
@endcomponent

@component('mail::panel')
This is the test panel content.
{{ $user->name }} name </br>
{{ $user->email }} email </br>
{{ $user->password }} pass </br>
{{ $user->first_name }} first name</br>
{{ $user->last_name }} last name</br>
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
|:------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
| Test          |
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
