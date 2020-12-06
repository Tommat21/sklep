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
  button#zatwierdz { margin-left: 245px;}
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
  $szukaj=filter_input(INPUT_POST, 'search');
  if(isset($_POST['submit']))
  {
  $wyszuk=$pdo->query("Select * from produkty where nazwa_produktu='".$szukaj."'");
  $wyszukaj=$wyszuk->fetch(PDO::FETCH_ASSOC);
  $idkategorii=$wyszukaj['id_kategorii'];
  $idproducenta=$wyszukaj['id_producenta'];
  $nazwa=$wyszukaj['nazwa_produktu'];
  $ilosc=$wyszukaj['ilosc'];
  $opis=$wyszukaj['opis'];
  $cenanetto=$wyszukaj['cena_netto'];
  $cenabrutto=$wyszukaj['cena_brutto'];
  $vat=$wyszukaj['vat'];
  $szukajkategor=$pdo->query("Select * from kategorie where id_kategorii='".$idkategorii."'");
  $szukajkategori=$szukajkategor->fetch(PDO::FETCH_ASSOC);
  $kategoria=$szukajkategori['kategoria'];
  $szukajproducent=$pdo->query("Select * from producenci where id_producenta='".$idproducenta."'");
  $szukajproducenta=$szukajproducent->fetch(PDO::FETCH_ASSOC);
  $producent=$szukajproducenta['producent'];
  }
  if(isset($_POST['edytuj']))
  {
  $wyszuk=$pdo->query("Select * from produkty where nazwa_produktu='".$szukaj."'");
  $wyszukaj=$wyszuk->fetch(PDO::FETCH_ASSOC);
  $idkategorii=$wyszukaj['id_kategorii'];
  $idproducenta=$wyszukaj['id_producenta'];
  $nazwa=$_POST['nazwa'];
  $ilosc=$_POST['ilosc'];
  $opis=$_POST['opis'];
  $kategoria=$_POST['kategoria'];
  $producent=$_POST['producent'];
  $cenan=$_POST['cenan'];
  $cenab=$_POST['cenab'];
  $vat=$_POST['vat'];
  $edytuj=$pdo->query("Update produkty set nazwa_produktu=".$nazwa.", ilosc=".$ilosc.", opis=".$opis.", cena_netto=".$cenan.", cena_brutto=".$cenab.", vat=".$vat." where nazwa_produktu=".$szukaj.";");
  $edytujkategorie=$pdo->query("Update kategorie set kategoria=".$kategoria." where id_kategorii=".$idkategorii.";");
  $edytujproducenta=$pdo->query("Update producenci set producent=".$producent." where id_producenta=".$idproducenta.";");
  }
  ?>
<div class="container">
  <div id="jeden" class="row">  
    <div class="col-sm">
    
    
    <h1><center>Wpisz nazwe produktu, którego chcesz edytować: </center></h1><br><br>
    <h4>
        <?php
        $wyszuk=$pdo->query("Select * from produkty where nazwa_produktu='".$szukaj."'");
        $count = $wyszuk->rowCount();
        if($count>0)
        {
        ?>
    <form method="post">
  <label for="nazwa">Nazwa produktu:</label>
    <input type="text" name="nazwa" value="<?php echo $nazwa ?>"><br>
    <label for="ilosc">Ilość:</label>
    <input type="text" name="ilosc" value="<?php echo $ilosc ?>"><br>
  <label for="opis">Opis:</label>
    <textarea id="opis" name="opis" rows="4"><?php echo $opis ?></textarea><br>
    <label for="kategoria">Kategoria:</label>
    <input type="text" name="kategoria" value="<?php echo $kategoria ?>"><br>
    <label for="producent">Producent:</label>
    <input type="text" name="producent" value="<?php echo $producent ?>"><br>
  <label for="cenan">Cena netto:</label>
    <input type="text" name="cenan" value="<?php echo $cenanetto ?>"><br>
  <label for="cenab">Cena brutto:</label>
    <input type="text" name="cenab" value="<?php echo $cenabrutto ?>"><br>
  <label for="vat">VAT:</label>
    <input type="text" name="vat" value="<?php echo $vat ?>"><br>
    <button id="zatwierdz" type="submit" name="edytuj" class="btn btn-primary mb-2">Edytuj</button>
    </form>
    <?php
        }else{
    ?>
    <form method="post">
  <label style="margin-left: 40px;" for="search">Nazwa produktu:</label>
    <input type="text" name="search"><br>
    <button id="zatwierdz" type="submit" name="submit" class="btn btn-primary mb-2">Szukaj</button>
    </form>
    <?php
        }
    ?>
    
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
