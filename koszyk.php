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
   
  <--Css-->
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
  .btn-info {background-color:#0274be;}
  .btn-info:hover{background-color:#0274be;}
  th{background-color:white; color:#0274be}
  table{
     border: 1px solid white;
   text-align: center;
  }
  img {border: 3px solid #0274be;}
  .vertical-center {
  margin: 0;
  transform: translateY(17.5%);
  }
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

    
  <br><br><br><br>
  
  <div class="container float-right" style="margin-right: 5%;">
      <h1 style="margin: 20px; margin-top: 50px; margin-bottom: 50px;">Koszyk: </h1><br>
    
    <h4>
    <?php
    require "polaczenie.php";
    $iduzytkownik=$_SESSION['iduzytkownik'];
    if(!$iduzytkownik)
    {
        die("Musisz być zalogowany aby dokonać zakupów");
    }
    if(isset($_POST['usun'])){  
    
    $usunkosz=$pdo->prepare("DELETE FROM koszyk WHERE id_produktu = ".$_POST['usun']." and id_uzytkownik=".$iduzytkownik."");
    $usunkosz->execute();  
    
    }
    $razem=0;
    $koszyk = $pdo->query("Select * FROM koszyk Natural Join produkty Natural Join galeria where id_uzytkownik=".$iduzytkownik."");
    $count = $koszyk->rowCount();
    if ($count==0){
      echo "Brak produktów w koszyku.";
    }
    else{
    echo "<table class='table'>";
    echo "<tr><th>&nbsp</th><th>&nbsp</th><th>Produkt</th><th>Cena</th><th>Ilość</th><th>Kwota</th></tr>";
    foreach($koszyk as $row){
      

      echo "<tr>";
      echo "<td class='vertical-center'><form method='post'><button name='usun' value='".$row['id_produktu']."' class='btn btn-primary'>X</button></form></td><td><a style='text-decoration:none; color: white;' href='bigprodukt.php?id=".$row['id_produktu']."'><img width='75px' height='75px' src='data:image/jpeg;base64,".base64_encode( $row['zdjecie'] )."'/></a></td>";
      echo "<td class='vertical-center'><a style='text-decoration:none; color: white;' href='bigprodukt.php?id=".$row['id_produktu']."'>".$row['nazwa_produktu']."</a></td>";
      echo "<td class='vertical-center'>".$row['cena_brutto']."zł</td><td class='vertical-center'>".$row['ilosc_kup']."</td><td class='vertical-center'>".$row['ilosc_kup']*$row['cena_brutto']."zł</td>";
      echo "</tr>";

      $razem+=$row['ilosc_kup']*$row['cena_brutto'];
    }
    echo "<tr><td></td><td></td><td></td><td></td><th> RAZEM: </th><th>".$razem."zł</th></tr>";
    echo "</table>";
    echo "<a href='zamowienie.php'><button class='btn btn-info' style='float: right; width: 360px; height: 50px;'><b>Przejdź do kasy</b></button></a>";

    }
    ?>
    </h4>
    

 
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