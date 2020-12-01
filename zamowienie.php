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
   
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
    div#jeden {background-color:rgb(36,37,38); padding: 50px; margin-top: 7.5%; border-radius: 25px;}
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
 <nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-primary">
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
 </div>
  
  <div class="float-right">
  <?php
  if($_SESSION['admin']==true)
  {
  ?>
  <nav class="navbar bg-primary">
  <button class="btn btn-primary" id="menu-rozwijane">Admin Panel</button>
  </nav>
  <?php
  }
     ?> 
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
    <label for="adres">Adres:</label><br>
    <input type="text" name="adres"><br>
    <label for="miasto">Miasto:</label><br>
    <input type="text" name="miasto"><br>
    <label for="kp">Poczta:</label><br>
    <input type="text" name="kp"><br><br>
    <input type="submit" class='btn btn-info' name='zaplac' value="Kup i zapłać"><br>
  </form>

  
  </h4>

    </div>
  
    <div id="jeden" class="col-sm" style="margin-left: 5%; border: 2px solid white;">
     <h1>Twoje zamówienie: <br><br></h1>
   <h4> 
       <?php
     $iduzytkownik=$_SESSION['iduzytkownik'];
     $razem=0;
     $zam=$pdo->query("Select * FROM koszyk Natural Join produkty where id_uzytkownik='".$iduzytkownik."'");
     echo "<table class='table'>";
     echo "<tr><th>Produkt</th><th>Kwota</th></tr>";
     foreach($zam as $row){   
     echo "<tr>";
     echo "<td>".$row['nazwa_produktu']." x <b>".$row['ilosc_kup']."</b></td><td>".$row['ilosc_kup']*$row['cena_brutto']."zł</td>";
     echo "</tr>";
     $razem+=$row['ilosc_kup']*$row['cena_brutto'];
     }
     echo  "<tr><td> Suma: </td><td>".$razem."zł</td></tr>";   
     echo "</table>";
     echo "<hr style='background-color: white; margin-top: -17.5px;'>";
     if(isset($_POST['zaplac']))
     {
         $imie=$_POST['imie'];
         $nazwisko=$_POST['nazwisko'];
         $telefon=$_POST['telefon'];
         $email=$_POST['email'];
         $adres=$_POST['adres'];
         $miasto=$_POST['miasto'];
         $poczta=$_POST['kp'];
         $sprawdzadres=$pdo->query("Select * from adres where adres='".$adres."' and miasto='".$miasto."' and poczta='".$poczta."';");
         if($sprawdzadres->rowCount()<1)
         {
         $adresdodaj=$pdo->query("Insert into adres (adres,miasto,poczta) values('".$adres."','".$miasto."','".$poczta."');");
         }
         $idadr=$pdo->query("Select * from adres where adres='".$adres."' and miasto='".$miasto."' and poczta='".$poczta."';");
         $idadre=$idadr->fetch(PDO::FETCH_ASSOC);
         $idadres=$idadre['id_adres'];
         $sprawdzklienta=$pdo->query("Select * from klienci where id_uzytkownik='".$iduzytkownik."';");
         if($sprawdzklienta->rowCount()<1)
         {
         $dodajklienta=$pdo->query("Insert into klienci (id_adres,id_uzytkownik,imie,nazwisko,telefon,email) values('".$idadres."','".$iduzytkownik."','".$imie."','".$nazwisko."','".$telefon."','".$email."') ;");
         }
         $idklien=$pdo->query("Select * from klienci where id_uzytkownik='".$iduzytkownik."';");
         $idklient=$idklien->fetch(PDO::FETCH_ASSOC);
         $idklienta=$idklient['id_klienta'];
         $data = $_POST['my_date'];
         $zamowienie=$pdo->query("Insert into zamowienia (id_klienta,wartosc,czy_zrealizowane,imie,nazwisko,telefon,email,adres,miasto,poczta) values ('".$idklienta."','".$razem."',0,'".$imie."','".$nazwisko."','".$telefon."','".$email."','".$adres."','".$miasto."','".$poczta."') ;");
         $produkty=$pdo->query("Select * from koszyk where id_uzytkownik='".$iduzytkownik."';");
         $idzamowien=$pdo->query("Select * from zamowienia where id_klienta='".$idklienta."' and wartosc='".$razem."';");
         $idzamowieni=$idzamowien->fetch(PDO::FETCH_ASSOC);
         $idzamowienia=$idzamowieni['id_zamowienia'];
         $ilosckoszyk=$pdo->query("Select * from koszyk where id_uzytkownik='".$iduzytkownik."';");
         foreach($produkty as $row)
         {
         $produktyzamowienia=$pdo->query("Insert into zamowienia_produkty (id_produktu,id_zamowienia,ilosc) values ('".$row['id_produktu']."','".$idzamowienia."','".$row['ilosc']."') ;");
         $iloscproduktu=$pdo->query("Update produkty set ilosc=ilosc-".$ilosckoszyk['ilosc_kup']." where id_produktu=".$iduzytkownik.";");
         }
         foreach($ilosckoszyk as $row)
         {
         $aktproduktyzamowienia=$pdo->query("Update produkty_zamowienia set ilosc=".$row['ilosc_kup']." where id_uzytkownik=".$iduzytkownik.";");
         }
         $czysckoszyk=$pdo->query("Delete from koszyk where id_uzytkownik='".$iduzytkownik."';");
         header("Location: http://masnyted.ct8.pl/index.php");
     }
     
     ?>
     </h4>
    </div>
  </div>
</div>
<br><br><br><br>
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
