@extends('layouts.admin-movie')

@section('content')
    <div class="container">

        @include('components.messages')

    {{-- SPOSTATI in components.messages --}}
        {{-- qui dentro ho appena preso la variabile error che deriva da php, dalla session --}}
        {{-- @if( session( 'success' )) --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-xs-12"> --}}
                    {{-- <div class="alert alert-success alert-dismissible fade show" role="alert"> --}}
                      {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                        {{-- <span aria-hidden="true">&times;</span> --}}
                        {{-- {{ session('success') }}  --}}
                        {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                        {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                        {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                      {{-- </button> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- @endif --}}

    {{-- qui dentro ho appena preso la variabile error che deriva da php, dalla session --}}
    {{-- @if( session( 'error' )) --}}
            {{-- prendere l'errore dalla sessione --}}
        {{-- @php  --}}
            {{-- $creation_errors = session('error') --}}
        {{-- @endphp --}}
        {{-- <div class="row"> --}}
            {{-- <div class="col-xs-12"> --}}
                {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> --}}
                  {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                    {{-- <span aria-hidden="true">&times;</span> --}}
                    {{-- <strong>{{ $creattion_error['error_message'] }}</strong> --}}
                    {{-- <p> --}}
                        {{-- {{ $creation_errors['details'] }} --}}
                    {{-- </p> --}}
                    {{-- prendere l'errore dalla sessione --}}
                    {{-- {{ session('error') }}  --}}
                    {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                    {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                    {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                  {{-- </button> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- @endif --}}

        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <div class="card">
                    <div class="card-header">
                      Lista film
                    </div>
                    <div class="card-body">

                        <p class="card-text">
                            {{-- questo è un ciclo proprio di laravel, al posto del ciclo sotto foreach --}}
                            <ul class="list-group">
                            @forelse($movies as $m => $movie)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img class="media-object" width="150" src="{{ asset('storage/'.$movie->cover_path) }}" alt="{{ $movie->name . ' cover' }}">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-8">
                                                                {{-- in questo modo conta le categorie passate
                                                                    {{ $movie->name }} <span class="badge">{{ count($movie->categories) }}</span> 
                                                                --}}
                                                                {{-- invece qua sotto gliele ho passate contate con la funziona withCount --}}
                                                                {{ $movie->name }} <span class="badge">{{ $movie->categories_count }}</span>
                                                                <br>
                                                                {{-- @foreach ( $movie->categories as $c=>$category)
                                                                    {{-- slug è per passare parametri alla rotta -}
                                                                    <a href="{{ route('single-category', ['slug' => $category->name]) }}">
                                                                    {{ $category->name }}
                                                                    </a>
                                                                @endforeach --}}
                                                            </div>
                                                            <div class="d-flex justify-content-end col-xs-12 col-md-4">
                                                                <a href="{{ route('admin.adminmovies.show', ['movie' => $movie->id]) }}" class="btn btn-primary flex-end movies-list-action">
                                                                <i class="fas fa-plus"></i>
                                                                </a>
                                                                <a href="{{ route('admin.adminmovies.edit', ['movie' => $movie->id]) }}" class="btn btn-success flex-end movies-list-action">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <form method="post" action="{{ route('admin.adminmovies.destroy', ['movie' => $movie->id]) }}" >
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-danger flex-end movies-list-action">
                                                                    <span class="fas fa-trash-alt"></span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                            @empty
                                <li class="list-group-item alert alert-warning" role="alert">
                                    Spiacente non ci sono film nella base dati
                                    <a href="#" class="btn btn-primary">Clicca qui per aggiungere il tuo primo film</a>
                                </li>
                            @endforelse
                            </ul>
                        <p>
                    
                    {{-- 
                        @if (count($movies) > 0)
                        <p class="card-text">
                          <ul class="list-group">
                            @foreach ($movies as $movie_name)
                                <li class="list-group-item">
                                    {{ $movie_name }}
                                </li>
                            @endforeach
                            </ul>
                        </p>
                        @else
                            <div class="alert alert-warning" role="alert">
                              Spiacente non ci sono film nella base dati
                            </div>
                            <a href="#" class="btn btn-primary">Clicca qui per aggiungere il tuo primo film</a>
                        @endif
                    --}}
                      <a href="{{ route('admin.adminmovies.create') }}" class="btn btn-primary">Aggiungi</a>
                      <a href="{{ url('/') }}" class="btn btn-danger">Indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection