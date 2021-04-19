jQuery(
    function(){
        var isFetchingUsers = false;
        $('#fetch-users').on('click', fetchUsers);

        // con PHP le chiamate asincrone si fanno con GUZZLE

        function fetchUsers(){
            if (!isFetchingUsers){
                $.ajax({ //come primo parametro prende un oggetto json
                    method: "GET",
                    // url: "https://reqres.in/api/users",
                    url: "https://reqres.in/api/users?delay=3", //per ritardare la chiamata
                    data:{},
                    // data: { name: "John", location: "Boston" }
                    cache: false, //disabilito o abilito il caching 
                    async: true, //per non restare in attesa della risposta
                    timeout: 8000, //dopo quanto deve considerare la chiamata fallita
                    beforeSend: function(){ //posso passare come parametro anche una funzione di callback
                        isFetchingUsers = true;
                        $('#preloader').addClass('open');
                        console.log("beforeSend");
                    },
                    success: function(data, textStatus, jqXHR){ //se la chiamata ha successo invece che mettere .done
                        console.log("success", data, textStatus, jqXHR);
                        
                        if (jqXHR.status === 200){
                            //qualcosa
                        }else{
                            //qualcos'altro
                        };
                        
                    },
                    error: function(jqXHR, textStatus, erroreThrown){ //funzione in caso di ritorno di errore
                        console.log("error", jqXHR, textStatus, erroreThrown);
                        
                    },
                    complete: function(jqXHR, textStatus){ //funzione  che viene seguita in ogni caso alla fine
                        console.log("complete", jqXHR, textStatus);
                        isFetchingUsers = false;
                        $('#preloader').removeClass('open');

                    }

                    //questa cosa somiglia molto al try-catch-finally
                })
            }



                // .done(function( msg ) { //con il .done concatena alla funzione un'altra funzione in caso di successo
                //   console.log("succes", msg.data); //e in quest'altra funzione mostra un messaggio al ritorno
                // })
                // .fail(function(jqXHR, textStatus){
                //     console.log("failed", jqXHR, textStatus)
                // })
        }
    }
)