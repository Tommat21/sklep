<!doctype html>
<html lang="pl">
    <?php
    session_start();
    require "polaczenie.php";
    error_reporting(-1);
$zalogowany = $_SESSION['valid'];
if($_SESSION['admin']!=true)
{
    header("Location: http://masnyted.ct8.pl/index.php");
}
    ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="sidebar.css">
  <title>Sklepik.exe</title>
   
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
    div#jeden {background-color:rgb(36,37,38); padding: 40px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 25px;}
  h3 {line-height: normal}
  h3#blad{font-style: italic; color: red}
  label {width: 200px; margin: 5px 0; clear: left;}
  button#zatwierdz { margin-left: 205px;}
  </style>
  
  
  
  </head>
  <body>
  
    <div class="d-flex float-left" style="margin-top: 20%;">
  
    <div class="bg-light" id="sidebar">
      <div class="sidebar-gora">Admin Panel </div>
        <a href="dodpt.php" class="list-group-item list-group-item-action bg-light">Dodaj Produkt</a>
        <a href="edypt.php" class="list-group-item list-group-item-action bg-light">Edytuj Produkt</a>
        <a href="usupt.php" class="list-group-item list-group-item-action bg-light">Usuń Produkt</a>
        <a href="dodpa.php" class="list-group-item list-group-item-action bg-light">Dodaj Pracownika</a>
        <a href="edypa.php" class="list-group-item list-group-item-action bg-light">Edytuj Pracownika</a>
        <a href="usupa.php" class="list-group-item list-group-item-action bg-light">Usuń Pracownika</a>
    </div>
  
 </div> 
     
 <!--Navbar-->
 <nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-primary ">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
     <?php
  if($_SESSION['admin']==true)
  {
  ?>
  <nav class="navbar bg-primary mr-auto">
  <button class="btn btn-primary" id="menu-rozwijane">Admin Panel</button>
  </nav>
      <?php
  }
     ?> 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
   
  <nav class="navbar navbar-light bg-primary mr-auto">
  </nav>
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'index.php';" type="button" class="btn btn-primary">Home</button>
  </form>
  </nav>
    
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'koszyk.php';" type="button" class="btn btn-primary">Koszyk</button>
  </form>
  </nav>
  
  
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'kontakt.php';" type="button" class="btn btn-primary">Kontakt</button>
  </form>
  </nav>
   
  
<?php if($zalogowany): ?>
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'wyloguj.php';" type="button" class="btn btn-primary">Wyloguj się</button>
  </form>
  </nav>
  <?php else: ?>
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'login.php';" type="button" class="btn btn-primary">Zaloguj się</button>
  </form>
  </nav>
  </div>

 

  <?php endif; ?>
  </nav>
   <?php
   if(isset($_POST['submit']))
   {
       $login=$_POST['login'];
       $haslo=$_POST['haslo'];
       $imie=$_POST['imie'];
       $nazwisko=$_POST['nazwisko'];
       $telefon=$_POST['telefon'];
       $email=$_POST['email'];
       $adres=$_POST['adres'];
       $miasto=$_POST['miasto'];
       $poczta=$_POST['poczta'];
       $data=$_POST['data'];
       $hashPassword = password_hash($haslo,PASSWORD_BCRYPT);
       $kod_aktywacyjny = md5(uniqid(rand()));
       $adressprawdz=$pdo->query("Select * from adres where adres='".$adres."' and miasto='".$miasto."' and poczta='".$poczta."';");
       if($adressprawdz->rowCount()<1)
       {
       $adresdodaj=$pdo->query("Insert into adres (adres,miasto,poczta) values('".$adres."','".$miasto."','".$poczta."');");
       }
       $idadr=$pdo->query("Select * from adres where adres='".$adres."' and miasto='".$miasto."' and poczta='".$poczta."';");
       $idadre=$idadr->fetch(PDO::FETCH_ASSOC);
       $idadres=$idadre['id_adres'];
       $pracowniksprawdz=$pdo->query("Select * from pracownicy where imie='".$imie."' and nazwisko='".$nazwisko."' and telefon='".$telefon."';");
       if($pracowniksprawdz->rowCount()<1)
       {
       $pracownik=$pdo->prepare("Insert into pracownicy (id_adres,login,haslo,imie,nazwisko,telefon,email,data_zatrudnienia) values (:id_adres,:login,:haslo,:imie,:nazwisko,:telefon,:email,:data_zatrudnienia);");
       $pracownik->bindValue(':id_adres', $idadres, PDO::PARAM_INT);
       $pracownik->bindValue(':login', $login, PDO::PARAM_STR);
       $pracownik->bindValue(':haslo', $hashPassword, PDO::PARAM_STR);
       $pracownik->bindValue(':imie', $imie, PDO::PARAM_STR);
       $pracownik->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
       $pracownik->bindValue(':telefon', $telefon, PDO::PARAM_STR);
       $pracownik->bindValue(':email', $email, PDO::PARAM_STR);
       $pracownik->bindValue(':data_zatrudnienia', $data, PDO::PARAM_STR);
       $pracownik->execute();
       if (!$pracownik) {
    echo "\nPDO::errorInfo():\n";
    print_r($pdo->errorInfo());
}
       $uzytkownik=$pdo->prepare("Insert into uzytkownik (login,haslo,email,kod_aktywacyjny,aktywny) values (:login,:haslo,:email,:kod_aktywacyjny,:aktywny);");
       $uzytkownik->bindValue(':login', $login, PDO::PARAM_STR);
       $uzytkownik->bindValue(':haslo', $hashPassword, PDO::PARAM_STR);
       $uzytkownik->bindValue(':email', $email, PDO::PARAM_STR);
       $uzytkownik->bindValue(':kod_aktywacyjny', $kod_aktywacyjny, PDO::PARAM_STR);
       $uzytkownik->bindValue(':aktywny', 1, PDO::PARAM_INT);
       $uzytkownik->execute();
       }
   }
   ?>
<div class="container">
  <div id="jeden" class="row">  
    <div class="col-sm">
    
    
    <h1><center>Dodaj pracownika: </center></h1><br>
    <h4>
    <form method="post">
  <label for="login">Login pracownika:</label>
    <input type="text" name="login"><br>
    <label for="haslo">Hasło:</label>
    <input type="password" name="haslo"><br>
    <label for="imie">Imie:</label>
    <input type="text" name="imie"><br>
  <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko"><br>
  <label for="telefon">Telefon:</label>
    <input type="text" name="telefon"><br>
  <label for="email">Email:</label>
    <input type="email" name="email"><br>
    <label for="adres">Adres:</label>
    <input type="text" name="adres"><br>
    <label for="miasto">Miasto:</label>
    <input type="text" name="miasto"><br>
    <label for="poczta">Poczta:</label>
    <input type="text" name="poczta"><br>
  <label for="data">Zatrudniony:</label>
    <input style="width: 263px;" type="date" name="data"><br>
    <button id="zatwierdz" type="submit" name="submit" class="btn btn-primary mb-2">Dodaj</button>
    </form>
    
    </h4>

    </div>
  </div>
</div>

  <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-primary">
      <a class="navbar-brand"> © Copyright by Team Człapski & Wróbel</a>
  </nav>      

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- skrypt do panelu bocznego -->
  <script>
    $("#menu-rozwijane").click(function(e) {
      $("#sidebar").toggleClass("toggled");
    });
  </script>
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
