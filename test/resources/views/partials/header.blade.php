
    <!-- <div style="width: 50px; height: 50px;" class="bg-light-blue"> ciao</div> lo style è solo per vedere se funziona -->
    <header id="header" class="bg-dark-blue">
        <div class="container-fluid">
            <div class="row align-content-center">
                <div class="d-flex col-xs-6 justify-content-center col-md-2 justify-content-md-start align-items-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/musa-vision-logo.png') }}" alt="musaformazione" srcset="">
                    </a>
                </div>
                <nav id="main-menu" class="col-xs-hidden col-md-8">
                    <div class="dt w-full h-full">
                        <div class="dtc va-m">
                            <ul>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <a href=""><i class="fas fa-film"></i>Film</a>
                                        </div>
                                    </div>
                                </li>
                                <li><div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <div class="menu-separator"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <a href=""><i class="fas fa-couch"></i>Sale</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <div class="menu-separator"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <a href=""><i class="fas fa-ticket-alt"></i>Prenotazioni</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <div class="menu-separator"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dt w-full-hfull">
                                        <div class="dtc va-m">
                                            <a href=""><i class="fas fa-phone-alt"></i>Contatti</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="secondary-menu" class="col-xs-6 col-md-2 ">
                <div class="dt w-full h-full">
                    <div class="dtc va-m">
                        <ul>
                            <li>
                                <div class="dt w-full-hfull">
                                    <div class="dtc va-m">
                                        @guest
                                            <a href="{{ route('login') }}" class="mv-header-btn">login</a>
                                                {{-- <button id="login-btn"class="mv-header-btn">login</button> --}}
                                            </div>
                                        @else
                                            <a class="mv-header-btn" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                </div>
                            </li>
                            <li>
                                <div class="dt w-full-hfull">
                                    <div class="dtc va-m">
                                        <div class="menu-separator"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dt w-full-hfull">
                                    <div id="search-icon" class="dtc va-m">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </header>