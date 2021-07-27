<?php 

        session_start();

           $bol=0;
         if(isset($_POST['valid_connection']))

             {

        


               if(isset($_POST['form_username'])&&!empty($_POST['form_username'])

                  &&isset($_POST['form_password'])&&!empty($_POST['form_password'])

                  &&isset($_POST['genre'])&&!empty($_POST['genre']))

                 {  

                  $username=$_POST['form_username'];

                  $password=$_POST['form_password'];

                  $type=$_POST['genre'];

                  require('config/PDOAccess.php');

                    $request="SELECT * FROM $type WHERE  pseudo_name =:name";

                    $sql = $PDO->prepare($request);
                    
                    $sql->bindParam(':name',$username,PDO::PARAM_STR);
                    $sql->execute();

                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                     if(isset($result[0]['pseudo_name'])&&!empty($result[0]['pseudo_name']))
                      {   

                        $id = $result[0]['id'];


                            if(($result[0]['pseudo_name']==$username) &&(password_verify($password,$result[0]['password'])))
                               
                              {
                                         
                                        
                                    $_SESSION['user'] = [

                                          'pseudo_name' => $username,

                                           'genre'      => $type,

                                           'id' => $id ,

                             
                                    ];

                                

                      

                                  if($type=="client")
                                  {
                                   $_SESSION['user']['solde']=$result[0]['solde'];
                                  
                                    header("Location: client");
                                  }

                                  if($type=="chauffeur")

                                  {

                                    $PDO->query("UPDATE chauffeur SET valeur=1 where id=$id")  ;

                                    header("Location: chauffeur");

                                  }

                                  if($type=='admin')

                                   {

                                     header("Location: admin");

                                   }

                                

                                               

                              }
                              else

                             {

                               $bol = 1; // 1 cad les donnees sont fausses 

                              }
                           
                       }

                      
                       else

                       {

                          $bol = 1; // 1 cad les donnees sont fausses 

                       }

                  

                                   

                 

                 } 

                 else

                 {

                   $bol = 2 ;//les donnees vides ou null 

                 }          

       
                  
                }

        

             ?>



    
<?php require 'header.php'; ?>
<!DOCTYPE html>

    <html lang='fr'>

        <head>

            <meta charset='utf-8'>

            <title> Se connecter</title>

            <link rel="stylesheet" href="css/main.css" type="text/css" />

        </head> 

     <body>

    

         





    

        <form method="POST">
  
        
        <header>Se connecter</header>
      <hr style="color:black;">
        <label for="genre0" > <input type="radio" name="genre" value="client" id="genre0" checked>Client</label><br>

       <label for="genre1"> <input type="radio" name="genre" value="chauffeur" id="genre1" >Chauffeur </label>    <br>

       <label for="genre2"> <input type="radio" name="genre" value="admin" id="genre2">Admin </label>  <br>
  
       

        <img src="images/5a359002ce50d5.3263382315134597148451.png" class="formicon"> <input type="text" name="form_username" placeholder="identifiant" required> <br>

      

    

        <img src="images/lock-24px.svg" class="formicon"> <input type="password" name="form_password" placeholder="mot de passe" required>  <br>

  
      <input type="Submit" class="subscribe_bt" name='valid_connection' value="Connexion"><br>
      <p> Pas de compte? <a href="inscription.php" style="color:black;">INSCRIPTION</a></p>
      <p> <?php if($bol==1){ echo "les donnees entrées sont fausses";} if($bol==2){ echo "les donnees entrées sont vides ou null";} ?> </p>
     
      </form>

    

    </body>



    </html> 











