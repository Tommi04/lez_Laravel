<div>
    {{-- //embed metodo messo a disposizione dalla classe mail --}}
    {{-- <img src="{{ $message->embed(public_path('images/musa-vision-logo.png')) }}" width="100" alt="Logo musa visione"> --}}
    {{-- ma se usiamo components e quindi richiamiamo la vista con markdown e non più con view non abbiamo più $message --}}
    <img src="{{ asset('images/musa-vision-logo.png') }}" width="100" alt="Logo musa vision">
</div>
<h1>
    {{ $title }}
</h1>
<div>
    <p>
        {{ $content }}
    </p>
</div>
<div>
    {{-- se vogliamo usare queste cose all'interno di una mailable, nel Mailable dentro app>Mail dovremo
    cambiare view con Markdown --}}
    @component('mail::button', ['url' => '', 'color' => 'success'])
        Testo del bottone
    @endcomponent
</div>