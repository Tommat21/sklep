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
   
  <style>
  .bg-primary {background-color:rgb(36,37,38)!important;}
  .btn-primary{color: white; background-color:rgb(58,59,60); border-color:rgb(58,59,60)}
  .btn-primary:hover{color: white; background-color:rgb(78,78,79); border-color:rgb(78,78,79)}
  body {color: white; background-color:rgb(24,25,26);}
    div#jeden {background-color:rgb(36,37,38); padding: 50px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 25px;}
  h3 {line-height: normal}
  h3#blad{font-style: italic; color: red}
  label {width: 200px; margin: 5px 0; clear: left;}
  button#logowanie { margin-left: 205px;}
  button#rejestracja {font-size: 50px; padding: 20px;}

  </style>
  
  
  
  </head>
  <body>
     
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
   
<div class="container">
  <div id="jeden" class="row">  
    <div class="col-sm">
    
    <?php
      if(isset($_POST['register']))
      {
      $nazwa = $_POST['nazwa'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $password2 = $_POST['password2'];
      $hashPassword = password_hash($password,PASSWORD_BCRYPT);
      $spr = $pdo->prepare("SELECT login FROM uzytkownik WHERE login = '".$nazwa."';");
      $spr->execute();
      $spr2 = $pdo->prepare("SELECT email FROM uzytkownik WHERE email = '".$email."';");
      $spr2->execute();
      if ($spr2->rowCount()== 0)
      {
      if ($spr->rowCount() == 0)
      {
            if ($password == $password2)
            {
                if($password !="" && $password2 !="")
                {
                    if(strlen($password)>=8 && strlen($password2)>=8)
                    {
      $kod_aktywacyjny = md5(uniqid(rand()));
      $sth = $pdo->prepare('INSERT INTO uzytkownik (login,email,haslo,kod_aktywacyjny) VALUE
      (:nazwa,:email,:password,:kod_aktywacyjny)');
      $sth->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
      $sth->bindValue(':email', $email, PDO::PARAM_STR);
      $sth->bindValue(':password', $hashPassword, PDO::PARAM_STR);
      $sth->bindValue(':kod_aktywacyjny', $kod_aktywacyjny, PDO::PARAM_STR);
      $sth->execute();
      $message='Aby aktywować konto w serwisie sklepik kliknij w link: http://masnyted.ct8.pl/aktywacja.php i wpisz kod podany poniżej:'. "\r\n" .$kod_aktywacyjny.'';
      $headers = 'From: masnyted@masnyted.ct8.pl' . "\r\n" .
      'Reply-To: masnyted@masnyted.ct8.pl' . "\r\n";
      mail($email, 'Aktywacja konta', $message, $headers);
      die("<h3>Zarejestrowano pomyślnie! Sprawdź maila w celu aktywacji konta.</h3>");
                    }
                    else echo "<h3 id='blad'>Hasło musi zawierać przynajmniej 8 znaków</h3>";
            }
            else echo "<h3 id='blad'>Podaj Hasło!</h3>";
      }
            else echo "<h3 id='blad'>Hasła nie są takie same!</h3>";
      }
      else echo "<h3 id='blad'>Podana nazwa jest już zajęta!</h3>";
      }
      else echo "<h3 id='blad'>Podany email jest już zarejestrowany!</h3>";
      }
    ?>
    
    <h1>Formularz rejestracyjny</h1>
    <h4>
    <form method="post">
    <label for="nazwa">Nazwa użytkownika:</label>
    <input type="text" name="nazwa"><br>
    <label for="email">Email:</label>
    <input type="email" name="email"><br>
    <label for="password">Hasło:</label>
    <input type="password" name="password"><br>
    <label for="password2">Potwierdź hasło:</label>
    <input type="password" name="password2"><br>
    <button id="logowanie" type="submit" name="register" class="btn btn-primary mb-2">Zarejestruj</button>
    </form>
    
    </h4>

    </div>
  </div>
</div>

  <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-primary">
      <a class="navbar-brand"> © Copyright by Team Człapski & Wróbel</a>
  </nav>      

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
