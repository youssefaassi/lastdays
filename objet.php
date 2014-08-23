<?php
session_start();
include 'connexion.bdd.php';?>

<html>
<head>
	<title>Modifier Objet | LastDays</title>
	<meta charset='utf-8'>
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
						<li><a href="profil.view.php">Mon Profil</a></li>
						<li><a href="objet.view.php">Mes Objets</a></li>
						<li><a href="logout.php">Se deconnecter</a></li>
					</ul>
				</li>
			</ul>
	</div>
	<form class="modifobj" id="login" action="modif.objet.php?id=<?php echo $_GET["id"]; ?>" method="post" accept-charset="UTF-8">
		<fieldset>
			<ol>
				<?php
				$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `id` = ".$_GET['id']."");
				$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet
				$url="";
				$jour=0;
				$cat=0;
				$nomObjet="";
				$description="";
				while( $ligne = $resultats->fetch() )
				{
				$id = $ligne->id;
				$url = $ligne->image;
				$jour = $ligne->jour;
				$nomObjet = $ligne->titre;
				$description = $ligne->description;
				$cat = $ligne->categorie;
				}
				function testJour($_num)
				{
				global $jour;
				if ($_num==$jour)
					return true;
				else
					return false;
				}
				function testCat($_num)
				{
				global $cat;
				if ($_num==$cat)
					return true;
				else
					return false;
				}
				?>
				<li>
					<label for="nomObjet">Nom de l'objet :</label>
					<input type="text" name="nomObjet" id="nomObjet" value="<?php echo $nomObjet ?>">
					<span class="errorobj"><?php echo($errors["nomObjet"] )?></span>
				</li>
				
				<li><label for="nbJour">Chance de survie:</label>						
					<select name="nbJour">
						<option value="0" <?php if (testJour(0)) echo("selected");?> >-5 Jours</option> 
						<option value="1" <?php if (testJour(1)) echo("selected");?> >-4 Jours</option>
						<option value="2" <?php if (testJour(2)) echo("selected");?> >-3 Jours</option>
						<option value="3" <?php if (testJour(3)) echo("selected");?> >-2 Jours</option>
						<option value="4" <?php if (testJour(4)) echo("selected");?> >-1 Jour</option>
						<option value="5" <?php if (testJour(5)) echo("selected");?> >0 Jours</option>
						<option value="6" <?php if (testJour(6)) echo("selected");?> >1 Jour</option>
						<option value="7" <?php if (testJour(7)) echo("selected");?> >2 Jours</option>
						<option value="8" <?php if (testJour(8)) echo("selected");?> >3 Jours</option>
						<option value="9" <?php if (testJour(9)) echo("selected");?> >4 Jours</option>
						<option value="10" <?php if (testJour(10)) echo("selected");?> >5 Jours</option>
					</select>
				</li>
										
						<li class="cat"><label for="select">Catégorie:</label>
							<select name="select">
							  <option value="0" <?php if (testCat(0)) echo("selected");?> >Arme</option> 
							  <option value="1" <?php if (testCat(1)) echo("selected");?> >Nourriture</option>
							  <option value="2" <?php if (testCat(2)) echo("selected");?> >Outil</option>
							  <option value="3" <?php if (testCat(3)) echo("selected");?> >Soin</option>
							  <option value="4" <?php if (testCat(4)) echo("selected");?> >Savoir</option>
							  <option value="5" <?php if (testCat(5)) echo("selected");?> >Pnj</option>
							  <option value="6" <?php if (testCat(6)) echo("selected");?> >Autre</option>
							</select>
						</li>
						
						<li>
							<label for="description">Utilisation:</label><textarea rows="4" cols="26" name="description" id="description"  placeholder="Ex: Vous mangez un champignon. Pas de chance, il était vénéneux." required="required"><?php echo $description ?></textarea>
							<span class="error"><?php echo($_SESSION["bugDescription"] );?></span>
						</li>
						<li class="clear"><input type="submit" name="modifObjet" value="Modifier l'objet"></li>
						<li class="cancel"><input type="submit" name="supprimer" value="Supprimer l'objet"></li>
					</ol>
						<li class="imgobj"><img src="<?php echo substr($url , 1) ?>" width="500"/></li>
				</fieldset>
</form>