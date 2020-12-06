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
    <?php
  if($_SESSION['admin']==true)
  {
  ?>
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
     <?php
  }
     ?>
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
  if($_SESSION['admin']==true)
  {
  ?>
      <div class="container float-right" style="margin-top: 125px; margin-bottom: 200px; margin-right: 5%;">
          <?php
  }else{
          ?>
          <div class="container" style="margin-top: 125px; margin-bottom: 200px;">
              <?php
  }
              ?>
      <h1 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Produkty: </h1>
      <h6 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Wyszukaj:
          <form action="" method="post">
              <input type="text" name="szukaj">
              <input type="submit" name="wyszukaj" value="szukaj">
          </form>
          <?php
          $szukaj=$_POST['szukaj'];
          ?>
        <p>Ilość: 
        <a href="index.php?ilosc=10&czy_limit=tak"> 10 </a>
        <a href="index.php?ilosc=20&czy_limit=tak"> 20 </a>
        <a href="index.php?ilosc=30&czy_limit=tak"> 30 </a>
        <a href="index.php"> Wszystko </a>
        </p>
      </h6>

<?php
   $iduzytkownik=$_SESSION['iduzytkownik'];
   if(isset($_POST['kup'])){
    $czyjest=$pdo->prepare("SELECT id_produktu FROM koszyk WHERE id_produktu=".$_POST['kup']." and id_uzytkownik=".$iduzytkownik."");
    $czyjest->execute();
    if ($czyjest->rowCount()>0)
    {
      $dodaj=$pdo->prepare("UPDATE koszyk SET ilosc_kup=ilosc_kup+1 WHERE id_produktu=".$_POST['kup']." and id_uzytkownik=".$iduzytkownik."");
      $dodaj->execute();
    }
    else{
    $dodkosz=$pdo->prepare("INSERT INTO koszyk (id_uzytkownik, id_produktu, ilosc_kup) VALUES (".$iduzytkownik.",".$_POST['kup'].",1)");
    $dodkosz->execute();
    }
    header("Location: koszyk.php");
  }
      
  if ($_GET['czy_limit']=='tak' && $_POST['wyszukaj']){
  $ilosc=$_GET['ilosc'];
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie where nazwa_produktu like '%$szukaj%' or kategoria like '%$szukaj%' LIMIT ".$ilosc."");
  }
  else if($_POST['wyszukaj']){
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie where nazwa_produktu like '%$szukaj%' or kategoria like '%$szukaj%'");
  }
  else if($_GET['czy_limit']=='tak')
  {
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie LIMIT ".$ilosc."");
  }
  else
  {
  $stmt=$pdo->query("SELECT * FROM produkty Natural Join galeria Natural Join kategorie");   
  }
  foreach($stmt as $row){

    echo "<div class='col' id='jeden'>";
    echo "<div class='row'>";
    echo "<a style='text-decoration:none; color: white;' href='bigprodukt.php?id=".$row['id_produktu']."'><img width='300px' height='300px' src='data:image/jpeg;base64,".base64_encode( $row['zdjecie'] )."'/></a>";
    echo "<div class='col' style='margin-left: 30px;'>";
    echo "<h1><a style='text-decoration:none; color: white;' href='bigprodukt.php?id=".$row['id_produktu']."'>".$row['nazwa_produktu']."</a></h1>";
    echo "<h5 style='margin-left: 3px'>cena: ".$row['cena_brutto']."zł</h5><br><br>";
    echo "<h4>".$row['opis']."</h4><br><br><br>";
    echo "<form method='post'>";
    echo "<button type='submit' name='kup' value='".$row['id_produktu']."' class='btn btn-info' style='position: absolute; bottom: 15px'>Dodaj do koszyka</button>";
    echo "</form>";
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