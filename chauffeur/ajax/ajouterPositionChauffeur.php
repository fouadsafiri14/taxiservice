<?php
session_start();
if(isset($_SESSION['user']['id'])&&$_SESSION['user']['genre']=='chauffeur')
{
extract($_GET);


require('../../config/PDOAccess.php');



 $id = $_SESSION['user']['id'];

 $sql = "UPDATE `chauffeur` SET `latitude`=".$latitude." ,`longitude`=".$longitude." WHERE id= $id";






 $PDO->query($sql);

 http_response_code(201);


 echo json_encode(['message' => 'ça marche']);

     
}



