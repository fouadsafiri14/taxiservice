<?php


session_start();


header("Content-Type: application/json; charset=UTF-8");





     require('../../config/PDOAccess.php');


     $id = $_SESSION['user']['id'];


     $request = "SELECT  * FROM reponse WHERE client_id=$id  AND ready =0 AND id IN (select max(id) from reponse where client_id=$id)";


                    


    $query = $PDO->prepare($request);


    $query->execute(); 


    $messages = $query->fetchAll(PDO::FETCH_ASSOC);





    if(empty($messages))


    {  


      http_response_code(200);


      echo '';


    }


    else


     {


          $id = $messages[0]['id'];


          $PDO->query("UPDATE reponse SET ready=1 where id= $id");


          http_response_code(200);


          $messagesJson = json_encode($messages);


          echo $messagesJson;


     }


   


   