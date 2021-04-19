@component('mail::layout')
{{-- header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{-- {{ config('app.name') }} --}}
        {{-- metto un'immagine --}}

        <img src="{{ asset('images/musa-vision-logo.png') }}" alt="Logo musa vision" width="75"/>
        {{-- pulisci la cache --}}
    @endcomponent
@endslot
io sono una vista html!
{{ message }}
@endcomponent