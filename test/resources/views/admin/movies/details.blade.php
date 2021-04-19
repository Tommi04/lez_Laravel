@extends('layouts.admin-movie')

@section('content')
    <div class="container">

        @include('components.messages')

        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <div class="card">
                    <div class="card-header">
                      {{ $movie->name }}
                    </div>
                    <div class="card-body">
                    {{-- grazie a laravel eloquent relationships posso accedere al name di category dentro movie --}}
                      @forelse( $movie->categories as $mc => $movie_category)
                        {{ $movie_category->name }} 
                        <br>
                      @empty
                        film senza categorie
                      @endforelse
                    </div>
                    <div class="card-footer">
                      <a href="{{ url('/') }}" class="btn btn-danger">Indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection