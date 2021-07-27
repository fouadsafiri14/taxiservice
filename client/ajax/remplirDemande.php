<?php
session_start();
if(isset($_SESSION['user']['id'])&&$_SESSION['user']['genre']=='client')
{
require('../../config/PDOAccess.php');
$id = $_SESSION['user']['id'];
$PDO->query("UPDATE demande set ready=2 where client_id=$id");
}
else
 {
     echo 'faux';
 }