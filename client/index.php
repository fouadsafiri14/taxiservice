<?php

   session_start(); //verfication
   if(isset($_SESSION['user']['pseudo_name'])&&$_SESSION['user']['genre']=='client'){
    if($_SESSION['user']['solde']>100)
    {
 ?>
 <?php require 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title> TAXI SERVICE -Client </title>
        <!-- CSS only -->
  <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
   -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>  <!--leaflet css -->

    <!-- geocoder-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
   
    <!-- routing machine-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

     <link rel="stylesheet" href="../css/pageClient.css">
</head>

<body> 
     
<audio id="audio" src="../images/juntos-607.mp3"> </audio>
    

 <div id ="mapidinfo">
  <div id="mapid">
     </div>
  <div id="info"> 
  <div id='touche'> <!-- <button id='supprimer' onclick='supprimer()'>supprimer </button> <button onclick='affichage()' id='afficher'>affichage</button> --></div>
  </div>
  <div>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>    <!--leaflet js -->

  

  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> <!-- geocoder script-->
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>         <!-- routing machine-->
     
 <script src="js/map.js">   // javascript pour manipuler la map </script>
<script src="js/client.js"></script>
 </body>
</html> 
<?php
    }
    else
    {
      echo "<script> alert('pas de solde suffisant, il ne reste dans ton wallet que ".$_SESSION['user']['solde']."' );   window.location.replace('../index.html'); </script>"; 
     
    }
          
  }
     else
     {
           header("Location: ../connexion.php");
     }

?>