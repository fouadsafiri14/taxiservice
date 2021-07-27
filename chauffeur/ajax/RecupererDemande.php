<?php


session_start();


header("Content-Type: application/json; charset=UTF-8");

        require('../../config/PDOAccess.php');


        $id = $_SESSION['user']['id'];





     $request = "select * from demande where chauffeur_id=$id  and ready =0 and id IN (select max(id) from demande where chauffeur_id=$id)";


    $query = $PDO->prepare($request);


    $query->execute();


                


     


    $messages = $query->fetchAll(PDO::FETCH_ASSOC);





    if(empty($messages[0]))


          {  


            http_response_code(200);


            echo '';

           
          }


    else


    {


        $id = $messages[0]['id'];


        $PDO->query("UPDATE demande SET ready=1 where id= $id");


        http_response_code(200);


        $messagesJson = json_encode($messages);


        echo $messagesJson;


    }


    





    


