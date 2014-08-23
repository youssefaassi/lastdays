<?php
//protection zone membre
session_start();
// we first include the upload class, as we will need it here to deal with the uploaded file
include('categories.php');
?>
<html>
<head>
<meta charset='utf-8'>
	<title>Accueil | LastDays</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/jquery-scrolltofixed-min.js"></script>
	<script src="http://masonry.desandro.com/masonry.pkgd.js"></script>
</head>
<body>
	<div id="header">
			<ul id="header-inner">
				<li class="floatleft">
					<?php 
						echo '<h1 class="user" class="floathead">Bonjour '.$_SESSION["pseudo"].' !</h1>';
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
	<div id="formajout_clos">
		<div class="btnajout">
			<div class="ouvrir">+<span>Ajouter un objet</span></div>
			<div class="fermer display">x</div>
		</div>
		<div class="bgeee">
			<div id="formajout" class="petit">
				<div id="cache">
					<p id="instruc">Glisser et déposer une image, puis cliquer sur 'charger'</p>
					<form name="form5" enctype="multipart/form-data" method="post" action="#">
					
						<p><input type="file" size="32" name="my_field" value="" id="dnd_field" /></p>
						<div id="dnd_drag">... déposez vos fichiers ici ...</div>
						<div id="dnd_status"></div>
						<p class="button">
							<input type="hidden" name="action" value="xhr" />
							<input type="submit" name="Submit" value="Charger" id="dnd_upload"/>
						</p>
					</form>
					<div id="dnd_result"></div>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php
		$collection = explode(" ", $_SESSION["collection"]); // $collection  = tableau qui contientra les id des images de l'utilisateur
		if ($collection!=null)
		{
			if ($collection[0]!=null && sizeof($collection)==1)
				$collection = array($_SESSION["collection"]);
			
			
			// print_r($collection);
			// echo ($_SESSION["collection"]);
			// echo ($_SESSION["collection"]);
			
			echo '
			<div id="kit">
				<span id="bgheadlist"></span>
				<ul class="liste_objet">
					<li class="headlist">
						<h2>Mon Kit de survie<span id="msgmaximg" class="msgmax">Vous avez atteint le maximum d\'objets</span></h2>
					</li>';
			
			$collection = explode(" ", $_SESSION["collection"]); // $collection  = tableau qui contientra les id des images de l'utilisateur
			if ($collection!=null)
			{
				if ($collection[0]!=null && sizeof($collection)==1)
					$collection = array($_SESSION["collection"]);
			}
			for ($i=0; $i<sizeof($collection); $i++) // pour chaque image de l'utilisateur
			{
				$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `id` = ".$collection[$i]." ORDER BY `id` DESC"); // on test la bdd
				// print_r("result : ".$resultats);
				// print_r($connexion->errorInfo());
				if ($resultats!=null)
				{
					$resultats->setFetchMode(PDO::FETCH_OBJ); 
					while( $ligne = $resultats->fetch() ) // 
					{
						$image = $ligne->image;
						$id = $ligne->id;
						$cat = $ligne->categorie;
						echo '
						<li class="listkit">
								<span class="removecollection" value="'.$id.'">-</span>
								<img src="'.substr($image, 1).'" height="90" value="'.$id.'" class="'.$AR_CAT[$cat].'"/>
						</li>';
					}
				}
			}
			echo '
					<a href="story.php" id="story">Commencer<br>la survie</a></ul></div>';
			
			
			?>
			
			<div id="maxwidth">
				<div id="head-container">
					<h2>Remplissez votre kit <br>et tentez de survivre</h2>
					<p>Selectionnez des objets parmi la collection.</p>
					<p>- 7 objets maximum -</p>
				</div>
				<section class="ff-container">
				
					<input id="select-type-all" name="radio-set-1" type="radio" class="ff-selector-type-all" checked="checked" />
					<label for="select-type-all" class="ff-label-type-all fixed">Tout</label>
					
					<input id="select-type-0" name="radio-set-1" type="radio" class="ff-selector-type-0" />
					<label for="select-type-0" class="ff-label-type-0 fixed-0">Arme</label>
					
					<input id="select-type-1" name="radio-set-1" type="radio" class="ff-selector-type-1" />
					<label for="select-type-1" class="ff-label-type-1 fixed-1">Nourriture</label>
					
					<input id="select-type-2" name="radio-set-1" type="radio" class="ff-selector-type-2" />
					<label for="select-type-2" class="ff-label-type-2 fixed-2">Outil</label>
					
					<input id="select-type-3" name="radio-set-1" type="radio" class="ff-selector-type-3" />
					<label for="select-type-3" class="ff-label-type-3 fixed-3">Soin</label>
					
					<input id="select-type-4" name="radio-set-1" type="radio" class="ff-selector-type-4" />
					<label for="select-type-4" class="ff-label-type-4 fixed-4">Savoir</label>
					
					<input id="select-type-5" name="radio-set-1" type="radio" class="ff-selector-type-5" />
					<label for="select-type-5" class="ff-label-type-5 fixed-5">PNJ</label>
					
					<input id="select-type-6" name="radio-set-1" type="radio" class="ff-selector-type-6" />
					<label for="select-type-6" class="ff-label-type-6 fixed-6">Autre</label>
					
				<div class="masonry js-masonry liste_objet_all ff-items"  data-masonry-options='{ "isFitWidth": true }'>
				<?php
				$resultats=$connexion->query("SELECT * FROM `Collection`"); // on test la bdd
				// print_r("result : ".$resultats);
				$resultats->setFetchMode(PDO::FETCH_OBJ); 
				while( $ligne = $resultats->fetch() ) // 
				{
					$image = $ligne->image;
					$id = $ligne->id;
					$cat = $ligne->categorie;
					$user = $ligne->user;
					$titre = $ligne->titre;
					// if ($ligne->user == $_SESSION["pseudo"])
					// {
						echo '<div class="item ff-item-type-'.$cat.'">';
							echo'
								<div id="vignette">
								<img src="'.substr($image, 1).'" width="235" value="'.$id.'"  class="'.$AR_CAT[$cat].'"/>
								</div>';
							echo'<div id="overlay">
									<h2>'.$titre.'</h2>
									<hr>
									<p>posté par '.($user).'</p>
									<span class="addcollection" value="'.($id).'">+ Ajouter à votre<br> kit de survie</span>
								</div>';
						echo('</div>');
					// }
				} 
				?>
				</div>
				</section>
			</div>
			<?php
		}
	
	?>

    <script type="text/javascript">

	$(document).ready(function(){
    // window.onload = function () {
	// $('.ff-container').imagesLoaded(function(){
				// $('.ff-container').masonry();
			// });
      var xhr = new XMLHttpRequest();

      function xhr_send(f, e) {
        if (f) {
          xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
              document.getElementById(e).innerHTML = xhr.responseText;
            }
          }
		  
          xhr.open("POST", "upload.php?action=xhr");
          xhr.setRequestHeader("Cache-Control", "no-cache");
          xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
          xhr.setRequestHeader("X-File-Name", f.name);
          xhr.send(f);
        }
      }

      function xhr_parse(f, e) {
        if (f) {
          document.getElementById(e).innerHTML = "Fichier selectionné : " + f.name + "(" + f.type + ", " + f.size + ")";
        } else {
          document.getElementById(e).innerHTML = "Pas de fichier selectionné!";
        }
      }	

      function dnd_hover(e) {
        e.stopPropagation();
        e.preventDefault();
        e.target.className = (e.type == "dragover" ? "hover" : "");  
      }

      if (xhr && window.File && window.FileList) {

        // drag and drop example
        var dnd_file = null; 
        document.getElementById("dnd_drag").style.display = "block";
        document.getElementById("dnd_field").style.display = "none";
        document.getElementById("dnd_drag").ondragover = function (e) {
          dnd_hover(e);
        }
        document.getElementById("dnd_drag").ondragleave = function (e) {
          dnd_hover(e);
        }
        document.getElementById("dnd_drag").ondrop = function (e) {
          dnd_hover(e);
          var files = e.target.files || e.dataTransfer.files;
          dnd_file = files[0];
          xhr_parse(dnd_file, "dnd_status");
        }
        document.getElementById("dnd_field").onchange = function (e) {
          dnd_file = this.files[0];
          xhr_parse(dnd_file, "dnd_status");
        }
		
        document.getElementById("dnd_upload").onclick = function (e) {
          e.preventDefault();
          xhr_send(dnd_file, "dnd_result");
        }
		

      }
	  
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
			  document.location.replace("index.php");
			});
			 
			request.fail(function( jqXHR, textStatus ) {
			  console.log( "Request failed: " + textStatus );
			});
			  // document.location.replace("decocher.image.php?imageid=" + id);
		}
		
		
		$( ".ouvrir" ).click(function() {
			$( "#formajout" ).addClass("grand").removeClass("petit");
			$(this).addClass("display");
			$(".fermer").removeClass("display");
			return false;
		});
		
		$( ".fermer" ).click(function() {
			$( "#formajout" ).addClass("petit").removeClass("grand");
			$(this).addClass("display");
			$(".ouvrir").removeClass("display");
			return false;
		});
		$(".fixed").scrollToFixed({ marginTop: 100 });
		$(".fixed-0").scrollToFixed({ marginTop: 140 });
		$(".fixed-1").scrollToFixed({ marginTop: 190 });
		$(".fixed-2").scrollToFixed({ marginTop: 240 });
		$(".fixed-3").scrollToFixed({ marginTop: 290 });
		$(".fixed-4").scrollToFixed({ marginTop: 340 });
		$(".fixed-5").scrollToFixed({ marginTop: 390 });
		$(".fixed-6").scrollToFixed({ marginTop: 440 });
		// $(".imgopa").mouseenter(
		  // function() {
			// $(this).addClass('opacity');
		// });
		// $(".imgopa").mouseleave(
		  // function() {
			// $(this).removeClass('opacity');
		// });
		function scrollModif() {
		console.log($("body").scrollTop());
		if ($("body").scrollTop() > 139)
			{
			$(".fixed").css("top" , "50px");
			$(".fixed-0").css("top" , "50px");
			$(".fixed-1").css("top" , "50px");
			$(".fixed-2").css("top" , "50px");
			$(".fixed-3").css("top" , "50px");
			$(".fixed-4").css("top" , "50px");
			$(".fixed-5").css("top" , "50px");
			$(".fixed-6").css("top" , "50px");
			}
		else if($("body").scrollTop() < 140)
			{
			$(".fixed-0").css("margin-top" , "90px");
			$(".fixed-1").css("margin-top" , "140px");
			$(".fixed-2").css("margin-top" , "190px");
			$(".fixed-3").css("margin-top" , "240px");
			$(".fixed-4").css("margin-top" , "290px");
			$(".fixed-5").css("margin-top" , "340px");
			$(".fixed-6	").css("margin-top" , "390px");
			}
		}
		$( window ).scroll(scrollModif);
    });
    </script>	
</body>
</html>