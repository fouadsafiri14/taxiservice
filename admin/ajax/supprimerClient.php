<?php 
if(isset($_GET['id']))
{
    if($_SESSION['user']['genre']='admin')
    {
require '../../config/PDOAccess.php';
extract($_GET);
$PDO->query("DELETE FROM client where id=$id ");
}
else
{
    header('location: ../../connexion.php');
}
 }
 else
  {
      echo "définir l'id";
  }

