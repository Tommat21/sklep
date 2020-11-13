<?php
$host='mysql.ct8.pl';
$user='m18236_MasnyTed';
$pass='MasnoFest2137';
$db='m18236_Baza';
try{
$pdo=new PDO('mysql:host='.$host.';dbname='.$db,$user,$pass);
$znaki=$pdo->prepare("SET CHARSET utf8");
$znaki2=$pdo->prepare("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
$znaki->execute();
$znaki2->execute();
}catch(PDOException $e){
echo "Błąd połączenia";
die();
}
?>