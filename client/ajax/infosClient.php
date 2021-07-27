<?php 


session_start();





require('../../config/PDOAccess.php');











            $query =  $PDO->prepare("SELECT * FROM client where id= :id");





      





            $query->bindParam(':id',$_SESSION['user']['id']); 





            $query->execute();


         


    http_response_code(200);











    $messagesJson = json_encode($query->fetch(2));











    echo $messagesJson;





        





       