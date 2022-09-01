
			<!-- -------------------------------  No CONNECTED -------------------------- -->


<!-- Arrière plan FONCTION de la POSITION de NAVIGATION <img id="background" src="'.$dirUpload.$name_files[$user["fond"]].'" title=""></img> -->
		<?php
	
		 echo '
		<img id="background" src="'.$positionUser["fond"].'" title="Fond par défaut"/>
		';
		?>
		<!-- -->
			
			
		<!-- PAGE FIXE -->
	<div id="page" class="bordure"> 
			
			<script> window.onload=DisplayBlock('#zoneLogin')</script>
			<!-- MENU déroulant GESTION des PARAMETRE + PROFIL -->
			<div id="menu" class="boite1 haut droite largeur1 hauteur1 bordure">
				MENU
			</div>
			<!-- -->
			
			<!-- FLECHE NAVIGATION dirige en FONCTION de la POS de NAV -->
			<?php include("INC/Sarrows.inc.php");?>
			<!-- APERCU des DESTINATIONS possibles FONC de la POS de NAV -->
			<img src="<?php echo $positionMini["H"] ?>" id="apercuH" class="boite2 haut gauche5 largeur3 hauteur2 bordure" title="Aperçu de la destination en haut"></img>
			<img src="<?php echo $positionMini["D"] ?>" id="apercuD" class="boite2 droite haut5 largeur2 hauteur3 bordure" title="Aperçu de la destination à droite"></img>
			<img src="<?php echo $positionMini["B"] ?>" id="apercuB" class="boite2 bas gauche5 largeur3 hauteur2 bordure"  title="Aperçu de la destination en bas"></img>
			<img src="<?php echo $positionMini["G"] ?>" id="apercuG" class="boite2 gauche haut5 largeur2 hauteur3 bordure" title="Aperçu de la destination à gauche"></img>
			<!-- -->
			
			<!-- LOGIN SSI non logué ou demande de deconnexion -->
			<div id="zoneLogin" class="boite4 haut4 gauche4 largeur4 hauteur4 bordure fondNoir">
				<?php	
					   // Zone de connexion
							//FORMULAIRE
								//echo '<p>Bonjour, Wellcome sur la plateforme ArroWard.</p>';
								include("INC/formRegister.inc.php");
								include("INC/rapportRegister.inc.php");
					
								include("INC/formConnexion.inc.php");
								include("INC/rapportConnexion.inc.php");
							
					  ?>
					  
			</div>
			
			
			<!-- INFOS -->
			<!-- LIKES -->
			<div id="nbLikes" class="boite2 bas droite largeur1 hauteur1 bordure">
				<p>
				<?php echo 'Likes : <br/>'.$positionUser["likes"]; ?> 
				</p>
			</div>
			<!-- -->
			<!-- VUES -->
			<div id="nbVues" class="boite2 bas largeur1 hauteur1 bordure">
				<p>
				<?php echo 'Vues : <br/>'.$positionUser["vues"]; ?> 
				</p>
			</div>
			<a id="boutonFile" class="boite3 largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneDFile')">
					Type File
			</a>
			<!-- -->
			
	</div>
	<!-- FIN PAGE 1 : environnement principal -->
			
<!-- ------------------------------- Fin No CONNECTED -------------------------- -->
		

