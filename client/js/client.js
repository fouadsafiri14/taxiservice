var value;
var bol=0;
var messages;
window.onload = function(){


    setInterval(recupererReponse, 1000);
    

};
function remplirDemande()
{
  console.log("reeemplirDemande");
  if(bol==0)
  {
 let xmlhttp = new XMLHttpRequest();

 let donnees = {};


              console.log(messages);
                donnees['latitude']= messages.latitude;

                donnees['longitude']= messages.longitude;

                donnees['arriveelati']= messages.arriveelati;

                donnees['arriveelong']= messages.arriveelong;

                donnees['chauffeur_id']= messages.chauffeur_id;

                donnees['id']=messages.id;
                donnees['message']= 'retard';
                donnees['distance'] = messages.distance;

                 console.log(donnees);

                let donneesJson = JSON.stringify(donnees);

                console.log(donneesJson);
 xmlhttp.onreadystatechange=function(){
   if (this.readyState==4){
      console.log(this);
  document.getElementById('info').innerHTML += "<div id='chauffeur'> le taxi que vous avez choisi ne repond pas </div> <br>";

 document.getElementById('audio').play();
}
}

xmlhttp.open("POST", "ajax/ajouterDemande.php",true);

xmlhttp.send(donneesJson);
}
}


function recupererReponse()

{
    let xmlhttp = new XMLHttpRequest();

     console.log("en train de recuperer reponse");

    xmlhttp.onreadystatechange=function(){

        if (this.readyState==4){

               //if(this.status == 200){
                
                let messages=JSON.parse(this.response);

                console.log("recuperation du msg");

                console.log(messages);

                document.getElementById('info').innerHTML += "<div id='chauffeur'> le taxi selectionné vous dit "+messages[0]['message']+" </div> <br>";

                document.getElementById('audio').play();

            //}

             if(messages[0]['message']=="j'accepte")

              {

               bol=1;
                  
                let xmlhttp1 = new XMLHttpRequest();

                let donnees = {};



                 donnees['latitude']= messages[0]['departlati'];

                 donnees['longitude']= messages[0]['departlong'];

                 donnees['arriveelati']= messages[0]['arriveelati'];

                 donnees['arriveelong']= messages[0]['arriveelong'];

                 donnees['chauffeur_id']= messages[0]['chauffeur_id'];

                 donnees['client_id']=messages[0]['client_id'];

                 donnees['distanceParcourue'] = messages[0]['distance'];



                 let donneesJson = JSON.stringify(donnees);



                xmlhttp1.onreadystatechange=function(){



                    if (this.readyState==4){
                      if(this.status==201){ 
                        document.getElementById('info').innerHTML += "<div id='chauffeur'> la transaction est bien passée</div> <br>";
                          console.log("la transaction est bien passée");
                     }
                     else
                      {
                        
                        xmlhttp3 = new XMLHttpRequest();
                       console.log("n'est pas valid");
                        let donnees = {};

                        donnees['message']="pas d'argent";
                        donnees['latitude']= messages[0]['departlati'];

                        donnees['longitude']= messages[0]['departlong'];
       
                        donnees['arriveelati']= messages[0]['arriveelati'];
       
                        donnees['arriveelong']= messages[0]['arriveelong'];
                        donnees['chauffeur_id']=messages[0]['chauffeur_id'];

                        donnees['id']=messages[0]['client_id'];;
                        donnees['distance'] =  messages[0]['distance'];

                        let donneesJson = JSON.stringify(donnees);
                        
          
                        xmlhttp3.onreadystatechange=function(){
                           
                        if (xmlhttp3.readyState==4){
                         console.log(xmlhttp3);  
                        }
                       }
                    
                        xmlhttp3.open("POST", "ajax/ajouterDemande.php");

                        xmlhttp3.send(donneesJson);
                         
                        console.log("la transaction n'est bien passée");
                        console.log(xmlhttp3);
                        document.getElementById('info').innerHTML += "<div id='chauffeur'> la transaction n'est pas bien passée , veuillez vérifier votre solde!!!</div> <br>";
                      }
      

                    }
                    }
                     xmlhttp1.open("POST", "ajax/transaction.php",true);

                     xmlhttp1.send(donneesJson);

              

            } //fin
              
            if(messages[0]['message']=="je refuse")

              {
              bol=1;
              }
    }

   }

            xmlhttp.open("GET", "ajax/RecupererReponse.php",true);



            xmlhttp.send();



}







function ajoutDemande(e)

 {

      


  value =  e.value;
    var donnees = {};

    

  



        let xmlhttp1 = new XMLHttpRequest();       //  xmlhttp1 récupere des informations sur le client



                xmlhttp1.onreadystatechange=function(){

                         if(this.readyState==4){

                              messages = JSON.parse(this.response);

                              console.log("voilaa");

                              console.log(messages);

                              console.log(messages.longitude);

                               donnees["message"] = "je veux monter";

                               donnees["id"] = messages.id;

                               donnees["prenom"] = messages.prenom;

                               donnees["nom"] = messages.nom;

                               donnees["tel_number"] = messages.tel_number;

                               donnees["pseudo_name"] = messages.pseudo_name;

                               donnees["latitude"] = messages.latitude;

                               donnees["longitude"] = messages.longitude;

                               donnees["arriveelati"] = route._routes[0].inputWaypoints[1].latLng.lat;

                               donnees["arriveelong"] =  route._routes[0].inputWaypoints[1].latLng.lng;

                               donnees["chauffeur_id"] = value;

                               donnees['distance']= route._selectedRoute.summary.totalDistance;

                               messages=donnees;

                           let donneesJson=JSON.stringify(donnees);



                           let xmlhttp = new XMLHttpRequest();  // xmlhttp pour envoyer une demande



                           xmlhttp.onreadystatechange=function(){

                                 if(this.readyState==4){

                                  document.getElementById('info').innerHTML += "<div id='client'>vous avez choisi le taxi Numero " +value+ "</div><br>";
                           
                                 setTimeout(remplirDemande,30000);

                                             }

                          

                                            }

                    xmlhttp.open("POST", "ajax/ajouterDemande.php",true);

                    xmlhttp.send(donneesJson);

                 }

                 }



                    xmlhttp1.open("GET", "ajax/infosClient.php",true);         

                    xmlhttp1.send();       



}