<?php
	include 'connexion.bdd.php';
	
	if (substr($_SESSION["collection"],0, 1)==" ")
		$_SESSION["collection"] = substr($_SESSION["collection"], 1);
	$nbImg = sizeof(explode(" ", $_SESSION["collection"]));
	if ($nbImg>6)
	{
		echo("<div class='msgmax'><p>Vous avez avez atteint le maximum d'objets</p></div>");
		exit();
	}
	
	if (empty($_POST["nomObjet"]))
	{
		$_SESSION["bugNomObjet"] = 'Le nom de l\'objet est vide';
	}
	else  $_SESSION["bugNomObjet"] = "";
	
	if (empty($_POST["description"]))
	{
		$_SESSION["bugDescription"] = 'La description est vide';
	}
	else $_SESSION["bugDescription"] = "";
	
	if ($_SESSION["bugDescription"]!="" || $_SESSION["bugNomObjet"] != "") //si erreur
	{
		include 'ajout.image.view.php';
            echo '  <img src="'.$_SESSION["img"].'" height="300" width="300"/>';
		exit();
	}
	else
	{
	
		$newcollection;
		$resultats=$connexion->query("SELECT * FROM `Collection` "); // on va chercher tous les membres de la table qu'on trie par ordre croissant
		$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet

			$connexion->exec("INSERT INTO `youssefablog`.`Collection`(`id`,`titre`,`image`,`description`,`date`,`user`,`jour`,`categorie`)
															  VALUES (NULL,'".trim(strip_tags(htmlspecialchars($_POST['nomObjet'])))."','".$dir_pics.'/' .trim(strip_tags(htmlspecialchars($_SESSION["img"])))."','".trim(strip_tags(htmlspecialchars($_POST['description'])))."',NOW(),'".trim(strip_tags(htmlspecialchars($_SESSION['pseudo'])))."','".$_POST['nbJour']."','".$_POST['select']."');");
		//print_r($connexion->errorInfo());
		
		
		$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `image` LIKE '/".$_SESSION["img"]."'");
		$id=0;
		echo("coucou");
		while( $ligne = $resultats->fetch() )
		{
			$id = $ligne['id']; //  on recupere l'id de notre image
		}
		
		$_SESSION["collection"] = $_SESSION["collection"]." ".$id ; // on rajoute l'id dans l'array session collection
		$newcollection = $_SESSION["collection"] ;
		// echo(($newcollection));
		$connexion->exec("UPDATE `youssefablog`.`users` SET `collectionperso` = '".$newcollection."' WHERE `users`.`id` = ".$_SESSION["userid"].";"); // on met a jour la collection dans la bdd
		// print_r($connexion->errorInfo());
		
		echo 	'<script language="Javascript">
					document.location.replace("index.php");
				</script>';
	}

?>