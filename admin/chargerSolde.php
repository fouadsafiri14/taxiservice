<?php
$bol=0;
session_start();
if(isset($_SESSION['user']['pseudo_name'])&&$_SESSION['user']['genre']=='admin'){ 

if(isset($_POST['id']))
 {
  
    try
    {
     require('../config/PDOAccess.php');
     extract($_POST);
    $sql = "SELECT solde from client where id=$id";
    $result = $PDO->prepare($sql);
    $result->execute();
    if($result->rowcount())
    {
    $soldeActuel = $result->fetch(2)['solde'];
    $sql = $PDO->prepare("START TRANSACTION; UPDATE client SET solde=$soldeActuel+$solde where id=:id; COMMIT;");
    if($sql->execute([':id'=>$id]))
     {
         $bol=1;
        
      }
      else
       {
           
        
       }
     
    }
    else
     {
        $bol=2;
     }
}
    catch(Exception $e)
     {
        $bol=2;
     }
}
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charger le solde</title>
    
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
</head>
<body>
    <?php require 'header.php'; ?>
     <form method="POST">
         <header> CHARGER LE COMPTE D'UN CLIENT </header> <hr>
       <input type="number" name="id" placeholder="l'id du client" min="1" required>
       <input type="number" name="solde" placeholder="le solde à donnée" min="0" max="10000" step="0.1" required>  
       <input type="submit" name="valid" value="envoyer"  class="subscribe_bt"> 
       <?php if($bol==1){ echo"<p>vous avez charger le compte d'id $id avec un solde de $solde</p>";} if($bol==2){echo "<p>l'operation a echoué</p>";} ?>
     </form>     
</body>
</html>
<?php  }
else
 {
  header("location: connexion.php");
 }