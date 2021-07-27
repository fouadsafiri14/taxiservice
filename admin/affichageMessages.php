 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>AffichageMessages</title>
     <link href="../css/tableau.css" rel="stylesheet">
     
 </head>
 <?php require "header.php"; ?>
  <h1> MESSAGES </h1>
  <table>
      <tr>  <th>ID</th> <th>nom</th> <th>prenom</th> <th>Email</th><th>message</th> <tr>
<?php 
 require '../config/PDOAccess.php';
 $result = $PDO->query("SELECT * FROM message");
  while($data = $result->fetch(2)):?>
     <tr>
      <?php   foreach($data as $data2): ?>
       <td><?= $data2 ?>  </td>
 <?php  endforeach; endwhile;?>
 </table>
 </body>
  
  