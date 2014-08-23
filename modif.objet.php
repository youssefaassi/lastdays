<?php
session_start();
include 'connexion.bdd.php';
	if (empty($_POST["nomObjet"])) // mot de passe
	{
		$errors["nomObjet"] = 'Le pseudo est vide';
	}
	if (empty($_POST["description"])) // mot de passe
	{
		$errors["description"] = 'La description est vide';
	}
	if (sizeof($errors)>0) //si erreur
	{
		include 'objet.php';
		exit();
	}
if($_POST['modifObjet']!=null){
	
	$resultats=$connexion->query("SELECT * FROM `Collection` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	
	$connexion->exec("UPDATE `youssefablog`.`Collection` SET `titre` = '".$_POST["nomObjet"]."' , `description` = '".$_POST["description"]."' , `jour` = '".$_POST["nbJour"]."' , `categorie` = '".$_POST["select"]."' WHERE `Collection`.`id` = ".$_GET['id'].";");
	header('Location: objet.view.php?msg=modif');
	exit();
}
if($_POST['supprimer']!=null){
	
	$url="";
	$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `Collection`.`id` = '".$_GET['id']."'"); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	while( $ligne = $resultats->fetch() )
	{
		$url = $ligne->image;
	}
	echo $url;
	unlink( substr($url, 1));
	
	$connexion->exec("DELETE FROM `youssefablog`.`Collection` WHERE `Collection`.`id` = '".$_GET['id']."'");
	header('Location: objet.view.php?msg=delete');
	exit();
}
?>