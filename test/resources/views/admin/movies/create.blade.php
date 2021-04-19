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
                
                    {{-- enctype NECESSARIO per i file --}}
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.adminmovies.store') }}">
                        {{-- da mettere sempre in caso di form --}}
                        @csrf
                        {{-- mette dentro ai form un token per usarlo per farci della logica sopra 
                             tramite il middleware VerifyCsrfToken che applica un token alla form e
                             al submit del form testa che il token corrisponda al token del nostro form
                        --}}

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
                                 value="{{ old('name') ? old('name') : '' }}">
                          @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                          @endif
                        </div>

                        <div class="form-group">
                          <label for="movie-code">{{ __('labels.create_form.movie_code') }}</label>
                          <input type="text"
                                 class="form-control" 
                                 id="movie-code" 
                                 name="film_code" 
                                 value="{{ old('film_code') ? old('film_code') : '' }}">
                        </div>

                        <div class="form-group">
                          <label class="category-id" for="movie-title">
                            {{ __('labels.create_form.category') }}
                          </label>
                          {{-- con la tabella pivot categories e movies valorizziamo un checkbox invece della select --}}
                          <div>
                            @foreach($categories_select as $key=>$value)
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input"
                                         type="checkbox"
                                         id="categories"
                                         name="categories[]"
                                         value="{{ $key }}"
                                         {{-- se sto ritornando con un old('categories') e se questo contiene l'id di turno --}}
                                         @if (old('categories') && in_array($key, old('categories'))) checked @endif> 
                                  <label class="form-check-label" for="categories">{{ $value }}</label>
                                </div>
                            @endforeach
                          </div>
                            {{-- {{ Form::select('category_id', $categories_select, 'L', ['placeholder' => 'Selezionare categoria', 'class' => 'form-control', 'category-id' ]) }} --}}
                            {{-- da quando creo la tabella pivot tra movies e categories --}}
                            {{-- {{ Form::select('categories[]', $categories_select, null, ['placeholder' => 'Selezionare una o più categorie', 'class' => 'form-control', 'id'=>'categories', 'multiple']) }} --}}
                        </div>

                        <div class="form-group">
                          <label for="movie-duration">{{ __('labels.create_form.movie_duration') }}</label>
                          <input type="text"
                                 class="form-control" 
                                 id="movie-duration" 
                                 name="duration" 
                                 value="{{ old('duration') ? old('duration') : '' }}">
                        </div>

                        <div class="form-group">
                          <label for="movie-cover">{{ __('labels.create_form.movie_cover') }}</label>
                          {{-- dalla lezione sui file converto l'input a tipo file da tipo text
                                per leggere i file è NECESSARIO mettere enctype="multipart/form-data" nel form --}}
                          <input 
                                type="file" 
                                class="form-control" 
                                id="movie-cover" 
                                name="cover_path" 
                                value="{{ old('cover_path') ? old('cover_path') : '' }}">
                                {{-- l'input type file non viene ricaricato in caso di errore, quindi va ricaricato il file --}}
                          <!--
                          <input type="text"
                                 class="form-control" 
                                 id="movie-cover" 
                                 name="cover_path" 
                                 value="{{ old('cover_path') ? old('cover_path') : '' }}">
                            -->
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('labels.commons.save') }}
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">
                                {{ __('labels.commons.back') }}
                            </a>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection