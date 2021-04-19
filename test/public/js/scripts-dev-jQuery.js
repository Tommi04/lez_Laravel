jQuery(
    function(){
        var current = 0;
        var next = current;
        var heroGallery = $('#hero-gallery');
        var slideShow = $('#slideshow');
        var slides = slideShow.find('.slide'); //restituisce oggetti jQuery
        // var slides = document.querySelectorAll('.slide'); //restituisce un array di nodi
        var dots = heroGallery.find('.dot');
        var navs = heroGallery.find('.gallery-nav-btn');
        var slidesCounter = slides.length;

        var resizeTimeout;
        var viewportWidth;
        var slideshowInterval;
        var currentSlide;
        var currentDot;
        var isOver = false;

        var init = function(){
            setUpSlideshow();
            initGalleryEvents();
            initSlideshow();

            window.onresize = function(){
                if (slideshowInterval){
                    stopSlideshow();
                }
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(handleResize, 100);
            }

            // $('#login-btn').on('click', function(){
            //     $('#myModal').modal('toggle');
            // });

            $(".movie-info").on('click', function(e){
                // console.log(e);
                var movieId = $(this).data('movie-id');
                // console.log(movieId);
                $('.movie-info-box').hide(); // hide applica display:none
                $('#myModal').find('#movie-info-' + movieId).show();
                $('#myModal').modal('show');
                }
            );

            // non funziona... boh
            // $('#myModal').on('hidden.bs.modal', function(e){
            //     $('.movie-info-box').hide(); // hide applica display:none
            // }

            // initModal();
        }

        init();

       /* function initModal(){
            $('#login-btn, #modal-close').on('click', toggleModal); 
            /* mette e toglie la classe a seconda che l'abbia o no
        }
        */

        /* questa sotto sarebbe quella sopra
        function toggleModal(){
            $('#modal-overlay').toggleClass('open');

            if ($('#modal-oerlay').hasClass('open')){
                $('#modal-oerlay').removeClass('open')
            }else{
                $('#modal-oerlay').addClass('open')

            }
        }
        */

        /* questo codice sarebbe quelli sopra
        function initModal(){
            $('#login-btn').on('click', openModal);
            $('#modal-close').on('click', closeModal);
        }

        function openModal(){
            $("#modal-overlay").addClass('open');
        }
        function closeModal(){
            $("#modal-overlay").removeClass('open');
        }
        */

        function initGalleryEvents(){
            
            // è un ciclo for a tutti gli effetti, cicla l'oggetto aumentando l'indice i
            // slides.each(function(i, obj){
            //     console.log(i, $(obj));
            // })

            //altro ciclo più semplice pure in cui ci troviamo direttamente l'oggetto\
            // slides.each(function(){
            //     console($this);
            // }

            slideShow.on('mouseenter', stopSlideshow);
            slideShow.on('mouseleave', playSlideshow);

            dots.on("click", dotClickHandler);
            navs.on("click", navClickHandler)
            
        }

        function dotClickHandler(){
            stopSlideshow();
            console.log(current);
            next = parseInt(this.getAttribute('data-slide'),10);
            handleSlideshow(next);
            playSlideshow();
        }

        function navClickHandler(){
            if (this.getAttribute("data-action") === "n"){
                current >= slidesCounter - 1 ? next = 0 : next++;
            }else{
                current == 0 ? next = slidesCounter - 1 : next--;
            };
            handleSlideshow(next);
        }

        function handleResize(){
            setUpSlideshow();
            playSlideshow();
        }

        function initSlideshow(){
            slideshowInterval = setInterval(function(){
            current >= slidesCounter - 1 ? next = 0 : next++;
            handleSlideshow(next);
            }, 3000);
        };


        function handleSlideshow(next){
            currentSlide = slides[current];
            currentDot = document.querySelector('[data-slide="'+current+'"]');
            // console.log(currentSlide);

            let nextSlide = slides[next];
            let nextDot = dots[next];

            $(currentSlide).removeClass('active');
            $(currentDot).removeClass('active');
            $(nextSlide).addClass('active');
            $(nextDot).addClass('active');

            var newOffset = viewportWidth * next;
            slideShow.css({ transform: "translateX(" + (-newOffset) + "px)"});
            setTimeout(function(){current = next}, 500);

        };

        function playSlideshow(){
            initSlideshow();
        };
        function stopSlideshow(){
            console.log("stp");
            clearInterval(slideshowInterval);
            slideshowInterval = undefined;
        };

        function setUpSlideshow(){
            viewportWidth = $(window).width();
            var galleryWidth = (viewportWidth * slidesCounter) + "px";
            slideShow.css({width: galleryWidth});
            slides.css({width: viewportWidth + "px"});
            // for (let s = 0; s < slidesCounter; s++) {
            //     slides[s].style.width = viewportWidth + "px";   
            // }

        }
    }
);