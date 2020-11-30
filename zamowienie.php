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
    <link rel="stylesheet" href="sidebar.css">
    <title>Sklepik.exe</title>
   
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
    div#jeden {background-color:rgb(36,37,38); padding: 50px; margin-top: 15%; border-radius: 25px;}
  h3 {color: white; line-height: normal}
  h3#blad{font-style: italic; color: red}
  label {width: 100px; margin-left: 20px; margin: 5px 0; clear: left;}
  button#dane { margin-left: 108px;}
  .btn-info {background-color:#0274be;}
  .btn-info:hover{background-color:#0274be;}
  input {margin-left: 75px;}
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
   
<div class="container float-right" style="margin-right: 5%;">
  <div class="row">
    <div id="jeden" class="col-sm">
  

    <h1><center>Dane płatności: <br></center></h1>
    
  <h4>
  
  <form method="post">
    <br><label for="imie">Imie:</label><br>
    <input type="text" name="imie"><br>
    <label for="nazwisko">Nazwisko:</label><br>
    <input type="text" name="nazwisko"><br>
    <label for="telefon">Telefon:</label><br>
    <input type="text" name="telefon"><br>
	<label for="email">Email:</label><br>
    <input type="email" name="email"><br>
  </form>

  
  </h4>

    </div>
  
    <div id="jeden" class="col-sm" style="margin-left: 5%; border: 2px solid white;">
     <h1>Twoje zamówienie: <br><br></h1>
	 <h4> 
       <?php
	   $razem=0;
	   $zam=$pdo->query("Select * FROM koszyk Natural Join produkty");
	   echo "<table class='table'>";
	   echo "<tr><th>Produkt</th><th>Kwota</th></tr>";
	   foreach($zam as $row){	 
	   echo "<tr>";
	   echo "<td>".$row['nazwa_produktu']." x <b>".$row['ilosc_kup']."</b></td><td>".$row['ilosc_kup']*$row['cena_brutto']."zł</td>";
	   echo "</tr>";
	   $razem+=$row['ilosc_kup']*$row['cena_brutto'];
	   }
	   echo	"<tr><td> Suma: </td><td>".$razem."zł</td></tr>";   
	   echo "</table>";
	   echo "<hr style='background-color: white; margin-top: -17.5px;'>";
	   echo "<button class='btn btn-info' style='width: 450px; height: 50px;'><b>Kup i zapłać</b></button>";
	  	   
	   
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
