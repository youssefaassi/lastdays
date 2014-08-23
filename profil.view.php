<?php
session_start();
include 'connexion.bdd.php';
	$resultats=$connexion->query("SELECT * FROM `users` WHERE `pseudo` LIKE '".$_SESSION["pseudo"]."'"); // on test la bdd
		// print_r("result : ".$resultats);
		// print_r($connexion->errorInfo());
	$resultats->setFetchMode(PDO::FETCH_OBJ); 
		while( $ligne = $resultats->fetch() ) // 
		{
			$pseudo = $ligne->pseudo;
			$pass = $ligne->pass;
			$mail = $ligne->email;
		}
?>
<html>
<head>
<meta charset='utf-8'>
	<title>Profil | LastDays</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="http://fonts.googleapis.com/css?family=Lora" rel="stylesheet" type="text/css">
	<script src="js/masonry.pkgd.min.js"></script>
</head>
<body>

	<div id="header">
			<ul id="header-inner">
				<li class="floatleft">
					<?php 
						echo '<h1 class="user" class="floathead"><a href="index.php">Accueil</a></h1>';
					?>
				</li>
				<li id="logo" class="center"><a href="index.php">LastDays</a></li>
				<li class="floatright">
					<ul>
						<li><a href="profil.view.php" class="checked">Mon Profil</a></li>
						<li><a href="objet.view.php">Mes Objets</a></li>
						<li><a href="logout.php">Se deconnecter</a></li>
					</ul>
				</li>
			</ul>
	</div>
	<form class="formprofil" id="login" action="profil.php" method="post" accept-charset='UTF-8'>
		<fieldset>
			<legend class="title">Mon Profil</legend>
			<ol>
				<li>
					<input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo'];?>">
					<span class="error"><?php echo($errors["pseudo"] ); ?></span>
				</li>
				<li>
					<input type="text" name="pass" id="pass" value="<?php echo $pass ;?>" placeholder="Mot de passe">
					<span class="error"><?php echo($errors["pass"] ); ?></span>
				</li>
				<li>
					<input type="text" name="email" id="email" value="<?php echo $mail ;?>"  >
					<span class="error"><?php echo($errors["email"] ); ?></span>
				</li>
								
				<li class="modcompte"><input type="submit" name="modifier" value="Modifier le profil"></li>
				<li class="suppcompte"><input type="submit" name="supprimer" value="Supprimer le profil"></li>
			</ol>
		</fieldset>
	</form>