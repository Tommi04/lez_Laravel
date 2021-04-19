//++++++++ jQuery è più compatibile di js+++++++++++++//

//prendere un elemento dal suo id var 
// element = document.getElementById('element')
// elements = document.getElementsByClassName('classname')
// elementByTags = document.getElementsByTagName('span')

//in questo modo jQuery se ci sono più di 1 elemento dentro il DOM vengono messi in un array
var element = $('#element');
var elements = $('.element');
var elementByTags = $('span');


//questo qua sotto in jQuery diventa
// for(let i=0;i<dots.length;i++){ 
//     dots[i].addEventListener("click", function(){
//     });
//  };

elements2.on('click', handleClick); 


//un caso di addEventListener e aggiunta di elementi tramite classico java
$(document).ready(
    function(){
        var container = document.getElementById('element');
        var boxes = documento.getElementsByClassName('box');

        for (let i = 0; i < boxes.length; i++) {
            boxes[i].addEventListener('click', clickHandler);
        };

        function clickHandler(){
            console.log('click');
        }

        setTimeout(
            function(){
                var newSpan = document.createElement('span');
                newSpan.classList = 'box';
                container.appendChild(newSpan);
                newSpan.addEventListener('click', clickHandler)
            }, 2000
        );
    }
)


//un caso di addEventListener e aggiunta di elementi tramite jQuery
$(document).ready(
    function(){
        var container = $('#element');
        var boxes = $('.box');
        //per prendere gli elementi con classe .box dentro all'elemento con id #element potrei fare in jQUery
        // var boxes2 = container.get(0).getElementsByClassName(''box'); MA è UNA ZOZZERIA
        //questo perchè mi posiziono al primo elemento del nodo container e prendo la class name tramite js
        //MOLTO MEGLIO QUA SOTTO CHE FUNZIONA PER QUALUNQUE SELECTOR (querySelector). POSSO ANCHE FARE .find().find()
        //anche se il .find prende solo l'ultimo elemento che trova con quel selector
        var boxes2 = container.find('box');

        // se comincio, ho preso gli elementi con jQuery con jQuery devo fare tutto all'interno della funzione in jQuery
        
        //Per cambiare CSS in js
        // var mybox = document.getElementById('#mybox');
        // box.style.backgroundColor = 'red';
        // box.style.width = '300px';
        // box.style.height = '300px';

        //Cambiare CSS con jQuery. è un oggetto json quindi potremmo anche farcelo mandare da API
        var mybox = $('#mybox');
        mybox.css({backgroundColor: 'red', height:'300px', width: '300px'});

        //per aggiungere una classe con jQuery
        $(mybox).addClass('myclass');
        //box.classList.add('myclass'); PER AGGIUNGERE UNA CLASSE IN JAVA

        //per rimuovere una classe con jQuery
        $(mybox).removeClass('myclass');


        //qua sotto per passare dei parametri alla funzione chiamata tramite .on (.addEventListener in js)
        //con jQuery il .on aggiunge l'evento di listen ad ogni elemento aggiunto successivamente
        //container contiene i box, quindi metto .on a container e dentro passo il parametro aggiuntivo che
        //identifica l'elemento su cui deve stare in ascolto a cui aggiunge l'eventListener
        container.on('click', '.boxes', {foo:"bar"}, clickHandler);

        setTimeout(
            function(){
                container. append('<span class="box"></span>');
                //ma con jQuery abbiamo anche il prepend che appende all'inizio e non alla fine
                container.prepend('<span class="box">prepend!</span>');

                //questo sotto non è fatto in jQuery e non va bene
                // var newSpan = document.createElement('span');
                // newSpan.classList = 'box';
                // container.appendChild(newSpan);
                // newSpan.addEventListener('click', clickHandler)
            }, 2000
        );
        
        function clickHandler(event){
            //uso la variabile che gli ho passato da esterno
            console.log('click', event.data.foo);
        }
    }
)

//PER FARE LE ANIMAZIONI USA GREENSOCK(GSAP) E NON JQUERY