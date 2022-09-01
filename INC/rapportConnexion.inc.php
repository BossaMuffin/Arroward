<!-- rapport de connexion DISPLAY BLOCK si tentative de connexion-->
	 <?php 
	      if (isset($_POST['conex'])){
			  if ($erreur_conex != 11){
					echo '<p><span class="rouge">	  ';
					
					if ($erreur_conex == 10){
					  echo 'Pseudo et mail incorrects ;';
					}
					else if ($erreur_conex == 0){
					  echo 'Le format du mail est incorrect ;';
					}
					else if ($erreur_conex == 1){
					  echo 'Remplir votre mail et votre pseudo  ;';
					}
					else if ($erreur_conex == 2){
					  echo 'Vous n\'avez pas entré votre pseudo ;';
					}
					else if ($erreur_conex == 3){
					  echo 'Vous n\'avez pas entré votre  mail ; ';
					}
					else if ($erreur_conex == 4){
					  echo 'Mail inconnu ; ';
					}
					else if ($erreur_conex == 5){
					  echo 'Votre fournisseur de service mail est inconnu ; ';
					}
					
					if ($mail_conex_ok == false){
					  echo 'Une erreur est survenue sur votre mail ;';
					}
					if ($pseudo_conex_ok == false){
					  echo 'Une erreur est survenue sur votre pseudo ;';
					}
					if ($img_ctrl_conex == false){
					  echo 'Une erreur est survenue sur le cryptogramme de sécurité ;';
					}

					 echo '</span></p>';
				}
				else if ($erreur_conex == 11){
					if ($idOK){
					  echo '<p>Connexion réussie ; '.$_SESSION["groupe"].'</p>';
					}
				}
		}

