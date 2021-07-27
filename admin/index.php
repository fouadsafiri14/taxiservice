<?php
 session_start();


   if(isset($_SESSION['user']['pseudo_name'])&&$_SESSION['user']['genre']=='admin'){ ?>



<?php 
 require('../config/PDOAccess.php');
 $result = $PDO->query("SELECT * FROM transaction");

  require 'header.php';
 ?>


<h1>TRANSACTIONS </h1>
<table> 

 
 <th> id</th>    <th> departlati </th>   <th> departlong</th>  <th> arriveelati </th>  <th> arriveelong</th>  <th> chauffeur_id</th>  <th> client_id </th>  <th> timing</th> <th>prix </th> <th> distanceParcourue</th>


<?php while($data=$result->fetch(2))


 {?>


       <tr>


       <?php foreach($data as $dt){?>


        


       <td>  <?=  $dt ?> </td>


      


    <?php


      }


      ?>


        </tr>


<?php  }?>


 </table>


 

<link href="../css/tableau.css" rel="stylesheet">

<?php
 }
 else
   {
     header("location: ../connexion.php");
   }