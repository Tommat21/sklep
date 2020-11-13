<!doctype html>
<html lang="pl">
    <?php
    session_start();
    require "polaczenie.php";
    error_reporting(-1);
$zalogowany = $_SESSION['valid'];
    ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
  img {margin-left: 15px;}
   
  </style>
  
  </head>
  <body>
     
 <!--Navbar-->
 <nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-primary">
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
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
    
    
      <div class="container" style="margin-top: 125px; margin-bottom: 200px;">
      <h1 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Produkty: </h1>
    

<?php
  require  "polaczenie.php";
  $stmt=$pdo->query("SELECT * FROM produkty");
  $i=0;
  foreach($stmt as $row){

    echo "<div class='col' id='jeden'>";
    echo "<div class='row'>";
    echo "<img src='xd.png' width='300px' height='300px';>";
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>