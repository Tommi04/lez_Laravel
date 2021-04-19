
    {{-- qui dentro ho appena preso la variabile new-movie-error che deriva da php, dalla session --}}
    @if( session( 'new-movie-success' ))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    {{ session('new-movie-success') }} 
                    {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                    {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                    {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                  </button>
                </div>
            </div>
        </div>
    @endif

    {{-- qui dentro ho appena preso la variabile new-movie-error che deriva da php, dalla session --}}
    @if( session( 'new-movie-error' ))
            {{-- prendere l'errore dalla sessione --}}
        @php 
            $creation_errors = session('new-movie-error')
        @endphp
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <strong>{{ $creattion_error['error_message'] }}</strong>
                    @isset($creation_errors['error_message'])
                        <strong>{{ $creation_errors['error_message'] }}</strong>
                    @endisset
                    @isset($creation_errors['details'])
                        <p>
                            {{ $creation_errors['details'] }}
                        </p>
                    @endisset
                    {{-- prendere l'errore dalla sessione --}}
                    {{-- {{ session('new-movie-error') }}  --}}
                    {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                    {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                    {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                  </button>
                </div>
            </div>
        </div>
    @endif

    {{-- qua sotto le direttive che ci vengono dalle exceptions che abbiamo personalizzato noi in
    app > Exceptions > Handler.php funzione render() usando i metodi magici di laravel--}}
    @if( session( 'warning' ))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    {{ session('warning') }} 
                  </button>
                </div>
            </div>
        </div>
    @endif
    @if( session( 'not_found' ))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    {{ session('not_found') }} 
                  </button>
                </div>
            </div>
        </div>
    @endif