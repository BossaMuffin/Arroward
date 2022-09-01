<?php 
if ($sessionType == 1){
	//CONNECTE 
	//FLECHE NAV que si USER LIKE POS ou si USER sur SA POS
			$x='';
			$req_like = "SELECT id FROM Tlikes WHERE id_env = '".$user["id"]."' AND id_rec = '".$positionUser["pos"]."'";
				  if ($recherche_infos = $bdd->query($req_like)){	
						$x=0;
						while ($recherche_infos->fetch(PDO::FETCH_ASSOC)){
						$x++;
						}
						$recherche_infos ->closeCursor();
					}
					if ($x!= '' OR $positionUser["pos"]==$user["id"]){
			?>
			<!-- FLECHE NAVIGATION dirige en FONCTION de la POS de NAV -->
			<div id="flecheH" class="boite3 haut gauche2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiH"];?>"><?php echo 'Voir : '.$positionUser['AmiH']; ?></a></div>
			<div id="flecheD" class="boite3 droite haut2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiD"];?>"><?php echo 'Voir : '.$positionUser['AmiD']; ?></a></div>
			<div id="flecheB" class="boite3 bas gauche2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiB"];?>"><?php echo 'Voir : '.$positionUser['AmiB']; ?></a></div>
			<div id="flecheG" class="boite3 gauche haut2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiG"];?>"><?php echo 'Voir : '.$positionUser['AmiG']; ?></a></div>
			<!-- -->
			<?php } 
}
else { //NON CONNECTE ?>
	
			<!-- FLECHE NAVIGATION dirige en FONCTION de la POS de NAV -->
			<div id="flecheH" class="boite3 haut gauche2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiH"];?>"><?php echo 'Voir : '.$positionUser['AmiH']; ?></a></div>
			<div id="flecheD" class="boite3 droite haut2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiD"];?>"><?php echo 'Voir : '.$positionUser['AmiD']; ?></a></div>
			<div id="flecheB" class="boite3 bas gauche2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiB"];?>"><?php echo 'Voir : '.$positionUser['AmiB']; ?></a></div>
			<div id="flecheG" class="boite3 gauche haut2 largeur1 hauteur1 bordure fondNoir"><a href="<?php echo 'index.php?pos='.$positionUser["AmiG"];?>"><?php echo 'Voir : '.$positionUser['AmiG']; ?></a></div>
<?php }
