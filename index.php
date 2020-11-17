<!doctype html>
<html lang="pl">
    <?php
    session_start();
    require "polaczenie.php";
    error_reporting(0);
$zalogowany = $_SESSION['valid'];
    ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar.css">
    <title>Sklepik.exe</title>
   
  <!--Css-->
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
   #jeden {background-color:rgb(36,37,38); padding: 40px; border-radius: 25px; margin: 20px;}
  .btn-info {background-color:#0274be;}
  .btn-info:hover{background-color:#0274be;}
  img {margin-left: 15px; border: 3px solid #0274be;}
   
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
    
    
      <div class="container float-right" style="margin-top: 125px; margin-bottom: 200px; margin-right: 5%;">
      <h1 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Produkty: </h1>
      <h6 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Kategoria: 
      <select name='wkat' onchange="location='#'">
      <option value='all'>--wybierz--</option>  
<?php    
  $kategoria=$pdo->query("SELECT * FROM kategorie GROUP BY kategoria ASC");
  foreach($kategoria as $kat){
    echo "<option value='".$kat['kategoria']."'>".$kat['kategoria']."</option>";
  }
  
?>    
      </select>
        <p>Ilość: 
        <a href="index.php?ilosc=10&czy_limit=tak"> 10 </a>
        <a href="index.php?ilosc=20&czy_limit=tak"> 20 </a>
        <a href="index.php?ilosc=30&czy_limit=tak"> 30 </a>
        <a href="index.php"> Wszystko </a>
        </p>
      </h6>

<?php
  if ($_GET['czy_limit']=='tak'){
  $ilosc=$_GET['ilosc'];
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie LIMIT ".$ilosc."");
  }
  else{
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie");
  }
  foreach($stmt as $row){

    echo "<div class='col' id='jeden'>";
    echo "<div class='row'>";
    echo "<img width='300px' height='300px' src='data:image/jpeg;base64,".base64_encode( $row['zdjecie'] )."'/>";
    echo "<div class='col' style='margin-left: 30px;'>";
    echo "<h1>".$row['nazwa_produktu']."</h1>";
    echo "<h5 style='margin-left: 3px'>cena: ".$row['cena_brutto']."zł</h5><br><br>";
    echo "<h4>".$row['opis']."</h4><br><br><br>";
    echo "<button class='btn btn-info' style='position: absolute; bottom: 15px'>Dodaj do koszyka</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

  }
?>
    
</div>
    
  <!--Stopka-->
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