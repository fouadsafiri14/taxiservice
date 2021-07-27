<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>AffichageChauffeur</title>
      <link href="../css/tableau.css" rel="stylesheet">
 </head>
 <body>
 <script> 

  
function supprimer(e)
{



 

       value =  e.value;
        xmlhttp = new XMLHttpRequest()

        xmlhttp.onreadystatechange=function()
        {

           if (this.readyState==4)
               {
           console.log("done");
           window.location.replace("affichageChauffeur.php");

                 }
         }

                 
        xmlhttp.open("GET", "ajax/supprimerChauffeur.php?id="+value,true);
        xmlhttp.send();

       


        }         
 </script>

 <?php 
 
 require '../config/PDOAccess.php';
 require 'header.php';
 $result = $PDO->query("SELECT id,prenom,nom,pseudo_name from chauffeur");
 ?>
 <h1>ChAUFFEURS</h1>
 <table>
 <tr> <th>id</th> <th>prenom</th> <th>nom</th> <th>pseudo_name</th> <th> supprimer</th></tr>
  <?php while($data = $result->fetch(2)):?>
     <tr>
      <?php   foreach($data as $data2): ?>
       <td><?= $data2 ?>  </td>
 <?php  endforeach; ?>
 <td><button id="<?=$data['id']?>" value="<?=$data['id']?>" onclick="supprimer(this)">Supprimer</button></td> 
 <?php endwhile;?>
 </table>
 </body>
 
 </html>
    <style>
  td,th
   {
       border:1px black solid;
   }
  table 


   {
       border-collapse:collapse;
   }


    </style>