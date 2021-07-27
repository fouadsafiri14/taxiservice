
 

 var mymap = L.map('mapid').setView([31.688515601838468, -4.9585248359206355], 14);

        

 L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {

            // Il est toujours bien de laisser le lien vers la source des données

            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',

            minZoom: 1,

            maxZoom: 20

        }).addTo(mymap);


function supprimer(){document.getElementsByClassName('leaflet-top leaflet-right')[0].style.display="none";}
function affichage(){document.getElementsByClassName('leaflet-top leaflet-right')[0].style.display="table";}

var iconeChauffeur = L.icon({

            iconUrl: "../images/chauffeur.png",

            iconSize: [50, 50],                     //icone pour le chauffeur

            iconAnchor: [25, 50],

            popupAnchor: [0, -50]

        });



var iconeClient = L.icon({

            iconUrl: "../../images/client.png",

            iconSize: [50, 50],

            iconAnchor: [25, 50],                //icone pour le client

            popupAnchor: [0, -50]

        });



var marker; 

var route;

var e1;

var e2;
var circle;



let doPosition = function() {

if (navigator.geolocation) {

navigator.geolocation.getCurrentPosition(function (position) {

    if (window.XMLHttpRequest)

    {// code for IE7+, Firefox, Chrome, Opera, Safari

      xmlhttp2 = new XMLHttpRequest();          

    }

    else                         //AJAX POUR INSERER LA POSITION DU CHAUFFEUR LA BASE DE DONNEE LES COORDONNEES

    {// code for IE6, IE5

      xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");

    }



 e1 = position.coords;       //pour trouver l'itinéraire  



 mymap.panTo(new L.LatLng(e1.latitude,e1.longitude));      


    if(marker)

    { 
      mymap.removeLayer(marker);
      mymap.removeLayer(circle);
      
      marker = L.marker([e1.latitude,e1.longitude],{icon: iconeChauffeur}).bindPopup("<p>CHAUFFEUR </p>");

      marker.addTo(mymap); 
       
       circle = L.circle([position.coords.latitude,position.coords.longitude], {

                   color: 'blue',

                   fillColor: '#008bff',

                   fillOpacity: 0.1,                 //circle de precision

                  radius: 300

                   }).addTo(mymap);
    }

     else

    {

    

      marker = L.marker([position.coords.latitude,position.coords.longitude],{icon: iconeChauffeur}).bindPopup("<p>CHAUFFEUR </p>");

     marker.addTo(mymap);
     
        circle = L.circle([position.coords.latitude,position.coords.longitude], {

                              color: 'blue',

                              fillColor: '#008bff',

                              fillOpacity: 0.1,                 //circle de precision

                              radius: 300

                              }).addTo(mymap);
        

    }

    

     

    xmlhttp2.open("GET","ajax/ajouterPositionChauffeur.php?latitude="+position.coords.latitude+"&longitude="+position.coords.longitude+"",true);

        xmlhttp2.send();                       //ajouter à la base de donnees

        




});

}

}



doPosition();

if ("geolocation" in navigator) 

{

setInterval(doPosition,5000);

} 

else

{ 

alert("Le service de géolocalisation n'est pas disponible sur votre ordinateur."); 

}
