<?php
require('../PDOAccess.php');

$sql = 'SELECT  * FROM `chauffeur` where valeur=1 ';
$uti = $PDO->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$coord = json_encode($uti);
echo $coord;

?>