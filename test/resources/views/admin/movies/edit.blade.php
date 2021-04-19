@extends('layouts.admin-movie')

@section('content')
<div class="container">
    {{-- qua sotto è per recuperare gli errori dal metodo create() in admin.AdminMoviesController --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- spostato nella lista --}}
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                
                    {{-- {{ Form::open(['route' => ['admin.adminmovies.update', $movie->id], 'method' => 'patch' ]) }} --}}
                    {{-- posso riprenderlo anche passatomi da esterno --}}
                    {{ Form::open($form_config) }}
                    {{  Form::token() }}
                    {{-- con laravel collective si può fare come sopra 
                        <form method="POST" action="{{ route('admin.adminmovies.update', ['id' => $movie->id]) }}"> 
                    --}}
                        {{-- da mettere sempre in caso di form --}}
                        {{--  con laravel collective si può fare il token come sopra
                            @csrf 
                        --}}
                        {{-- mette dentro ai form un token per usarlo per farci della logica sopra 
                             tramite il middleware VerifyCsrfToken che applica un token alla form e
                             al submit del form testa che il token corrisponda al token del nostro form
                        --}}
                        
                        {{-- un modo per passargli il metodo in path --}}
                        @method('PATCH')
                        

                        {{-- tracciare l'errore per ogni singolo campo, lo riprendo sotto--}}
                        {{-- @error('name')
                            CAMPO NAME IN ERRORE
                        @enderror --}}

                        {{-- labels si trova in resorces>lang>it>labels.php e ci sono tutti i valori corrispondenti alle proprietà dopo labels. --}}
                        <div class="form-group">
                          <label class="control-label" for="movie-title">{{ __('labels.create_form.movie_name') }}</label>
                          {{-- il value deve essere vuoto o con il valore del withInput o della form request e
                               possiamo accedere a questi valori tramite una funzione chiamate old --}}
                          <input type="text"
                                 class="form-control @error('name') is-invalid @enderror" 
                                 id="movie-title" 
                                 name="name" 
                                 value="{{ old('name') ? old('name') : $movie->name }}">
                          @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                          @endif
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="movie-code">{{ __('labels.create_form.movie_code') }}</label>
                          <input type="text"
                                 class="form-control" 
                                 id="movie-code" 
                                 name="film_code"
                                 {{-- questo sotto tolto insieme a readonly e disabled per non fargli modificare il code --}}
                                 readonly
                                 value="{{ old('film_code') ? old('film_code') : $movie->film_code }}">
                        </div>

                        {{-- con la tabella pivot categories e movies valorizziamo un checkbox invece della select --}}
                        <div>
                          @foreach($categories as $category)
                            @if(old('categories'))
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input"
                                         type="checkbox"
                                         id="categories"
                                         name="categories[]"
                                         value="{{ $category->id }}"
                                         {{-- se sto ritornando con un old('categories') e se questo contiene l'id di turno --}}
                                         @if (in_array($category->id, old('categories'))) checked @endif> 
                                  <label class="form-check-label" for="categories">{{ $category->name }}</label>
                                </div>
                            @else
                                @php
                                    $found = false;
                                    $checked = '';
                                @endphp
                                @foreach($movie->categories as $mc => $movie_category)
                                        @if($movie_category->id === $category->id && !$found)
                                            @php
                                                $found = true;
                                                $checked = 'checked';
                                            @endphp
                                        @endif
                                @endforeach

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="categories"
                                        name="categories[]"
                                        value="{{ $category->id }}" {{ $checked }} > 
                                    <label class="form-check-label" for="categories">{{ $category->name }}</label>
                                </div>
                            @endif
                          @endforeach
                        </div>

                        <div class="form-group">
                          <label for="movie-duration">{{ __('labels.create_form.movie_duration') }}</label>
                          <input type="text"
                                 class="form-control" 
                                 id="movie-duration" 
                                 name="duration" 
                                 value="{{ old('duration') ? old('duration') : $movie->duration }}">
                        </div>

                        <div class="form-group">
                          <label for="movie-cover">{{ __('labels.create_form.movie_cover') }}</label>
                          <input type="text"
                                 class="form-control" 
                                 id="movie-cover" 
                                 name="cover_path" 
                                 value="{{ old('cover_path') ? old('cover_path') : $movie->cover_path }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('labels.commons.update') }}
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">
                                {{ __('labels.commons.back') }}
                            </a>
                        </div>

                    {{-- </form> --}}
                    qua sotto usando laravel collective
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection