@component('mail::message')
    # {{$head}}

    {{$body}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
