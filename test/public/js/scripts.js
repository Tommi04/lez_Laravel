var current = 0;
var next = current;
var heroGallery = document.getElementById('hero-gallery');
var slideShow = document.getElementById('slideshow');
var slides = heroGallery.getElementsByClassName('slide');
var dots = heroGallery.getElementsByClassName('dot');
var slidesCounter = slides.length;
var resizeTimeout;

var viewportWidth;

//un modo
// var slideshowPrevBtn = document.getElementById('gallery-nav-btn-prev')
// var slideshowNextBtn = document.getElementById('gallery-nav-btn-next')

//un altro modo più snello 
 var galleryNavBtns = document.getElementsByClassName('gallery-nav-btn');

var slideshowInterval;
var currentSlide;
var currentDot;
var isOver = false;

var init = function(){
    setUpSlideshow();
    initGalleryEvents();
    initSlideshow();

    // window.addEventListener('resize', handleResize);

    // il debounce stabilisce un tempo limite dopo il quale in millisecondi deve essere generato l'evento.
    // creiamo un timer che viene inizializzato tutte le volte che l'evento viene generato
    window.onresize = function(){
        if (slideshowInterval){ //se slide show interval è diversa da undefined
            stopSlideshow();
        }
        //succede che ad ogni resize viene cancellato il timeout e ristabilito a 2 secondi con la funzione handleResize
        //in questo modo tutti gli eventi di resize che si generano stringendo o allargando la finestra vengono 
        //timeizzati e sovrascritti ad ogni resize. Quindi non parte mai la funzione perchè ogni volta impsta 2 secondi
        //poi cancella e li reimposta. La funziona parte solamente quando per 2 secondi non ci sono più resize
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 100);
        // così sarebbe cumulativo perchè aggiunge al dom sempre il timeout
        // setTimeout(handleResize, 2000);
    }
    
    //qua sotto creo una variabile oggetto il cui valore della seconda chiave è una funzione, la sua proprietà
    //e la posso richiamare successivamente come una qualsiasi altra funzione, solo con il nome della chiave
    // var myObj = {
    //     chiave: 'valore',
    //     chiave2: function(){
    //         console.log('sono la tua funzione!');
    //     }
    // }
    // console.log(chiave);
    // myObj.chiave2();
}

init();

function initGalleryEvents(){
    
    slideShow.addEventListener('mouseenter', stopSlideshow);
    slideShow.addEventListener('mouseleave', playSlideshow);

    //qua sotto un metodo per fermare lo scorrimento al passaggio del mouse
    // slideShow.addEventListener('mouseenter', function(){
    //     isOver = true;
    // });
    // slideShow.addEventListener('mouseleave', function(){
    //     isOver = false;
    // });

    //qua sotto un altro metodo in cui si uccide la variabile di timeset e si rinizializza

    //un metodo per scorrere con le frecce
    //  slideshowNextBtn.addEventListener('click', function(){
    //      handleSlideshow("n");
    //  });
    //  slideshowPrevBtn.addEventListener('click', function(){
    //      handleSlideshow("p")
    //  });    //funzione che gestisce left e right più snella
    //falla come esercizio
    // slideshowBtns.addEventListener('click', slideImg);

    //con ES6
    // for (const dot of dots) {
    // dot.addEventListener("click", function(){
    //      manageDot(this);
    // }); 
    // }

    for(let i=0;i<dots.length;i++){ 
        dots[i].addEventListener("click", function(){
            stopSlideshow();
            next = parseInt(this.getAttribute('data-slide'),10);
            handleSlideshow(next);
            playSlideshow();
        });
     };
 
     for(let i=0;i<galleryNavBtns.length;i++){ 
        galleryNavBtns[i].addEventListener("click", function(){
         if (this.getAttribute("data-action") === "n"){
             current >= slidesCounter - 1 ? next = 0 : next++;
         }else{
             current == 0 ? next = slidesCounter - 1 : next--;
         };
         handleSlideshow(next);
        })
     }; 
    
}

function handleResize(){
    setUpSlideshow();
    playSlideshow();
}

function initSlideshow(){
    slideshowInterval = setInterval(function(){
     //   if (!isOver){ //esegui il codice solo se non sei sopra col mouse, è un modo
     current >= slidesCounter - 1 ? next = 0 : next++;
    handleSlideshow(next);
     //   }
        
    }, 3000);
};


function handleSlideshow(next){
    currentSlide = slides[current];
    currentDot = heroGallery.querySelector('[data-slide="'+current+'"]');

    let nextSlide = slides[next];
    let nextDot = dots[next];

    currentSlide.classList.remove('active');
    currentDot.classList.remove('active');
    nextSlide.classList.add('active');
    nextDot.classList.add('active');

    var newOffset = viewportWidth * next;
    // slideShow.style.marginLeft = -newOffset + "px"; // sarebbe margin-left ma dal dot notation viene marginLeft. Adesso sto tirando e devo fare -
    // slideShow.style.left = -newOffset + "px"
    slideShow.style.transform = "translateX(" + (-newOffset) + "px)";
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
    viewportWidth = window.innerWidth; //la grandezza interna del viewport
    var listSize = viewportWidth * slidesCounter;
    slideShow.style.width = listSize + "px"; //prendi l'oggettoslideShow, accedi alla write di quest'oggetto, dai alla proprietà width listSize + "px"

    for (let s = 0; s < slidesCounter; s++) {
        slides[s].style.width = viewportWidth + "px";   
    }

}