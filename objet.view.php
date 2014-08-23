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
	<title>Mes Objets | LastDays</title>
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
						<li><a href="objet.view.php" class="checked">Mes Objets</a></li>
						<li><a href="logout.php">Se deconnecter</a></li>
					</ul>
				</li>
			</ul>
	</div>
<?php 


	if($_GET['msg']!=null)
	{
		$msg="";
		if($_GET['msg']=="modif")
		{
			$msg =  "l'objet a été modifié";
		}
		if($_GET['msg']=="delete")
		{
			$msg =  "l'objet a été supprimé";
		}
		echo $msg;
	}
echo '<a href="index.php">Retour à la page d\'accueil.</a>';
echo '<h1 id="titleobjet">Mes objets</h1>
<div class=containerobj>
<div class="masonry js-masonry liste_objet_all" id="masonrydeux"  data-masonry-options=\'{ "isFitWidth": true }\'>';
$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `user` = '".$_SESSION["pseudo"]."'"); // on test la bdd
// print_r("result : ".$resultats);
$resultats->setFetchMode(PDO::FETCH_OBJ); 
while( $ligne = $resultats->fetch() ) // 
{
	$image = $ligne->image;
	$id = $ligne->id;
	$cat = $ligne->categorie;
	echo '
	<div class="listkit">';
		echo'<a href="objet.php?id='.$id.'">
			<img src="'.substr($image, 1).'" width="300" value="'.$id.'"  class="'.$AR_CAT[$cat].'"/>
		</a>
		<span class="deletecollection" value="'.$id.'" >Supprimer l\'objet.</span>
	</div>';
} 
echo '</div></div>';
?>

   <script type="text/javascript">

    window.onload = function () {

	  
		$( ".addcollection" ).click(addImg);
		
		function addImg(_e)
		{
			var id = $(_e.target).attr("value"); // id de notre image
			
			var request = $.ajax({
			  url: "cocher.image.php",
			  type: "POST",
			  data: { imageid : id },
			  dataType: "html"
			});
			 
			request.done(function(_msg ) {
				if (_msg!="max")
					document.location.replace("index.php");
				else
					$("#msgmaximg").css("display", "inline");
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  console.log( "Request failed: " + textStatus );
			});
			  // document.location.replace("cocher.image.php?imageid=" + id);
		}
		
		$( ".removecollection" ).click(removeImg);
		
		function removeImg(_e)
		{
			var id = $(_e.target).attr("value"); // id de notre image
			
			var request = $.ajax({
			  url: "decocher.image.php",
			  type: "POST",
			  data: { imageid : id },
			  dataType: "html"
			});
			 
			request.done(function(_msg ) {
			  document.location.replace("index.php");
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  console.log( "Request failed: " + textStatus );
			});
			  // document.location.replace("decocher.image.php?imageid=" + id);
		}
		
		$( ".deletecollection" ).click(deleteImg);
		
		function deleteImg(_e)
		{
			var id = $(_e.target).attr("value"); // id de notre image
			
			var request = $.ajax({
			  url: "supprimer.image.php",
			  type: "POST",
			  data: { imageid : id },
			  dataType: "html"
			});
			 
			request.done(function(_msg ) {
			  document.location.replace("objet.view.php");
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  console.log( "Request failed: " + textStatus );
			});
			  // document.location.replace("decocher.image.php?imageid=" + id);
		}
		
		
    }
    </script>	