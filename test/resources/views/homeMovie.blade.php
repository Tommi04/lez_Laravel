@extends('layouts.movie')

@section('content')
<!-- posso usare le variabili che vengono passate dal controller alla view -->
{{-- {{$pageTitle}} --}}
    @component('components.gallery', ['slides' => $gallery, 'dots' => $dots])
    <!-- ma il component può prendere anche dei dati -->
    {{-- @component('components.gallery', ['test' => 'valore di test', 'dots' => $dots]) --}}
        <!-- dal controller arriva l'array $gallery. Lo prendo e lo ributto a gallery -->
    {{-- @component('components.gallery', ['slides' => $gallery]) --}}
        {{-- <!-- {{$gallery}} --> --}}
        {{-- <!-- qua in mezzo posso scriverci qualcosa per iniettare del contenuto che sarà richiamato con {{$slot}} in gallery --> --}}
        {{-- <!-- <strong>Whoops!</strong> Something went wrong! --> --}}
    @endcomponent
<section>
    <div class="box">
        <div class="btn btn-default movie-info" data-movie-id="1"></div>
        <div class="btn btn-default movie-info" data-movie-id="2"></div>
        <div class="btn btn-default movie-info" data-movie-id="3"></div>
    </div>
</section>
<section>
    <div>
        <div id="fetch-users" class="btn btn-primary">
            Chiamata API
        </div>
    </div>
</section>

<!-- Button trigger modal -->
<!-- con gli attributi 'data-toggle' e 'data-target' punta alla modale e fa tutto da solo,
     posso spostare questi attributi in un mio bottone e farebbe tutto in automatico,
     ma ho gestito la modale da aprire tramite bootstrap
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button> -->

<section id="movies" class="padded-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 text-center">
              <h2 class="section-title text-uppercase opaque">FILMS</h2>
            </div>
        </div>

        <div id="movies-wall" class="row justify-content-center">
            @foreach ($movies as $movie )
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset($movie->cover_path)}})"></div>
                    <h4>{{ $movie->name }}</h4>
                    <a href="{{ route('movies.show', ['id' => $movie->id]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            @endforeach
            <!-- <video src="" poster=""></video>  il poster è un immagine che usa finchè non è caricato il file video -->
            
            {{-- <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3"> <!-- ha 12 colonne quindi dividendo bene viene la progressione corretta -->
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide1.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide2.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide3.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                    </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide4.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide5.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide6.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide1.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide2.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide3.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article>
            <article class="single-movie-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-0 col-lg-3">
                <div class="single-movie-data text-center">
                    <div class="single-movie-poster" style="background-image: url({{asset('images/slides/slide4.jpg')}})"></div>
                    <h4>TITOLO</h4>
                    <a href="{{ route('movies.show', ['id' => 1]) }}" class="btn btn-mv-blue btn-mv">INFO FILM </a>
                </div>
            </article> --}}
        </div>
    </div>
</section>
<section id="halls" calss="padded-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 text-center">
                <h2 class="section-title text-uppercase opaque">SALE</h2>
            </div>
        </div>
        <div id="halls-wall" class="row justify-content-center">
            <!-- <video src="" poster=""></video>  il poster è un immagine che usa finchè non è caricato il file video -->
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 1</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 2</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 3</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 4</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 5</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
            <article class="single-hall-block col-xs-12 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-0 col-lg-4">
                <div class="hall-data text-center">
                    <div class="single-hall-img" style="background-image: url({{asset('images/sala-1.png')}})"></div>
                    <h4>SALA 6</h4>
                    <a href="single-hall.html" class="btn btn-mv-purple btn-mv single-hall-info-cta">Prenota </a>
                </div>
            </article>
        </div>
    </div>
</section>
<section id="book-now" class="padded-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <div class="section-title-opaque-container">
                    <h2 class="section-title text-uppercase">prenotazione</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xs-12">
                <div class="book-now-form-container text-center">
                    <div class="row">
                        <!-- qua sotto nascondo le colonne in xs e md -->
                        <div class="col-md-6 d-md-block">
                            <img src="{{ asset('images/musaimg.png') }}" alt="">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <form>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email address</label>
                                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">File input</label>
                                  <input type="file" id="exampleInputFile">
                                  <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox"> Check me out
                                  </label>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
