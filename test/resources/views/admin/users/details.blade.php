@extends('layouts.admin-user')
{{-- da fare --}}

@section('content')
    <div class="container">

        @include('components.messages')

        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <div class="card">
                    <div class="card-header">
                      {{ $user->name }}
                    </div>
                    <div class="card-body">
                    {{-- grazie a laravel eloquent relationships posso accedere al name di category dentro user --}}
                      {{ $user->details->newsletter ? 'Newsletter SI' : 'Newsletter NO' }} 
                    </div>
                    <div class="card-footer">
                      <a href="{{ url('/') }}" class="btn btn-danger">Indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection