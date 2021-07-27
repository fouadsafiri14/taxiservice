<?php


session_start();

if(isset($_SESSION['user']['id'])&&$_SESSION['user']['genre']='client')
{ 
extract($_GET);


require('../../config/PDOAccess.php');



$id = $_SESSION['user']['id'];

$sql = "UPDATE `client` SET `latitude`=".$latitude." ,`longitude`=".$longitude." WHERE id= $id";


$query = $PDO->query($sql);

http_response_code(201);


echo json_encode(['message' => 'ça marche']);

}
