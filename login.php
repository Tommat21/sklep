<!doctype html>
<html lang="pl">
        <?php
    session_start();
    require "polaczenie.php";
    error_reporting(-1);
$zalogowany = $_SESSION['valid'];
if($zalogowany)
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
    div#jeden {background-color:rgb(36,37,38); padding: 50px; margin-top: 18%; border-radius: 25px;}
  h3 {color: white; line-height: normal}
  h3#blad{font-style: italic; color: red}
  label {width: 100px; margin: 5px 0; clear: left;}
  button#logowanie { margin-left: 108px;}
  button#rejestracja {font-size: 50px; padding: 20px;}
  a{font-size: 15px; margin-right: 88px;}
  </style>
  
  
  </head>
  <body>
     
     
 <nav class="navbar fixed-top navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-light bg-primary">
 <div class="collapse navbar-collapse" id="navbarNavDropdown">
 </div>
  
  <div class="float-right">
  
  
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
   
<div id="jeden" class="container">
  <div class="row">
    <div class="col-sm">
  
<?php
if(isset($_POST['login']))
{
 $email = trim($_POST['email']);
 $haslo = trim($_POST['haslo']);
 $sth = $pdo->prepare('SELECT * FROM uzytkownik WHERE email=:email limit 1');
 $sth->bindValue(':email', $email, PDO::PARAM_STR);
 $sth->execute();
 $user = $sth->fetch(PDO::FETCH_ASSOC);
 $spr=$pdo->prepare('SELECT * FROM uzytkownik WHERE email=:email AND aktywny=1');
 $spr->bindValue(':email', $email, PDO::PARAM_STR);
 $spr->execute();
 $akt = $spr->fetch(PDO::FETCH_ASSOC);
 $_SESSION['iduzytkownik']=$akt['id_uzytkownik'];
 if($user)
{
 if(password_verify($haslo,$user['haslo']))
{
if(!$akt){
  die("<h3>Konto wymaga aktywacji przez kod podany w mailu!</h3>");
}else{
$_SESSION['valid'] = true;
if($_POST['email']=="admin@admin.pl" && $_SESSION['valid'] == true)
 {
     $_SESSION['admin']=true;
 }
header("Location: http://masnyted.ct8.pl/index.php");
die("<h3>Użytkownik zalogowany pomyślnie!</h3>");
}
 }else{
 echo "<h3 id='blad'>Nieprawidłowe hasło!</h3>";
 }
 }else{
 echo "<h3 id='blad'>Nie znaleziono użytkownika!</h3>";
 }
}
?>
    <h1>Zaloguj się: <br><br></h1>
    
  <h3>
  
  <form method="post">
    <label for="email">Email:</label>
    <input type="email" name="email"><br>
    <label for="haslo">Hasło:</label>
    <input type="password" name="haslo">
    <a href="mailhaslo.php">Zapomniałeś hasła?</a>
    <button id="logowanie" type="submit" name="login" class="btn btn-primary mb-2">Zaloguj</button>
  </form>

  
  </h3>

    </div>
  
    <div class="col-sm">
     <h1><center>Nie masz konta? </center><br></h1>
       <h2><center><button id="rejestracja" onclick="window.location.href = 'rejestracja.php';" type="button" class="btn btn-primary">Zarejestruj się</button></center></h2>
    </div>
  </div>
</div>

  <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-primary">
      <a class="navbar-brand"> © Copyright by Team Człapski & Wróbel</a>
  </nav>      

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- skrypt do panelu bocznego -->
        
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
