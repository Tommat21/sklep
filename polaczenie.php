<?php
$host='mysql.ct8.pl';
$user='m18236_MasnyTed';
$pass='MasnoFest2137';
$db='m18236_Baza';
try{
$pdo=new PDO('mysql:host='.$host.';dbname='.$db,$user,$pass);
}catch(PDOException $e){
echo "Błąd połączenia";
die();
}
?>