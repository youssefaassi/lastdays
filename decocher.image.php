<?php
session_start();
include 'connexion.bdd.php';

// $_SESSION["collection"] = $_SESSION["collection"]." ".$_POST["imageid"] ; // on rajoute l'id dans l'array session collection
$collection = $_SESSION["collection"] ;
// echo("debut : ".$collection);
// echo("</br>retirer : ".$_POST["imageid"] );

$arCollection = explode(" ",$collection);
// echo("</br>test : ");

$newcollection="";
for ($i=0; $i<sizeof($arCollection); $i++)//on recree l'array arCollection sans y ajouter l'image actuelle --plutot que de la supprimer--
{
	if ($arCollection[$i] != $_POST["imageid"] && $arCollection[$i]!="")
		$newcollection.=(" ".$arCollection[$i]);
}
$_SESSION["collection"] = $newcollection;
// echo("</br>resultat : ".$newcollection );
 $connexion->exec("UPDATE `youssefablog`.`users` SET `collectionperso` = '".$newcollection."' WHERE `users`.`id` = ".$_SESSION["userid"].";"); // on met a jour la collection dans la bdd

?>