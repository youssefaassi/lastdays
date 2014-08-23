<?php
	include 'connexion.bdd.php';
	$resultats=$connexion->query("SELECT * FROM `users` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet

	$boolOk2=false;
	while( $ligne = $resultats->fetch() ) // on récupère la liste des membres
	{
		if ($ligne->pseudo == $_POST['pseudo']) // pseudo existant
		{
			$errors["pseudo"] = 'Le pseudo '.$_POST['pseudo'].' existe déjà';
			break;
		}
	}
	if (empty($_POST["pseudo"])) // pseudo vide
	{
		$errors["pseudo"] = 'Le pseudo est vide';
	}
	if (empty($_POST["pass"])) // mot de passe vide
	{
		$errors["pass"] = 'Le mot de passe est vide';
	}
	if (empty($_POST["email"])) // mail vide
	{
		$errors["email"] = 'Le mail est vide';
	}
	$email = trim($_POST['email']);
	if(is_valid_email($email)==false) // mail non valide
	{
		$errors["email"] = 'Le mail n\'est pas valide';
	}
	if (sizeof($errors)>0) //si erreur
	{
		include 'create.view.php';
		exit();
	}
	else
	{
		$connexion->exec("INSERT INTO `youssefablog`.`users` (`id`, `pseudo`, `pass`, `age`, `email`) VALUES (NULL, '".trim(strip_tags(htmlspecialchars($_POST['pseudo'])))."', '".trim(strip_tags(htmlspecialchars($_POST['pass'])))."', '".trim(strip_tags(htmlspecialchars($_POST['age'])))."', '".trim(strip_tags(htmlspecialchars($_POST['email'])))."');");
		$_POST['connexion']="connexion";
		
	}
?>