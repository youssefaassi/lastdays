<?php
session_start();
include 'connexion.bdd.php';
include 'function.inc.php';
	if (empty($_POST["pseudo"])) // mot de passe
	{
		$errors["pseudo"] = 'Le pseudo est vide';
	}
	if (empty($_POST["pass"])) // mot de passe
	{
		$errors["pass"] = 'Le mot de passe est vide';
	}
	if (empty($_POST["email"])) // mail vide
	{
		$errors["email"] = 'Le mail est vide';
		
	}
	$email = trim($_POST['email']);
	if(is_valid_email($email)==false)
	{
		$errors["email"] = 'Le mail n\'est pas valide';
	}
	if (sizeof($errors)>0) //si erreur
	{
		include 'profil.view.php';
		exit();
	}
if($_POST['modifier']!=null){
	
	$resultats=$connexion->query("SELECT * FROM `users` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	
	$connexion->exec("UPDATE `youssefablog`.`users` SET `pseudo` = '".$_POST["pseudo"]."' , `pass` = '".$_POST["pass"]."' , `email` = '".$_POST["email"]."' WHERE `users`.`id` = ".$_SESSION["userid"].";");
	
	$_SESSION["pseudo"] = $_POST["pseudo"];
	header('Location: index.php');
	exit();
}
if($_POST['supprimer']!=null){
	
	$resultats=$connexion->query("SELECT * FROM `users` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	
	$connexion->exec("DELETE FROM `youssefablog`.`users` WHERE `users`.`id` = '".$_SESSION["userid"]."'");
	header('Location: logout2.php');
	exit();
}
?>