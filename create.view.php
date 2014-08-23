<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset='utf-8'>
<title>Creer un compte | LastDays</title>
</head>

<body>
	<h1 id="logologin"><a href="index.php">LastDays</a></h1>
    <form class="formcreate" id="login" action="" method="post" accept-charset='UTF-8'>
        <fieldset>
            <legend class="title">Creer un compte</legend>
            <ol>
                <li>
					<input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST["pseudo"];?>" placeholder="Pseudo">
					<span class="error"><?php echo($errors["pseudo"] ); ?></span>
				</li>
                <li>
					<input type="password" name="pass" id="pass" placeholder="Mot de passe" >
					<span class="error"><?php echo($errors["pass"] ); ?></span>
				</li>
                <li>
					<input type="text" name="email" id="email"  placeholder="Ton@email.com" >
					<span class="error"><?php echo($errors["email"] ); ?></span>
				</li>
				                
                <li><input type="submit" name="creer2" value="Creer"></li>
                <li class="login"><input type="submit" name="login" value="Tu as déjà un compte?"></li>
            </ol>
        </fieldset>
    </form>
</body>
</html>