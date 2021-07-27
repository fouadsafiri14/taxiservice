<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, PATCH, DELETE');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');


                 $donneesJson = file_get_contents('php://input');






               $donnees = json_decode($donneesJson,true);


               extract($donnees);


               if(isset($donnees['message']) && !empty($donnees['message'])){








                   //connexion à la base de donnée


                    require('../../config/PDOAccess.php');


                         


                    $sql = "INSERT INTO reponse(departlati,departlong,arriveelati,arriveelong,client_id,chauffeur_id,timing,message,distance) VALUES(:departlati,:departlong,:arriveelati,:arriveelong,:client_id,:chauffeur_id,:timing,:message,:distance)";





                    $tabExec = [


                         ":departlati" =>$latitude,


                         ":departlong" =>$longitude,


                         ":arriveelati" =>$arriveelati,


                         ":arriveelong" =>$arriveelong,


                         ":client_id"  =>$id,


                         ":chauffeur_id" => $chauffeur_id,


                         ":timing" => date("Y-m-d H:i:s"),


                         ":message"=>$message,


                         ':distance'=>$distance,


                       ];


                    


                    $query = $PDO->prepare($sql);


                    $query->execute($tabExec);


                    


                    http_response_code(201);


               echo json_encode(['message' => 'ça marche']);








               }


?>