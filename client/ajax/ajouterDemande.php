<?php





  header("Content-Type: application/json; charset=UTF-8");








              $donneesJson = file_get_contents('php://input');


             


            $donnees = json_decode($donneesJson,true);


              //print_r($donnees);


            extract($donnees);


       


            require('../../config/PDOAccess.php');


            


      if(isset($donnees['message']) && !empty($donnees['message']))


               {


                   //connexion à la base de donnée


                   


                      


              $sql = "INSERT INTO demande(departlati,departlong,arriveelati,arriveelong,client_id,chauffeur_id,timing,message,distance) VALUES(:departlati,:departlong,:arriveelati,:arriveelong,:client_id,:chauffeur_id,:timing,:message,:distance)";


              $query = $PDO->prepare($sql);


        


              $tabExec = [


                ":departlati" =>$latitude,


                ":departlong" =>$longitude,


                ":arriveelati" =>$arriveelati,


                ":arriveelong" =>$arriveelong,


                ":client_id"  =>$id,


                ":chauffeur_id" => $chauffeur_id,


                ":timing" => date("Y-m-d H:i:s"),


                ":message"=>$message,


                ":distance"=>$distance,


              ];


              


              





               $query->execute($tabExec);


         


                http_response_code(201);


               echo json_encode(['message' => 'ça marche']);


           


             }


  


?>