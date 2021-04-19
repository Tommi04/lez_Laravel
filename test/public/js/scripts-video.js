var video = document.getElementById( 'video' );
// var video = $( '#video' );
var videoCover = document.getElementById( 'video-overlay' );
var playBtn = document.getElementById( 'video-play' );

if(video){
    video.addEventListener( 'ended', function() {
        alert('video ended!' );
        videoCover.classList.remove('hidden');
    });
    
    playBtn.addEventListener( 'click', function() {
        // video.get(0).play();
        videoCover.classList.add('hidden');
        video.play();
    });
}else{
    $('.owl-carousel').owlCarousel({
        // posso staccare queste proprietà e metterle dentro le responsive
        loop:true, //è il loop delle immagini
        margin:10, //è il margine tra le immagini
        nav:false, //sono le freccette per scorrerle
        responsive:{
            0:{
                items:1,
            },
            768:{ //è un breakpoint. li ho personalizzati
                items:3,
                margin: 10,
            },
            992:{
                items:4,
                margin: 50,
            },
            1200:{
                items:5,
            }
        }
    })
}

$('.hall-carousel-nav-btn').on('click', moveCarousel);

function moveCarousel(){
    var clicked = $(this); //convertito in oggetto jQury

    /* in javascript no jQuery
    var clicked = this;
    this.getAttribute('data-action');
    */
    
    var direction = clicked.data('action'); //per prendere l'attributo data in jQuery
    var owl = $('.owl-carousel');
    if (direction == "p"){
        owl.trigger('prev.owl.carousel');
    }else{
        owl.trigger('next.owl.carousel');
    }
}