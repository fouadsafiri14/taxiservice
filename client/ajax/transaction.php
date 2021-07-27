<?php 
//header('Access-Control-Allow-Origin: *');


 session_start();
 
require('../../config/PDOAccess.php');

 

   $donneesJson = file_get_contents('php://input');

 

   $donnees = json_decode($donneesJson,true);

   extract($donnees);

 

   if(isset($donnees)&&!empty($donnees))

     {

          $soldeActuel = $_SESSION['user']['solde']-$distanceParcourue/1000;
          
         
          if($soldeActuel>=0)
           { 
            $_SESSION['user']['solde'] = $soldeActuel;
         $query = $PDO->prepare("START TRANSACTION; UPDATE client set solde=$soldeActuel where id=$client_id; INSERT INTO transaction(departlati,departlong,arriveelati,arriveelong,chauffeur_id,client_id,timing,soldedebite,distanceParcourue) VALUES(:latitude,:longitude,:arriveelati,:arriveelong,:chauffeur_id,:client_id,:timing,:soldeDebite,:distanceParcourue); COMMIT;");

         

         $tabExec = [

            ':latitude' =>$latitude,

            ':longitude'   =>$longitude,

            ':arriveelati'    =>$arriveelati,

            ':arriveelong'     =>$arriveelong,

            ':chauffeur_id'     =>$chauffeur_id,

            ':client_id'      =>$client_id,

             ':timing'=>date("Y-m-d H:i:s"),

             ':soldeDebite' =>$distanceParcourue/1000,

             ':distanceParcourue'=>$distanceParcourue

         ];


         $query->execute($tabExec);         
         http_response_code(201);
        echo json_encode(['message' => 'ca marche']);

    }
       else
        {
         
          http_response_code(404);
          echo json_encode(['message' => 'ça marche pas']);
        }

 

        

     } 

?>

    