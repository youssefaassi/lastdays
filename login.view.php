<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Connexion | LastDays</title>
</head>

<body>
	<h1 id="logologin"><a href="index.php">LastDays</a></h1>
<?php
	if(!empty($_SESSION['babaye'])){
		echo '<h1 class="babaye">'.$_SESSION['babaye'].'</h1>';
		$_SESSION['babaye']=null;
	}
?>
    <form class="formlogin" id="login" action="" method="post" accept-charset='UTF-8'>
        <fieldset>
            <legend class="title">Connexion</legend>
			<ol>
				<li class="errorune"><?php echo($errors["fauxpseudo"] ); ?></li>
				<li class="errorune"><?php echo($errors["fauxpass"] ); ?></li>
                <li>
					<input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST["pseudo"];?>" placeholder="Pseudo">
					<span class="error"><?php echo($errors["pseudo"] ); ?></span>
				</li>
                <li>
					<input type="password" name="pass" id="pass" placeholder="Mot de passe">
					<span class="error"><?php echo($errors["pass"] ); ?></span>
				</li>       
				
                <li><input type="submit" name="connexion" value="Me connecter"></li>
				                
                <li class="creercompte"><input type="submit" name="creer" value="Tu n'as pas encore de compte?"></li>
				
            </ol>

        </fieldset>
    </form>
	<a class="credits" href="credits.html">Crédits</a>
</body>
</html>