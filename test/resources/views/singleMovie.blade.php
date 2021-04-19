@extends('layouts.movie')

@section('content')
<main id="main-single-page">
    <section id="movie-data-container">
        <div id="video-container">
            <div id="video-play">
                <div id="play-icon" class="video-play-element" style="background-image: url({{asset('images/play.png')}});"></div>
                <div id="play-label-container" class="video-play-element">
                    <div class="dt h-full">
                        <div class="dtc va-m">
                            trailer
                        </div>
                    </div>
                </div>
            </div>
            <div id="video-overlay" style="background-image: url({{asset('videos/frozen-cover.png')}});"></div>
            <video id="video" controls muted cover="./public/images/frozen-cover.png">
                <source src="{{asset('videos/sample_mp4.mp4')}}" type="video/mp4">
                <source src="{{asset('videos/sample_ogg.ogv')}}" type="video/ogg">
                <source src="{{asset('videos/sample_webm.webm')}}" type="video/webm">
                Your browser does not support the video tag.
            </video>

            <div id="movie-data">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-xs-offset-0 col-lg-6 offset-lg-6">
                            <div class="row">
                                <div class="d-flex col-xs-12 col-lg-4 align-items-lg-center">
                                    <div class="row">
                                        <article class="movie-info-block  col-xs-12">
                                            <div class="single-movie-poster" style="background-image: url({{asset('images/movies/thumbs/2.jpg')}});"></div>
                                            <div class="single-movie-data text-center">
                                                <h4>{{ $movie->name }}</h4>
                                                <a href="single-movie.html" class="btn btn-mv-blue btn-mv single-movie-info-cta">
                                                    INFO FILM
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div id="movie-info"  class="col-xs-12 col-lg-8">
                                    <section>
                                        <h4>Titolo:</h4>
                                        <h3>Frozen<br />Lorem ipsum dolor sit amet</h3>
                                    </section>
                                    <section>
                                        <h4>data di uscita:</h4>
                                        <h5>20/12/2019</53>
                                    </section>
                                    <section>
                                        <h4>durata:</h4>
                                        <h5>120</h5>
                                    </section>
                                    <section>
                                        <h4>regia:</h4>
                                        <h5>
                                            lorem
                                            <br>
                                            ipsum
                                        </h5>
                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   ain>
@endsection
