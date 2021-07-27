<?php
   session_start();

   if(isset($_SESSION['user']['pseudo_name'])&&$_SESSION['user']['genre']=='chauffeur'){
   require('../config/PDOAccess.php');
   $id = $_SESSION['user']['id'];
 $PDO->query("UPDATE chauffeur set valeur=1 where id=$id");
 ?>


<?php require 'header.php'; ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf8">

    <title> TAXI SERVICE - CHAUFFEUR </title>



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"

    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="

    crossorigin=""/>



    <!-- geocoder-->

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

   

    <!-- routing machine-->

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

     
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>  <!--leaflet css -->

<link rel="stylesheet" href="../css/pageChauffeur.css">
</head>





<body>
<audio id="audio" src="../images/juntos-607.mp3"> </audio>


<div id ="mapidinfo">
  <div id="mapid"> </div>

    <div id="tout">  
    
      <div id="info"> </div>
      <div class='touche'> <!-- <button id='supprimer' onclick='supprimer()'>supprimer les details</button> <button onclick='affichage()' id='afficher'>afficher les details</button> --> </div>
       <div class="touche"> 

         <button id="accepter" value="j'accepte!">accepter</button>

         <button id="refuser" value="je refuse">refuser</button> 

       </div>

      </div>
</div>

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"

    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="

    crossorigin=""></script>    <!--leaflet js -->



  



  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> <!-- geocoder script-->

  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>         <!-- routing machine-->

  <script src="js/map.js">   </script>  <!-- pour manipuler la map -->


  <script src="js/chauffeur.js"> </script>     <!-- custom js --> 
  
  <script> 
   window.onbeforeunload = function()
     {
         xmlhttp = new XMLHttpRequest();
         console.log(xmlhttp);
         xmlhttp.onreadystatechange = function()
           {
               if(xmlhttp.readyState==4)
                {
                    console.log(xmlhttp);
                }
           }
     
        xmlhttp.open("GET","ajax/dec.php",true);
        xmlhttp.send();
     }
</script>
        </body>       
 </html>
<?php 

$PDO->query("UPDATE chauffeur set valeur=1 where id=$id");  }

 else

  {

       header("Location: ../connexion.php");

  }

  ?>