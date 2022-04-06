@component('mail::message')
# {{$data['game']}} Game Deleted

Your game has been deleted by the Admin because it voilates the rules.
Further violation may result you being banned from the platform.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
