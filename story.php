<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Connexion | LastDays</title>
</head>

<body>
<?php
include("connexion.bdd.php");
echo '<link rel="stylesheet" type="text/css" href="css/style.css">'; // css
echo '<link href="http://fonts.googleapis.com/css?family=Lora" rel="stylesheet" type="text/css">'; // font
echo '<div id="containerstory">';
echo '<h1 id="logostory"><a href="index.php">Logo.</a></h1>';
$arCollection = explode(" ",$_SESSION["collection"]);
$total=0;
for ($i=0; $i<sizeof($arCollection); $i++)
{
	if ($arCollection[$i]!="")
	{
		$resultats=$connexion->query("SELECT * FROM `Collection` WHERE `id` LIKE '".$arCollection[$i]."'"); 
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		while( $ligne = $resultats->fetch() )
		{
			$titre = $ligne->titre;
			$url = substr($ligne->image,1);
			$description = $ligne->description;
			$jours = $ligne->jour-5;
			$total+=$jours;
			echo'<h2 class="storytitle">'.$titre.'</h2>';
			echo'<img class="storyimg" src="'.$url.'"/>';
			echo'<p class="story desc">'.str_replace("\n", "</br></br>", $description).'</p>';
			if ($jours==1)
				echo '<p class="gain">Vous gagnez <span>1 jour</span> de survie.</p><br/><hr/><br/>';
			elseif ($jours>1)
				echo '<p class="gain">Vous gagnez <span>'.$jours.'</span>  jours de survie.</p><br/><hr/><br/>';
			elseif ($jours==0)
				echo '<p class="gain">Il ne se passe rien. Vous ne gagnez pas de jours de survie.</p><br/><hr/><br/>';
			elseif ($jours==-1)
				echo '<p class="gain">Vous perdez <span>1 jour</span> de survie.</p><br/><hr/><br/>';
			else
			{
				$jours = -$jours;
				echo'<p class="gain">Vous perdez <span>'.$jours.'</span> jours de survie.</p><br/><hr/><br/>';
			}
			break;
		}
	}
}
if ($total<0) $total=0;

if ($total==1 || $total==0)
echo '<p class="storysurv">Vous survivez</p> <p class="total">'.$total.'</p> <p class="totjour"> jour.</p><br/><br/>';
elseif ($total>0)
echo '<div id="end"><p>Vous survivez</p> <p class="total">'.$total.'</p> <p class="totjour"> jours.</p></div>';
echo '</div>';
?>
</body>
</html>