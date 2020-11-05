<!doctype html>
<html lang="pl">

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
	label {width: 200px; margin: 5px 0; clear: left;}
	button#logowanie { margin-left: 205px;}
	button#rejestracja {font-size: 50px; padding: 20px;}
	h2 {text-align: center;}
	div#dwa {background-color:rgb(112,57,68); padding: 30px; position: fixed; top: 25%; left: 50%; transform: translate(-50%, -50%); border-radius: 25px;}

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

  
  <div class="float-right">
  
  <nav class="navbar navbar-light bg-primary">
  <form class="form-inline">
  <button onclick="window.location.href = 'login.php';" type="button" class="btn btn-primary">Zaloguj się</button>
  </form>
  </nav>
 
  </div>
  
  </nav>

 <div class="container">
  <div id="dwa" class="row">	
    <div class="col-sm">
				
		<h2>Wpisz swój adres email, a my wyślemy ci link do zresetowania hasła. </h2>

    </div>
  </div>
</div>
 
  
<div class="container">
  <div id="jeden" class="row">	
    <div class="col-sm">
		
		
		<h2>Zresetuj hasło: </h2>
		<h4>
		<br>
		<form method="post">
		<label for="email">Podaj adres email:</label>
		<input type="email" name="email"><br>
		<button id="logowanie" type="submit" name="register" class="btn btn-primary mb-2">Wyślij</button>
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
