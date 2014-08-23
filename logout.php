<?php
//LOGOUT.PHP
session_start();

//effacer les fichiers stockant la session
session_destroy();
// effacer la variable de session
unset($_SESSION);
session_start();

$_SESSION['babaye'] = 'A bientot!';

//rediriger le navigateur vers la page d'accueil
header("Location: index.php");
?>