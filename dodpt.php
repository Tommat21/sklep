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
  #opis{margin-bottom: -2%; width: 263px;}
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
     
 <nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-primary">
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
 </div>
 
  <div class="float-right">
  
  <nav class="navbar bg-primary">
  <button class="btn btn-primary" id="menu-rozwijane">Admin Panel</button>
  </nav>
  
  </div>
  
  <div class="float-right">
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'index.php';" type="button" class="btn btn-primary">Home</button>
  </form>
  </nav>
  
  </div>
  
  <div class="float-right">
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'koszyk.php';" type="button" class="btn btn-primary">Koszyk</button>
  </form>
  </nav>
  
  </div>
   
  <div class="float-right">
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'kontakt.php';" type="button" class="btn btn-primary">Kontakt</button>
  </form>
  </nav>
   
  </div>

<?php if($zalogowany): ?>
  <div class="float-right">
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'wyloguj.php';" type="button" class="btn btn-primary">Wyloguj się</button>
  </form>
  </nav>
  <?php else: ?>
  <div class="float-right">
  
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
       $nazwa=$_POST['nazwa'];
       $ilosc=$_POST['ilosc'];
       $opis=$_POST['opis'];
       $kategoria=$_POST['kategoria'];
       $producent=$_POST['producent'];
       $cenan=$_POST['cenan'];
       $cenab=$_POST['cenab'];
       $vat=$_POST['vat'];
       $zdjecie=$_POST['zdjecie'];
       $producentdodaj=$pdo->prepare("Insert into producenci (producent) values (:producent);");
       $producentdodaj->bindValue(':producent', $producent, PDO::PARAM_STR);
       $producentdodaj->execute();
       $idproduce=$pdo->prepare("Select id_producenta from producenci where producent='".$producent."';");
       $idproduce->execute();
       $idproducen = $idproduce->fetch(PDO::FETCH_ASSOC);
       $idproducent = $idproducen['id_producenta'];
       $kategoriadodaj=$pdo->prepare("Insert into kategorie (kategoria) values (:kategoria);");
       $kategoriadodaj->bindValue(':kategoria', $kategoria, PDO::PARAM_STR);
       $kategoriadodaj->execute();
       $idkategor=$pdo->prepare("Select id_kategorii from kategorie where kategoria='".$kategoria."';");
       $idkategor->execute();
       $idkategori = $idkategor->fetch(PDO::FETCH_ASSOC);
       $idkategorii = $idkategori['id_kategorii'];
       $produkt=$pdo->prepare("Insert into produkty (id_kategorii,id_producenta,nazwa_produktu,ilosc,opis,cena_netto,cena_brutto,vat) values (:id_kategorii,:id_producenta,:nazwa,:ilosc,:opis,:cenan,:cenab,:vat);");
       $produkt->bindValue(':id_kategorii', $idkategorii, PDO::PARAM_STR);
       $produkt->bindValue(':id_producenta', $idproducent, PDO::PARAM_STR);
       $produkt->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
       $produkt->bindValue(':ilosc', $ilosc, PDO::PARAM_STR);
       $produkt->bindValue(':opis', $opis, PDO::PARAM_STR);
       $produkt->bindValue(':cenan', $cenan, PDO::PARAM_STR);
       $produkt->bindValue(':cenab', $cenab, PDO::PARAM_STR);
       $produkt->bindValue(':vat', $vat, PDO::PARAM_STR);
       $produkt->execute();
       $id=$pdo->prepare("Select id_produktu from produkty where id_produktu='".$nazwa."';");
       $id->execute();
       $zdjeciedodaj=$pdo->prepare("Insert into galeria (id_produktu,zdjecie) values (:id,:zdjecie);");
       $zdjeciedodaj->bindValue(':id', $id, PDO::PARAM_STR);
       $zdjeciedodaj->bindValue(':zdjecie', $zdjecie, PDO::PARAM_STR);
       $zdjeciedodaj->execute();
   }
   ?>
<div class="container">
  <div id="jeden" class="row">  
    <div class="col-sm">
    
    
    <h1><center>Dodaj produkt: </center></h1><br>
    <h4>
    <form method="post">
  <label for="nazwa">Nazwa produktu:</label>
    <input type="text" name="nazwa"><br>
    <label for="ilosc">Ilość:</label>
    <input type="text" name="ilosc"><br>
  <label for="opis">Opis:</label>
    <textarea id="opis" name="opis" rows="4"></textarea><br>
    <label for="kategoria">Kategoria:</label>
    <input type="text" name="kategoria"><br>
    <label for="producent">Producent:</label>
    <input type="text" name="producent"><br>
  <label for="cenan">Cena netto:</label>
    <input type="text" name="cenan"><br>
  <label for="cenab">Cena brutto:</label>
    <input type="text" name="cenab"><br>
  <label for="vat">VAT:</label>
    <input type="text" name="vat"><br>
    <label for="file">Zdjęcie:</label>
    <input type='file' name='zdjecie'><br>
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
