<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header("Location: http://masnyted.ct8.pl/index.php");
?>