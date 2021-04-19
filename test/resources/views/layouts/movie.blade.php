<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Laravel')}}</title>
    <!-- <link rel="stylesheet" href="./node_modules/normalize.css/normalize.css"> -->

    <!-- scripts -->
    <!-- @yield('scripts') fattibile per includere altri js solo nei file che mi servono -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts-dev-jQuery.js') }}"></script>
    <script src="{{ asset('js/scripts-api.js') }}"></script>

    <!-- styles  -->
    <!-- in webpack.mix.js copiati da node_modules -->
    <!-- la directory assets la prende dal config app.php -->
    <!-- <link href="{{ asset('css/nm.bootstrap.css') }}" rel="stylesheet"> importato in app.css -->
    <link href="{{ asset('css/nm.all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontaw.all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/single-movie.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">
    <!-- diventerà come sopra -->
    <!-- <link rel="stylesheet" href="./public/css/style.css"> -->
</head>
<body>
    <!-- INCLUDO DA PARTIALS -->
    @include('partials.header')
    <main id="main">
        @yield('content')
    </main>

    <footer id="footer">
        <section id="contants-section">
            <div class="container-fluid">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xs-12 col-md-8 order-md-2 text-center">
                        <div id="footer-logo" style="background-image: url({{ asset('images/musaimg.png') }})"></div>
                    </div>
                    <div class="col-xs-12 text-center col-md-2 order-md-1 ">
                        <div id="footer-social-container">
                            <a href="https://facebook.com" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://instagram.com" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-md-flex col-xs-12 col-md-2 order-3 justify-content-end">
                        <div id="back-to-top" class="d-flex align-items-center">
                            <div class="dt w-full h-full">
                                <div class="dtc va-m">
                                    <i class="fas fa-chevron-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </footer>

    <!-- La modale è meglio scriverla fuori da tutto,  perchè è qualcosa che sta fuori e appare e scompare -->
    <div id="modal-overlay">
        <div id="modal">
            <div id="modal-close-container">
                <span id="modal-close">
                    <i class="far fa-times-circle"></i>
                </span>
            </div>
            <h2>Modal Title</h2>
            <div>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum quasi esse cum ab maxime? Architecto vitae fugiat aut nisi animi porro nobis neque, fuga adipisci assumenda recusandae, nostrum reprehenderit nulla?
                    Iusto est soluta blanditiis ut? Dolorem, delectus nulla porro consequuntur alias, quisquam eaque eos numquam quibusdam natus id iure quia corporis odio sit vero consequatur, commodi optio ea error possimus?
                    Quis saepe autem id eligendi voluptas, sint error iste ratione temporibus corrupti eius, eos voluptate impedit voluptatum ipsum dolore? Distinctio voluptates voluptas delectus enim molestiae cumque ratione deserunt fugiat ut!
                    Tempora rerum esse, eligendi libero suscipit culpa dignissimos optio nostrum delectus molestiae, excepturi exercitationem! Mollitia rem sint similique sit quisquam velit, quo voluptatem nam. Iusto deleniti in explicabo placeat aliquid?
                    Magni alias doloremque deleniti voluptatum veniam, at perspiciatis non! Modi, exercitationem eaque et perspiciatis, excepturi laudantium repellendus error asperiores a soluta repellat dolore, quos magni magnam ratione. Voluptate, quibusdam unde?
                    Quae voluptate sunt provident eius ea? Repudiandae, tempore minus officia unde et sequi hic corporis odit architecto, ad quibusdam! Sequi saepe minima quo quae consequuntur dolorem debitis sapiente dicta molestias?
                    Autem corporis accusamus quis corrupti velit voluptate obcaecati quasi quibusdam. Enim eveniet ex dolor a odio adipisci id fugit non quis. Asperiores, est dicta! Dicta totam accusantium nihil deleniti cumque.
                    Qui vitae sequi eius accusantium! Ullam placeat quos blanditiis eos qui quis nisi? Aliquam quidem aliquid quae est nisi labore, qui eos illo quasi inventore quaerat optio provident, natus tempore?
                </p>
            </div>
        </div>
    </div>

    <div id="preloader">
        <div class="w-full h-full dt">
            <div class="dtc va-m text-center">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
    </div>

    <!-- Modal da bootstrap 3 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="movie-info-1" class="movie-info-box">
                    <div>
                        <strong>Movie 1</strong>
                    </div>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste alias voluptas necessitatibus fugit molestiae quas odit, sapiente voluptatum nemo molestias, sequi ea deleniti quod sit, quidem maxime laudantium atque debitis? Cumque atque perferendis, voluptate possimus repellendus libero neque. Provident eum fugiat aut soluta repellat ut mollitia consectetur? Id, possimus atque?
                </div>
                <div id="movie-info-2" class="movie-info-box">
                    <div>
                        <strong>Movie 2</strong>
                    </div>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste alias voluptas necessitatibus fugit molestiae quas odit, sapiente voluptatum nemo molestias, sequi ea deleniti quod sit, quidem maxime laudantium atque debitis? Cumque atque perferendis, voluptate possimus repellendus libero neque. Provident eum fugiat aut soluta repellat ut mollitia consectetur? Id, possimus atque?
                </div>
                <div id="movie-info-3" class="movie-info-box">
                    <div>
                        <strong>Movie 3</strong>
                    </div>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste alias voluptas necessitatibus fugit molestiae quas odit, sapiente voluptatum nemo molestias, sequi ea deleniti quod sit, quidem maxime laudantium atque debitis? Cumque atque perferendis, voluptate possimus repellendus libero neque. Provident eum fugiat aut soluta repellat ut mollitia consectetur? Id, possimus atque?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>
</body>
</html>
