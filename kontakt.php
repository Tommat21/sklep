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
  div#jeden {background-color:rgb(36,37,38); padding: 50px; margin-top: 8%; border-radius: 25px;}
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
<?php
  if($_SESSION['admin']==true)
  {
  ?>
<div id="jeden" class="container float-right" style="margin-right: 5%;">
   <?php
  }else{
    ?>
    <div id="jeden" class="container">
        <?php
  }
  ?>
 <div class="row">
      <div class="col-xl-6 col-md-6 col-sm-12">
       <div class="row">
     <h1>
     Skontaktuj się z nami!
     <br><br>
     </h1>
     </div>
     
<form>
  <div class="col-8">  
  <div class="form-group">
      <label for="exampleFormControlInput1">Email: </label>
      <input type="email" class="form-control" id="exampleFormControlInput1">
  </div>
         
  <div class="form-group">
      <label for="exampleFormControlTextarea1">Treść: </label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  </div>
      <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Wyślij</button>
      </div>
</form>

    </div>

    
    <div class="col-xl-6 col-md-6 col-sm-12">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
    <h1>
      Znajdziesz nas tu:
      <br><br>
      </h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d19575.36966216811!2d22.283237!3d52.172126000000006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x47d8cb735af52cad!2sZesp%C3%B3%C5%82%20Szk%C3%B3%C5%82%20Ponadgimnazjalnych%20nr%201%20w%20Siedlcach!5e0!3m2!1spl!2spl!4v1582297681626!5m2!1spl!2spl" width="500" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
      
    </div>
    </div>
  
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