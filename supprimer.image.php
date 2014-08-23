<?php
session_start();
include 'connexion.bdd.php';

$url;
$collection = explode(" ", $_SESSION["collection"]); // $collection  = tableau qui contientra les id des images de l'utilisateur
if ($collection!=null)
{
	if ($collection[0]!=null && sizeof($collection)==1)
		$collection = array($_SESSION["collection"]);
	
	$newcollection="";
	for ($i=0; $i<sizeof($collection); $i++) // pour chaque image de l'utilisateur
	{
		$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `id` = ".$collection[$i]." ORDER BY `id` DESC"); // on test la bdd

		if ($resultats!=null)
		{
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			$boIdExist=false;
			while( $ligne = $resultats->fetch() ) // 
			{
				$url=$ligne->image;
				if ($ligne->id == $collection[$i] )
					$boIdExist=true;
			}
			
			if ($boIdExist!=false) //si l'id existe encore
			{
				if ($collection[$i]!="")
				{
					$newcollection.=(" ".$collection[$i]); // on reécrit
				}
			}
		}
	}
	$_SESSION["collection"] = $newcollection;
}
unlink( substr($url, 1));
 $connexion->exec("DELETE FROM `youssefablog`.`Collection` WHERE `Collection`.`id` = ".$_POST["imageid"]); // on met a jour la collection dans la bdd

?>