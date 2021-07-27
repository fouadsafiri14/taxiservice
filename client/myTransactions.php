<?php 
session_start(); $gain=0;
if(isset($_SESSION['user'])&&$_SESSION['user']['genre']='chauffeur')
{

  require '../config/PDOAccess.php';
  $id1 = $_SESSION['user']['id'];
 
  $result = $PDO->query("SELECT * FROM transaction WHERE client_id=$id1");


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mes informations</title>
    <link rel="stylesheet" href="../css/tableau.css" type="text/css" />
     
</head>
<?php   require 'header.php'; ?>

<body>
<table>
<h1>Mes transactions</h1> <hr>
<th>id</th> <th>client_id</th> <th>timing</th>  <th>prix</th> <th>distanceParcourue </th>
<?php  while($data=$result->fetch(2)): extract($data); $gain+=$soldeDebite?>

<tr> <td><?= $id?></td> <td><?= $chauffeur_id?></td> <td><?= $timing?> </td> <td><?=$soldeDebite ?> </td> <td> <?= $distanceParcourue?> </td>  </tr>

 


          

   <?php endwhile ?> 
   </table>
   <p style="color:black;  font-size:30; font-weight:bold;"> TES DEPENSES (TTC): <?= $gain ?></p>
</body>
</html>
<style>
       th,td 
        {
          border:1px solid black;
        }
        table 
         {
           border-collapse:collapse;
         }

    </style>
  <?php
    }
    else 
     {
       header("location: ../connexion.php");
     }