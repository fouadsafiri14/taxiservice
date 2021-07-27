<?php 

session_start();

require('config/PDOAccess.php');


if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
{

$id = $_SESSION['user']['id'];
if($_SESSION['user']['genre']='chauffeur')
   $PDO->query("UPDATE chauffeur SET valeur=0 where id=$id");
unset($_SESSION['user']);
header("Location: connexion.php");
}
header("Location: connexion.php");