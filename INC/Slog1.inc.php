


<!-- ------------------------------- SSI CONNECTED -------------------------- -->


<!-- Arrière plan FONCTION de la POSITION de NAVIGATION <img id="background" src="'.$dirUpload.$name_files[$user["fond"]].'" title=""></img> -->
		<?php
	
		 echo '
		<img id="background" src="'.$positionUser["fond"].'" title="Fond par défaut"/>
		';
		?>
		<!-- -->
		
	
			
		<!-- Environnement AUTOUR -->

<!-- PAGE FIXE -->
		<div id="page" class="bordure"> 

			<!-- ZONE DEMANDES de connexion/amis -->
			
	<!-- demandes RECUES apercue de letat-->
				<div id="demandeRec" class="boite1 haut gauche largeur2 hauteur2 demandes bordure fondNoir">
					<?php if (isset($accept_demande_alert)){
						echo $accept_demande_alert.'<br/>';
					}
					?>
					<p>Demandes reçues : </p>
					<?php 
					$i=1 ; 
					while($i<$nbRec+1){ 
						if ($user["demande"]["rec"][$i]["etat"] ==2){
								echo $user["demande"]["rec"][$i]["id"]; 
								echo '<form action="#" name="gestion_demande_rec" method="post">
											<input type="hidden" name="gestion_demande" value="'.$user["demande"]["rec"][$i]["id"].'" />
											<input type="hidden" name="i_demande" value="'.$i.'" />
											<input type="submit" name="demande_accept" value="Accepter" />
											<input type="submit" name="demande_refuse" value="Refuser" />
											</form><br/>';
								
						}
						$i++;
					}
					?>
				</div>
				
	<!-- demandes ENVOYEES apercue de letat -->
				<div id="demandeEnv" class="boite1 bas gauche largeur2 hauteur2 demandes bordure fondNoir">
					<p>Demandes envoyées : </p>
					<?php 
					$i=1 ; 
					while($i<$nbEnv+1){ 
						if ($user["demande"]["env"][$i]["etat"] ==2 OR $user["demande"]["env"][$i]["etat"] ==0){
						echo $user["demande"]["env"][$i]["id"]; 
						echo '<form action="#" name="gestion_demande_env" method="post">
									<input type="hidden" name="gestion_demande" value="'.$user["demande"]["env"][$i]["id"].'" />
									<input type="hidden" name="i_demande" value="'.$i.'" />
									<input type="submit" name="demande_annule" value="Annuler" />
									</form><br/>';
						
						}
						$i++;
					}
					?>
				</div>
			
			<!-- -->
			
			<!--FLECHE NAV que si USER LIKE POS ou si USER sur SA POS -->
			<?php include("INC/Sarrows.inc.php");?>
			
			
			
<!-- CHATS avec les amis -->




	<!-- CHAT HAUT -->
			<?php 
			// TRAVAIL VARIABLE SSAGE
			include("INC/message.inc.php");
	
			
			/*on lui passe la varible */ 
			$chat_name = "chatH";
			echo '<div id="'.$chat_name.'" class="boite2 haut gauche1 largeur3 hauteur2 bordure fondNoir">';
			include("INC/Smessage.inc.php");
			echo '</div>';
			?>
	<!-- CHAT fin HAUT -->
			
	<!-- CHAT DROITE -->
			<?php /*on lui passe la varible */ 
			$chat_name = "chatD";		
			echo '<div id="'.$chat_name.'" class="boite2 droite haut1 largeur2 hauteur3 bordure fondNoir">';
			include("INC/Smessage.inc.php");
			echo '</div>';
			?>
	<!-- CHAT fin DROITE -->
	
	<!-- CHAT BAS -->
			<?php /*on lui passe la varible */ 
			$chat_name = "chatB";
			echo '<div id="'.$chat_name.'" class="boite2 bas droite1 largeur3 hauteur2 bordure fondNoir">';
			include("INC/Smessage.inc.php");
			echo '</div>';
			?>
	<!-- CHAT fin BAS -->
	
	<!-- CHAT GAUCHE -->
			<?php /*on lui passe la varible */ 
			$chat_name = "chatG";
			echo '<div id="'.$chat_name.'" class="boite2 gauche bas1 largeur2 hauteur3 bordure fondNoir">';
			include("INC/Smessage.inc.php");
			echo '</div>';
			?>
	<!-- CHAT fin GAUCHE -->
				
<!-- Fin CHAT -->

<!-- APERCU des DESTINATIONS possibles FONC de la POS de NAV -->
			<img src="<?php echo $positionMini["H"] ?>" id="apercuH" class="boite2 haut droite1 largeur3 hauteur2 bordure" title="Aperçu de la destination en haut"></img>
			<img src="<?php echo $positionMini["D"] ?>" id="apercuD" class="boite2 droite bas1 largeur2 hauteur3 bordure" title="Aperçu de la destination à droite"></img>
			<img src="<?php echo $positionMini["B"] ?>" id="apercuB" class="boite2 bas gauche1 largeur3 hauteur2 bordure" title="Aperçu de la destination en bas"></img>
			<img src="<?php echo $positionMini["G"] ?>" id="apercuG" class="boite2 gauche haut1 largeur2 hauteur3 bordure" title="Aperçu de la destination à gauche"></img>
			<!-- -->
			<!-- Environnement CENTRE -->
			<div id="zoneCentre" class="boite1 haut1 gauche1 hauteur6 largeur6 bordure">
			</div>
			<div id="textCentre" class="boite2 haut1 gauche1 hauteur6 largeur6 bordure">
				<p>
				<?php echo '<h1>USER  Pseudo : '.$user['pseudo'].' - ID : '.$user['id'].'</h1>
				<i>Nom</i> : <b>'.$user['nom'].'</b> - <i>Prenom</i> : <b>'.$user['prenom'].'</b><br/>
				User AMIS : <br/>
				- 1: '.$user['amis']['amiH'].'<br/> 
				- 2: '.$user['amis']['amiD'].'<br/>
				- 3: '.$user['amis']['amiB'].'<br/>
				- 4: '.$user['amis']['amiG'].'<br/>';
				
				echo '<h2>USER Position : '.$positionUser['pos'].' - Img Fond '.$positionUser["fond"].'</h2></br>';
			
				
				/* echo '<br/>'.$upload_target.' --  '.$file_crea.' '.$upload_target.'/'.$fond_user ;*/
				?> 
				</p>
				
			</div>
			
		<!-- Zone WYSI File -->
			<div id="zoneDFile" class="boite4 haut4 gauche4 largeur4 hauteur4 bordure fondNoir">
			<!--WYSIfile PARSER-->
				<a class="fermer largeur1 hauteur1 bordure" onClick="DisplayBlock('#zoneDFile')">X</a>
				<div id="zoneFile" class=""> 
					<h1><?php echo $user['pseudo']; ?></h1>
					<h3> Un WYSI feel ? </h3>
					<?php echo print $parser->getAsHtml(); echo '<br/> erreur : '.$erreur_file; ?>
				  <form action="INC/file.inc.php" name="file_form" method="post">
					 <textarea id="wysifile" name="wysifile_text">My text</textarea>
					<input type="submit" name="file_submit" value="Affiche" />
				  </form>
				</div>
						
			</div>
		
			 <!-- -->
			
			<!-- demande de deconnexion -->
			<div id="zoneDLogin" class="boite4 haut4 gauche4 largeur4 hauteur4 bordure fondNoir">
	<!--DECONEX -->
				<a class="fermer largeur1 hauteur1 bordure" onClick="DisplayBlock('#zoneDLogin')">X</a>
				<div id="deconex" class=""> 
					<h1><?php echo $user['pseudo']; ?></h1>
					<h3> Souhaitez-vous vous déconnecter ?  </h3>
					<p>
						
					</p>
				  <form action="#" name="deconnexion" method="post">
					<input type="submit" name="deconex" value="Se déconnecter" />
				  </form>
				</div>
				
			</div>
		
			 <!-- -->
			 
			 
	<!-- UPLOAD SSI logué et demande de changement -->
			<div id="zoneUpload" class="boite3 haut4 gauche4 largeur4 hauteur4 bordure fondNoir">
			<a class="fermer largeur1 hauteur1 bordure" onClick="DisplayBlock('#zoneUpload')">X</a>
				<?php
				/* Permet de charger une image de fond */
				include("INC/formUpload.inc.php");
				?>
			</div>
			
	<!-- LIKER SSI logué et POS NAV EXT -->
			<div id="boutonLike" class="boite3 haut2 gauche3 largeur1 hauteur1 bordure fondNoir">
				<form action="#" name="liker" method="post">
					<input type="hidden" name="posID" value="<?php echo $positionUser["pos"];?>" />
					<input type="submit" name="like" value="Liker" />
				  </form>
				  <?php echo $like_demande_alert;?>
			</div>
			
			
			
	<!-- LISTE DES MEMBRES -->
			<div id="zoneDMembres" class="boite4 haut4 gauche4 largeur4 hauteur4 bordure fondNoir">
				<!--Tri MEMBRES -->
				<a class="fermer largeur1 hauteur1 bordure" onClick="DisplayBlock('#zoneDMembres')">X</a>
				<div id="" class=""> 
					<h1><?php echo $user['pseudo']; ?></h1>
					<p><?php if (isset($env_demande_alert)){echo $env_demande_alert;}?></p>
					<h3> Listes des Membres  </h3>
					<?php $recherche_membres = "SELECT pseudo, id FROM Tusers WHERE id != '".$user['id']."'";
					  if ($recherche_infos = $bdd->query($recherche_membres)){
						  
						  while ($infos_membre = $recherche_infos->fetch(PDO::FETCH_ASSOC)){
						 
							$membre = [
								"id" 	=> $infos_membre['id'],
								"pseudo" 	=> $infos_membre['pseudo'],
								];
								
								echo 'friends please ! -> '.$infos_membre['pseudo'].' ? ';
								echo '<form action="#" name="demande" method="post">
										<input type="hidden" name="ami" value="'.$infos_membre['id'].'" />
										<input type="submit" name="demande" value="Ajouter" />
										</form><br/>';
							}
						 $recherche_infos ->closeCursor();
							
							//	exit('ok  affichage infoMembre sql '.print_r($membre['id']));
							
						}
						?>
						<!--
				  <form action="#" name="deconnexion" method="post">
					<input type="submit" name="deconex" value="Se déconnecter" />
				  </form>
				  -->
				</div>
				
			</div>
			 <!-- -->
			 
			 
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
			<!-- -->
			
			
			
	<!-- Retour Position -->
			<div id="retourPosition" class="boite2 haut2 droite3 largeur1 hauteur1 bordure fondNoir">
				<a href="<?php echo 'index.php?pos='.$user['id'];?>">Home</a>
			</div>
			
<!-- MENU en H - D display les boutons -->
			<a id="boutonMenu" class="boite3 haut droite largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneMenu')">
				MENU
			</a>
			<div id="zoneMenu" >
				<a id="boutonMembres" class="boite3 largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneDMembres')">
					Membres
				</a>
				<!-- CHANGER LE Fond SSI logué et POS NAV INT -->
				<a id="boutonFond" class="boite3 largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneUpload')">
					Change Fond
				</a>
				<a id="boutonFile" class="boite3 largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneDFile')">
					Type File
				</a>
				<a id="boutonDeconex" class="boite3 largeur1 hauteur1 bordure fondNoir" onClick="DisplayBlock('#zoneDLogin')">
					Déconexion
				</a>
			</div>
		</div>
<!-- FIN PAGE 1 : environnement principal -->
			
<!-- ------------------------------- Fin ssi CONNECTED -------------------------- -->
			

