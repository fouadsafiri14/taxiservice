<?php 
session_start();
if(isset($_SESSION['user']))
{
$bol=0;
 
  require '../config/PDOAccess.php';
  $id1 = $_SESSION['user']['id'];
  $genre = $_SESSION['user']['genre'];
  $result = $PDO->query("SELECT * FROM $genre WHERE id=$id1");
  extract($result->fetch(2));
  if(isset($_POST['valid']))
  {
    
      extract($_POST);
      $hash = password_hash($password,PASSWORD_BCRYPT);
      $PDO->query("UPDATE $genre set prenom='$prenom',nom='$name',tel_number='$tel_number',pseudo_name='$pseudo_name',naissance='$naissance', password='$hash' where id=$id");
     // header('location: myInfos.php');
      $bol=1;
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mes informations</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    
</head>
 <?php   require 'header.php'; ?>

<body>
<form method="POST">
<header>Mes informations</header> <hr>
<table>
<tr> <th>id</th> <td><input type='text' name='id' value='<?= $id?>' readonly> </td> </tr>
<tr> <th>prenom</th>  <td><input type='text' name='prenom' value='<?= $prenom?>'> </td>  </tr>
<tr> <th>nom</th> <td><input type='text' name='name' value='<?= $nom?>'></td>  </tr> 
<tr><th>GSM</th>   <td><input type='tel' name='tel_number' value='<?= $tel_number?>'></td></tr>
<tr><th>pseudo_name(Email) </th>  <td><input type='email' name='pseudo_name' value='<?= $pseudo_name?>'></td> </tr>
<tr> <th>naissance </th><td><input type='date' name='naissance' value='<?= $naissance?>'> </td></tr>
<tr><th> password </th>   <td><input type='text' name='password' value='<?= $password?>'> </td> </tr>
<tr> <th>latitude </th>  <td><?php if(isset($latitude)) echo $latitude; else echo 'NULL'; ?> </td> </tr>
<tr> <th>longitude </th> <td> <?php if(isset($longitude)) echo $longitude; else echo 'NULL'; ?> </td> </tr>
</table>


  <input type="submit" class="subscribe_bt" name="valid">
  <p> <?php  if($bol==1){ echo "bien modifié";} ?> </p>
</form>

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