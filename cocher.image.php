<?php
session_start();
include 'connexion.bdd.php';


if (substr($_SESSION["collection"],0, 1)==" ")
	$_SESSION["collection"] = substr($_SESSION["collection"], 1);
$nbImg = sizeof(explode(" ", $_SESSION["collection"]));
if ($nbImg>6)
{
	echo("max");
}
else
{
	$_SESSION["collection"] = $_SESSION["collection"]." ".$_POST["imageid"] ; // on rajoute l'id dans l'array session collection
	$newcollection = $_SESSION["collection"] ;
	// echo($newcollection);
	//echo($_SESSION["userid"]);
	$connexion->exec("UPDATE `youssefablog`.`users` SET `collectionperso` = '".$newcollection."' WHERE `users`.`id` = ".$_SESSION["userid"].";"); // on met a jour la collection dans la bdd
	// print_r($connexion->errorInfo());
}

?>