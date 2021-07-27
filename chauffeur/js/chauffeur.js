window.onload =function(){                //des que la page est chargé on execute 

  xmlhttp = new XMLHttpRequest();
         console.log(xmlhttp);
         xmlhttp.onreadystatechange = function()
           {
               if(xmlhttp.readyState==4)
                {
                    console.log(xmlhttp);
                }
           }
     
        xmlhttp.open("GET","ajax/conn.php",true);
        xmlhttp.send();





    let valid_0 = document.querySelector("#refuser");  



    let valid_1 = document.querySelector("#accepter");



   



    valid_0.addEventListener("click", ajoutReponseNegatif);       // s'il a raccroché 







    valid_1.addEventListener("click", ajoutReponsePositif);       //s'il a accepté







    setInterval(recupererDemande, 2000);



}



var iconePassager = L.icon({

    iconUrl: "../images/client.png",

    iconSize: [50, 50],

    iconAnchor: [25, 50],                //icone pour le client

    popupAnchor: [0, -50]

});

var markerClient;

var messages ; 



 function ajoutReponsePositif()



  {

    let donnees = {};



       donnees["message"]= "j'accepte";  

        donnees["id"] =messages[0]['client_id']  ;                    //info sur chauffeur(localisation,nom,prenom,....)          

        donnees["latitude"] = messages[0]['departlati'] ;

        donnees["longitude"] = messages[0]['departlong'] ;                // on ajoute la reponse

        donnees["arriveelati"] = messages[0]['arriveelati'];

        donnees["arriveelong"] = messages[0]['arriveelong'];

        donnees["chauffeur_id"] = messages[0]['chauffeur_id'];

         donnees['distance'] = messages[0]['distance'];    

             

        let donneesJson = JSON.stringify(donnees);







        let xmlhttp = new XMLHttpRequest();



        



        xmlhttp.onreadystatechange = function(){

            if(this.readyState==4){

               // if(this.status==201){



                document.getElementById('info').innerHTML += "<div id='chauffeur'>vous avez accepté la demande </div> <br>";

                

             if(!markerClient)

               {

                markerClient = L.marker([messages[0]['departlati'],messages[0]['departlong']],{icon: iconePassager}).bindPopup("<p>JE SUIS LA</p>");

                markerClient.addTo(mymap);

               }

             else

              {

                mymap.removeLayer(marker);

                marker = L.marker([messages[0]['departlati'],messages[0]['departlong']],{icon: iconePassager}).bindPopup("<p>JE SUIS LA</p>");

                marker.addTo(mymap);

              }



              route =  L.Routing.control({

                geocoder: L.Control.Geocoder.nominatim(),

                waypoints: [

                L.latLng(messages[0]['departlati'],messages[0]['departlong']),

                 L.latLng(messages[0]['arriveelati'],messages[0]['arriveelong']) ],

                lineOptions: {styles:[{color: 'green', opacity: 1, weight: 7}] }   ,          



          });   

          console.log(route);

     route.addTo(mymap);



     route1 =  L.Routing.control({

        geocoder: L.Control.Geocoder.nominatim(),

        waypoints: [

        L.latLng(messages[0]['departlati'],messages[0]['departlong']),

         L.latLng(e1.latitude,e1.longitude) ],

        lineOptions: {styles:[{color: 'blue', opacity: 1, weight: 7}] }   ,          


  });  

   

  route1.addTo(mymap);
 messages=null;
  document.getElementsByClassName('touche')[0].innerHTML="<button id='supprimer' onclick='supprimer()'>supprimer les détails</button> <button onclick='affichage()' id='afficher'>afficher les détails</button>";
   


                }

            }



                    xmlhttp.open("POST", "ajax/ajouterReponse.php",true);



                    xmlhttp.send(donneesJson);

    }





function ajoutReponseNegatif()

{





          let donnees = {};

              console.log(messages);

            

              donnees["message"]= "je refuse";  

              donnees["id"] =messages[0]['client_id']  ;                    //info sur chauffeur(localisation,nom,prenom,....)          

              donnees["latitude"] = messages[0]['departlati'] ;

              donnees["longitude"] = messages[0]['departlong'] ;                // on ajoute la reponse

              donnees["arriveelati"] = messages[0]['arriveelati'];

              donnees["arriveelong"] = messages[0]['arriveelong'];

              donnees["chauffeur_id"] = messages[0]['chauffeur_id'];

              donnees['distance'] = messages[0]['distance'];  



              let donneesJson = JSON.stringify(donnees);

              console.log(donneesJson);

      



              let xmlhttp = new XMLHttpRequest();



              



              xmlhttp.onreadystatechange = function(){



                  if(this.readyState==4){



                    document.getElementById('info').innerHTML += "<div id='chauffeur'> vous avez refusé la demande </div> <br>";

                         messages=null;

                      }      



            }



            



                      xmlhttp.open("POST", "ajax/ajouterReponse.php",true);



                          xmlhttp.send(donneesJson);

  }    



  

 

function recupererDemande()

{

    

    let xmlhttp = new XMLHttpRequest();



    xmlhttp.onreadystatechange=function(){

       



        if (this.readyState==4){



               //if(this.status == 200){

                 

                 messages = JSON.parse(this.response);

                 console.log(messages);
                 if(messages[0]['message']=="retard")
                 { 

                    document.getElementById('info').innerHTML += "<div id='client'> vous n'avez pas répondu au client "+messages[0]['client_id']+"</div> <br>";
                    document.getElementById('audio').play();
                                         messages=null;
                   }
                  if(messages[0]['message']=="pas d'argent")
                   { 
                       
                      document.getElementById('info').innerHTML += "<div id='client'> le client a un problème attendez une autre demande!!  </div> <br>";
                      route.remove(mymap);
                      route1.remove(mymap);
                      mymap.removeLayer(markerClient);
                     }
                  else 
                  {
                    document.getElementById('info').innerHTML += "<div id='client'> vous avez une demande de la part client  "+messages[0]['client_id']+",trajet à parcourue "+messages[0].distance+" en mètres</div> <br>";

                    document.getElementById('audio').play();
                  }


            //}

        }

    }



            xmlhttp.open("GET", "ajax/RecupererDemande.php",true);

            xmlhttp.send();

}


   

