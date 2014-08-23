<?php
	$PARAM_hote='mysql51-101.perso'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='youssefablog'; // le nom de votre base de données
	$PARAM_utilisateur='youssefablog'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe='youyoussef1'; // mot de passe de l'utilisateur pour se connecter
	$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
?>