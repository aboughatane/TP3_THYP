
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="css.css">
      <title>bdd images</title>
   </head>
   <body>

<div id="div">  
    <h1> Voici l'arborescence du dossier  </h1>
</div>
<center><table border="1" cellpadding="10" cellspacing="3">

<P>
<B> DEBUT DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>
<?php

// Fixer le temps maximum d'exécution à 500 secondes
set_time_limit (500);
$path= "docs";

// Fonction explorerDir permet d'explorer les dossiers et les sous-dossiers
explorerDir($path);

function explorerDir($path){
	// la variable folder va contenir un pointeur sur le dossier path qu'on a ouvert avec opendir()
	$folder = opendir($path);
	
	// la boucle tourne tant qu'on trouve un fichier dans le dossier
	while($entree = readdir($folder)){		
		// On exclu les arguments . & .. pour éviter que notre script change de dossier
		if($entree != "." && $entree != ".."){
			// vérifier que le dossier est un répertoire grace à la fonction is_dir()
			if(is_dir($path."/".$entree)){
				// On enregistre le path dans une autre variable sav_path
				$sav_path = $path;
				// on affecte "/".$entree a la valeur de path ce qui nous donne $path = $path. "/" .$entree
				$path .= "/".$entree;
				//	On rappelle la fonction explorerDir sur notre nouveau chemin $path		
				explorerDir($path);
				// On retourne a notre $path de base avant l'affectation
				$path = $sav_path;
			}
			else{
				// Dans cette partie on va afficher tout les elements dans path_source (seulement les images dans notre cas)
				$path_source = $path."/".$entree;	
				if (substr($path_source, -3) == "gif" ||
				substr($path_source, -3) == "jpg" ||
				substr($path_source, -3) == "png" ||
				substr($path_source, -4) == "jpeg" ||
				substr($path_source, -3) == "PNG" ||
				substr($path_source, -3) == "GIF" ||
				substr($path_source, -3) == "JPG")
				{ 
				?> 
				<tr>					
					<td> <?php echo nl2br("\n" .$path_source. "\n\n"); ?> </td>
					<td> <?php echo "<img src='$path_source' alt='image bdd' width='200' height='200'>"; ?> </td>
				</tr>
				<?php
				}			

			}
		}
	}
	closedir($folder);
}
?>
</table>
<P>
<B>FIN DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>

</body>
</html>