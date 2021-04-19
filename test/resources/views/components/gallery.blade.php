{{-- {{ print_r($slot)}} --}}
{{-- {{$test}}  --}}
        {{-- in automatico se dal file che usiamo stiamo passando un array con un component,
          ci verrà creata automaticamente una variabile che si chiama come la chiave dell'array --}}
{{-- {{print_r($slides)}} --}}
<!-- per gestiore il touch nella galleria prova jQuery touchswipe -->
<section id="hero-gallery">
    <div id="gallery-slideshow">
        <div id="gallery-nav-prev" class="gallery-nav">
            <div class="dt w-full h-full">
                <div class="dtc va-m">
                    <span class="gallery-nav-btn"  id="gallery-nav-btn-prev" data-action="p">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </div>
            </div>
        </div>
        <div id="gallery-nav-next" class="gallery-nav">
            <div class="dt w-full h-full">
                <div class="dtc va-m">
                    <span class="gallery-nav-btn" id="gallery-nav-btn-next" data-action="n">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <ul id="slideshow">
            <!-- DA USARE QUANDO GLI INIETTIAMO QUALCOSA DALL'ALTRA PAGINA CON I COMPONENTS -->
            <!-- @foreach($slides as $s => $slide)
                @php
                    $slide_active = $s === 0 ? 'active' : '';
                @endphp
                {{-- <li class="slide {[$slide_active]}" style="background-image: url({{asset('images/slides/'.{{$slide['url']}})}})"> --}}
                    {{-- <div> --}}
                        {{-- <h2 style="text-align: center; color: #fff; font-size: 5rem">{{$slide['title']}}</h2> --}}
                    {{-- </div></li> --}}
            @endforeach -->
            <li class="slide active" style="background-image: url({{asset('images/slides/slide1.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div></li>
            <li class="slide" style="background-image: url({{asset('images/slides/slide2.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div>
            </li>
            <li class="slide" style="background-image: url({{asset('images/slides/slide3.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div>
            </li>
            <li class="slide" style="background-image: url({{asset('images/slides/slide4.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div>
            </li>
            <li class="slide" style="background-image: url({{asset('images/slides/slide5.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div>
            </li>
            <li class="slide" style="background-image: url({{asset('images/slides/slide6.jpg')}})">
                <div>
                    <h2 style="text-align: center; color: #fff; font-size: 5rem">Titolo film</h2>
                </div>
            </li>
        </ul>
        @if($dots)
            <div id="gallery-dots">
                <div class="dot active" data-slide="0"></div>
                <div class="dot" data-slide="1"></div>
                <div class="dot" data-slide="2"></div>
                <div class="dot" data-slide="3"></div>
                <div class="dot" data-slide="4"></div>
                <div class="dot" data-slide="5"></div>
            </div>
        @endif
    </div>
</section>