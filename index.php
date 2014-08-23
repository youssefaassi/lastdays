<?php
session_start();
$errors;
$connexion;
include('function.inc.php');
echo '<link rel="stylesheet" type="text/css" href="css/style.css">'; // css
echo '<link href="http://fonts.googleapis.com/css?family=Lora" rel="stylesheet" type="text/css">'; // font


if ($_POST['creer2']!=null) // bouton creer2
{
	include 'ajout.user.php';
}

if ($_POST['connexion']!=null) // bouton connexion
{
// verification de l'existance du compte et du bon mot de passe

	$_POST['pseudo'] = trim(strip_tags(htmlspecialchars($_POST['pseudo'])));
	$_POST['pass'] = trim(strip_tags(htmlspecialchars($_POST['pass'])));
	
	if (empty($_POST["pseudo"])) // mot de passe
	{
		$errors["pseudo"] = 'Le pseudo est vide';
	}
	if (empty($_POST["pass"])) // mot de passe
	{
		$errors["pass"] = 'Le mot de passe est vide';
	}
	if (sizeof($errors)>0) //si erreur
	{
		include 'login.view.php';
		//print_r($errors);
		exit();
	}
	include 'connexion.bdd.php';
	$resultats=$connexion->query("SELECT * FROM `users` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
	$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
	
	$boolOk=false;
	while( $ligne = $resultats->fetch() ) // on récupère la liste des membres
	{
		if ($ligne->pseudo == $_POST['pseudo'])
		{
			if ($ligne->pass == $_POST['pass'])
			{
				$_SESSION['userid']=$ligne->id; // on recupere l'id de l'utilisateur connecté
				$_SESSION['collection']=$ligne->collectionperso; // on recupere la collection de l'utilisateur connecté
				$boolOk=true;
				break;
			}
			else
			{
				$errors["fauxpass"] = 'Mauvais mot de passe.';
				include 'login.view.php';
				exit();
			}
		}
	}
	if ($boolOk) // si les identifiants sont bons
	{
	// accepter la connexion
		$_SESSION['pseudo']=$_POST['pseudo'];
		$_SESSION['connexion']=true;
		header("Location: index.php");
		
		include 'directory.view.php';
	}
	else
	{
		$errors["fauxpseudo"] = 'L\'utilisateur '.$_POST['pseudo'].' n\'existe pas';
		include 'login.view.php';
	}

	$resultats->closeCursor(); // on ferme le curseur des résultats
	
}

elseif ($_POST['creer']!=null) // bouton creer
{
include 'create.view.php';
}
elseif ($_POST['login']!=null) // bouton creer
{
include 'login.view.php';
}
elseif($_SESSION['connexion']==false || $_SESSION==null)
{
include 'login.view.php';
}
elseif($_SESSION['connexion']==true)
{
include 'connexion.bdd.php';
include 'directory.view.php';
}
if ($_POST['saveObjet']!=null)
{
//	print_r($_POST);
//	print_r($_SESSION);
	include 'ajout.image.php';
}
// echo('<pre>');
// print_r($_SESSION);
// print_r($_POST);
// echo('</pre>');

?>