<?php 
 $bol=0;
         if(isset($_POST['valid_inscription']))
         {
             
               $type=$_POST['genre'];
               
               require('config/PDOAccess.php');


               $request="INSERT INTO  ".$type."(`prenom`,`nom`,`tel_number`,`pseudo_name`,`password`,`naissance`)   VALUES (:prenom ,:nom ,:tel_number ,:pseudo_name ,:password ,:naissance)"; 

               $sql = $PDO->prepare($request);
               $tabExec = array(
                ':prenom' =>$_POST['form_prenom'],
                ':nom' => $_POST['form_nom'],
                ':tel_number' => $_POST['form_tel'],
                ':pseudo_name' => $_POST['form_email'],
                ':password' => password_hash($_POST['form_password'],PASSWORD_BCRYPT),
                ':naissance' => $_POST['form_dateofobirth']
               );
        try
         {
            if($sql->execute($tabExec))
            {
                $bol = 1;
            } 
           else 
            {
               
            }
         }
         catch(Exception $e)
           {
            $bol = 2;
           }
               

          }

             ?>

<?php require 'header.php'; ?>
<!DOCTYPE html>



<html lang='fr'>



    <head>
            <meta charset='utf-8'>
            <title> INSCRIPTION</title>
            <link rel="stylesheet" href="css/main.css" type="text/css" />
            <style>

.subscribe_bt {
    color: #ffffff;
    background-color: #bfd119;
    width: 41%;
    height: 42px;
    font-size: 17px;
}
</style>
    </head> 


     <body>



     







         <form method="POST">


         <header> INSCRIPTION</header>  
         <hr style="color:black;">

         <label for="genre0"> <input type="radio" name="genre" value="client" id="genre0" checked>Client</label> <br>
         <label for="genre1"><input type="radio" name="genre" value="chauffeur" id="genre1">Chauffeur</label>   <br>
        

         <img src="images/identification.svg" class="formicon">  <input type="text" name="form_prenom" placeholder="prenom" required></label>  <br>
         <img src="images/identification.svg" class="formicon">   <input type="text" name="form_nom" placeholder="nom" required><br>



         <img src="images/kisspng-telephone-icon-phone-png-file-5a753b46265fe1.5997722815176323261572.png" class="formicon"> <input type="text" name="form_tel" placeholder="telephone" required>     <br>



          <img src="images/5a359002ce50d5.3263382315134597148451.png" class="formicon">   <input type="email" name="form_email" placeholder="email" required>  <br>



           <img src="images/lock-24px.svg" class="formicon">  <input type="password" name="form_password" placeholder="mot de passe" required>  <br>

           <img src="images/calendar.svg" class="formicon">  <input type="date" name="form_dateofobirth" placeholder="dateofbirth" required > <br>



                       <input type="submit" name="valid_inscription" value="s'inscrire" required class="subscribe_bt">  <br> 
                       <p> Avez vous un compte? <a href="connexion.php" style="color:black;">CONNEXION</a></p>
                       <p><?php if($bol==2){echo 'inscription invalide';}if($bol==1){echo 'inscription valide';} ?> </p>
                       <p style="color:#4e4e32">NB: on vous offre 1000dhs dès l'inscription</p>
                               </form>

        </body>

</html> 







