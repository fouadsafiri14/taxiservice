<?php
session_start();
if(isset($_SESSION['user']['id'])&&$_SESSION['user']['genre']=='chauffeur')
{
require('../../config/PDOAccess.php');
$id = $_SESSION['user']['id'];
$PDO->query("UPDATE chauffeur set valeur=2 where id=$id ");
}