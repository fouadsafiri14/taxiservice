function supprimer(){document.getElementsByClassName('leaflet-top leaflet-right')[0].style.display="none";}
function affichage(){document.getElementsByClassName('leaflet-top leaflet-right')[0].style.display="flex";}

var mymap = L.map('mapid').setView([31.688515601838468, -4.9585248359206355], 18); 

L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
              // Il est toujours bien de laisser le lien vers la source des données
              attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
              minZoom: 1,
              maxZoom: 20
          }).addTo(mymap);

var iconeTaxi = L.icon({
              iconUrl: "../images/taxi.png",
              iconSize: [50, 50],                     //icone pour les Taxis
              iconAnchor: [25, 50],
              popupAnchor: [0, -50]
          });

var iconeClient = L.icon({
              iconUrl: "../images/client.png",
              iconSize: [50, 50],
              iconAnchor: [25, 50],                //icone pour le client
              popupAnchor: [0, -50]
          });

var marker;
var route;
var e1;
var e2;
var circle;
var markerTaxis;
let doPosition = function() {


  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
             console.log(position);
          if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp2=new XMLHttpRequest();          
          }
        else                         //AJAX POUR INSERER LA POSITION DU CLIENT LA BASE DE DONNEE LES COORDONNEES
          {// code for IE6, IE5
         xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
           }

           e1 = position.coords;       //pour trouver l'itinéraire
           mymap.panTo(new L.LatLng(e1.latitude,e1.longitude));  

           mymap.on('click', function (e) {
            e2=e;
          if(!route)
            {
            
             route =  L.Routing.control({
                            geocoder: L.Control.Geocoder.nominatim(),
                            waypoints: [
                            L.latLng(e1.latitude, e1.longitude),
                             L.latLng(e2.latlng) ],
                            lineOptions: {styles:[{color: 'green', opacity: 1, weight: 7}] }   ,          

                      });   
                      console.log(route);
                 route.addTo(mymap); 
                 
                 document.getElementById('touche').innerHTML="<button id='supprimer' onclick='supprimer()'>supprimer les détails</button> <button onclick='affichage()' id='afficher'>afficher les détails</button>"
            }
            else
            {          
              console.log(route);
               
            
                
                route.setWaypoints([ L.latLng(e1.latitude, e1.longitude),
                             L.latLng(e2.latlng)]);       
            }
            
             
               });

           
         console.log('current position', position.coords.latitude, position.coords.longitude);
          if(marker)
          { 
            mymap.removeLayer(marker);
            mymap.removeLayer(circle);
            marker = L.marker([position.coords.latitude,position.coords.longitude],{icon: iconeClient}).bindPopup("<p>passager </p>");
           marker.addTo(mymap);
            circle = L.circle([position.coords.latitude,position.coords.longitude], {
              color: 'blue',
              fillColor: '#008bff',
               fillOpacity: 0.1,
               radius: 300
              }).addTo(mymap);
          }
          else
          {
            marker = L.marker([position.coords.latitude,position.coords.longitude],{icon: iconeClient}).bindPopup("<p>passager </p>");
           marker.addTo(mymap);
           console.log(marker);
           circle = L.circle([position.coords.latitude,position.coords.longitude], {
              color: 'blue',
              fillColor: '#008bff',
               fillOpacity: 0.1,
               radius: 300
              }).addTo(mymap);
          }
          
           
          xmlhttp2.open("GET","ajax/ajouterPositionClient.php?latitude="+position.coords.latitude+"&longitude="+position.coords.longitude+"",true);
              xmlhttp2.send();                       //ajouter à la base de donnees
              
            

      });
  }
}


if ("geolocation" in navigator) 
 {
   doPosition();
    setInterval(doPosition,7000);  // obtenir la position et la modifier en base de donnee et ajouter un marqueur à la carte
 } 
 else
  { 
     alert("Le service de géolocalisation n'est pas disponible sur votre ordinateur."); 
  }



var markerTaxis=[] ;
var taxis;

setInterval(function()
{

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
}                     
else
 {// code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");      // AJAX POUR AFFICHAGE DES TAXIS
 }

 xmlhttp.open("GET","ajax/positionsChauffeurs.php",true);
 xmlhttp.send();

 
  xmlhttp.onreadystatechange = function() {
         if(this.readyState==4) {  
     taxis =JSON.parse(this.responseText);
      console.log(taxis);
 
   


    for(taxi in taxis)
     {
       
     let distance = L.latLng([taxis[taxi].latitude,taxis[taxi].longitude]).distanceTo([e1.latitude, e1.longitude]);
     console.log(distance);
       if(distance<10000){ 
      
       if(markerTaxis[taxi])
         {
           mymap.removeLayer(markerTaxis[taxi])
           markerTaxis[taxi] = L.marker([taxis[taxi].latitude,taxis[taxi].longitude],{icon: iconeTaxi}).bindPopup("<button  id='envoyer' value='"+taxis[taxi].id+"' onclick='ajoutDemande(this)' >demander</button>");
           markerTaxis[taxi].addTo(mymap);
          
         }
         else 
          {
            markerTaxis[taxi] = L.marker([taxis[taxi].latitude,taxis[taxi].longitude],{icon: iconeTaxi}).bindPopup("<button  id='envoyer' value='"+taxis[taxi].id+"' onclick='ajoutDemande(this)' >demander</button>");
             markerTaxis[taxi].addTo(mymap);
                                          // récuperer  les cordonnees des taxis et les afficher 
          }
        } 
        
     }
    
   }
  }
},10000);