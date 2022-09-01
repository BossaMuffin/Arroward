<?php

//Demande dAJOUT AMI
	if (isset($_POST['ami'])){
				//DEMANDE ENV
				$x=''; /* nb de demande deja passees de user vers rec - VIDE par defo */
				
				$recherche_demande = "SELECT  etat FROM Tdemandes WHERE id_env = '".$user["id"]."' AND id_rec = '".$_POST['ami']."'";
				  if ($recherche_infos = $bdd->query($recherche_demande)){	
						$x=0; /*si sql ok on arme x */
						while ($etat_demande = $recherche_infos->fetch(PDO::FETCH_ASSOC)){
						$x++; /* x compte les doublons */
						}
						$recherche_infos ->closeCursor();	
					}
					//exit(print_r($user["demande"]["env"]));
				/* si x est resté armé à À alors on envoi la demande */	
				if ($x==0){
					//ENVOI SQL
						$new_demande = $bdd->prepare('INSERT INTO Tdemandes(id_rec, id_env) 
						VALUES(:id_rec, :id_env)');
						$new_demande->execute(array(
						'id_rec' => $_POST['ami'],
						'id_env' => $user["id"]
					   ))
						
						or die(print_r($new_demande->errorInfo()));
						$new_demande->closeCursor();//on ferme la req de nouvel article//
						/*rafraichissement de la liste de demande EnV */
						$nbEnv++;
						$user["demande"]["env"][$nbEnv]["id"] = $_POST['ami'];	
						
						$env_demande_alert="Ta demande a été envoyée avec succès, attendons la réponse";
				}	
				else if ($x==''){$env_demande_alert="Ta demande n'a pas aboutie";
				}
				else if ($x==1){$env_demande_alert="Tu lui as déjà demandé";
				}
				else {$env_demande_alert="Tu as déjà envoyée ".$x." demandes, calme-toi stp";
				}
	}
	if (isset($_POST['gestion_demande'])){
				$id_demande = $_POST['gestion_demande'];
				//etat 2 : la demande est en attente par defo, mais elle peut aussi etre dans un autre etat
			
				if (isset($_POST['demande_refuse'])){
			/**** REFUSE ***/
					//letat de la demande change -> 0 ; 
					$new_etat = $bdd->prepare("UPDATE Tdemandes SET etat = :etat WHERE id_rec = :id_user AND id_env = :id_demande");
					$new_etat->execute(array(
					'etat' => 0,
					'id_user' => $user['id'],
					'id_demande' => $id_demande
					))
					or die(print_r($new_etat->errorInfo()));
					$new_etat->closeCursor();//on ferme la req REFUSE//
					/* rafraichi */
					$i_demande = $_POST['i_demande'];
					$user["demande"]["rec"][$i_demande]["etat"] = 0;
						
				}
				else if (isset($_POST['demande_accept'])){
			/*** ACCEPT ***/
					$accept_demande_alert= "La démarche n'a pas aboutie, essaye encore";
					//recherche de place libre chez le USER
					$place_libre_user = 0;
					$place_libre_demande = 0;
					if ($user["amis"]["amiH"] == $AmiHdefo){
						$place_libre_user = 1; //libre en haut
					}else if ($user["amis"]["amiD"] == $AmiDdefo){
						$place_libre_user = 2; //libre en haut
					}else if ($user["amis"]["amiB"] == $AmiBdefo){
						$place_libre_user = 3; //libre en haut
					}else if ($user["amis"]["amiG"] == $AmiGdefo){
						$place_libre_user = 4; //libre en haut
					}
			
					if ($place_libre_user != 0){
						
						//VERIFICATIOn PLACE LIBRE DEMANDANT
						/* INFOS USERDEMAND */
						$recherche_user = "SELECT AmiH, AmiD, AmiB, AmiG FROM Tusers WHERE id = '".$id_demande."'";
						if ($recherche_infos = $bdd->query($recherche_user)){
							
							$place_demande = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
							$recherche_infos ->closeCursor();
							if ($place_demande['AmiH'] == $AmiHdefo){
								$place_libre_demande = 1; //libre en haut chez le demandant
								$amiRef = "AmiH";
							}else if($place_demande['AmiD'] == $AmiDdefo){
								$place_libre_demande = 2; //libre a droite chez le demandant
								$amiRef = "AmiD";
							}else if($place_demande['AmiB'] == $AmiBdefo){
								$place_libre_demande = 3; //libre en bas chez le demandant
								$amiRef = "AmiB";
							}else if($place_demande['AmiG'] == $AmiGdefo){
								$place_libre_demande = 3; //libre en bas chez le demandant
								$amiRef = "AmiG";
							}
						
						if ($place_libre_demande != 0){
					//letat de la demande change -> 1 ;
						//SENS REC vers ENV
							$new_etat = $bdd->prepare("UPDATE Tdemandes SET etat = :etat WHERE id_rec = :id_user AND id_env = :id_demande");
							$new_etat->execute(array(
							'etat' => 1,
							'id_user' => $user['id'],
							'id_demande' => $id_demande
							))
							or die(print_r($new_etat->errorInfo()));
							$new_etat->closeCursor();//on ferme la req ACCEPT//
							/* rafraichi */
							$i_demande = $_POST['i_demande'];
							$user["demande"]["rec"][$i_demande]["etat"] = 1;
						//SENS ENV vers REC
							$new_etat = $bdd->prepare("UPDATE Tdemandes SET etat = :etat WHERE id_rec = :id_demande AND id_env = :id_user");
							$new_etat->execute(array(
							'etat' => 1,
							'id_user' => $user['id'],
							'id_demande' => $id_demande
							));
							$new_etat->closeCursor();//on ferme la req ACCEPT//
		
								
						//INITIALISATION des requete cote USER
			//ACCEPTANT (user)
							if ($place_libre_user == 1){
							//INSCRIPTION DUN NOUVELLE AMI
								$new_ami = $bdd->prepare("UPDATE Tusers SET AmiH = :ami WHERE id = :id_user");
							}
							else if ($place_libre_user == 2){
							//INSCRIPTION DUN NOUVELLE AMI
								$new_ami = $bdd->prepare("UPDATE Tusers SET AmiD = :ami WHERE id = :id_user");
							}
							else if ($place_libre_user == 3){
							//INSCRIPTION DUN NOUVELLE AMI
								$new_ami = $bdd->prepare("UPDATE Tusers SET AmiB = :ami WHERE id = :id_user");
							}
							else if ($place_libre_user == 4){
							//INSCRIPTION DUN NOUVELLE AMI
								$new_ami = $bdd->prepare("UPDATE Tusers SET AmiG = :ami WHERE id = :id_user");
							}
						
						//INITIALISATION noouvel AMI chez USER
								if ($new_ami->execute(array(
									'ami' => $id_demande,
									'id_user' => $user['id']
									))
									AND
									$new_ami->closeCursor()
									)
									{
									/* rafraichi */
									$i_demande = $_POST['i_demande'];
									$user["demande"]["rec"][$i_demande]["etat"] = 1;

								
					//DEMANDANT (id_demande)
									//INITIALISATION des requete cote DEMANDANT (id_demande)
									if ($place_libre_demande == 1){
									//INSCRIPTION DUN NOUVELLE AMI
										$new_ami = $bdd->prepare("UPDATE Tusers SET AmiH = :ami WHERE id = :id_user");
										
									}
									else if ($place_libre_demande == 2){
									//INSCRIPTION DUN NOUVELLE AMI
										$new_ami = $bdd->prepare("UPDATE Tusers SET AmiD = :ami WHERE id = :id_user");
										
									}
									else if ($place_libre_demande == 3){
									//INSCRIPTION DUN NOUVELLE AMI
										$new_ami = $bdd->prepare("UPDATE Tusers SET AmiB = :ami WHERE id = :id_user");
										
									}
									else if ($place_libre_demande == 4){
									//INSCRIPTION DUN NOUVELLE AMI
										$new_ami = $bdd->prepare("UPDATE Tusers SET AmiG = :ami WHERE id = :id_user");
										
									}

								//INITIALISATION noouvel AMI chez USER
								if ($new_ami->execute(array(
								'ami' => $user['id'],
								'id_user' => $id_demande
								))
								AND
								$new_ami->closeCursor()){
							//NOUVEL AMI OK
								$accept_demande_alert= "Nouvel ami accepté";
								//rafraichissement
								$user['amis'][$amiRef] = $id_demande;

								}else{$accept_demande_alert= "L'enregistrement n'a pas pris de SON côté";}	
							}else{$accept_demande_alert= "L'enregistrement n'a pas pris de TON côté";}	
						}else{$accept_demande_alert= "Ton ami n'a plus de place";}
					}else{$accept_demande_alert= "Problème de destinataire";}
					
					
					}else{$accept_demande_alert= "Tu n'as plus de place libre";}
				}
				else if (isset($_POST['demande_annule'])){
			/**** ANNULE ***/
					//on retire la demande chez le destinataire
					$delete_demande = $bdd->prepare("DELETE FROM Tdemandes WHERE id_rec = :id_demande AND id_env = :id_user");
					$delete_demande->execute(array(
					'id_user' => $user['id'],
					'id_demande' => $id_demande
					))
					or die(print_r($delete_demande->errorInfo()));
					$delete_demande->closeCursor();//on ferme la req de ANNULE//
					/* actualisation de la liste de demande envoyee*/
					$i_demande = $_POST['i_demande'];
					while($i_demande < $nbEnv){
						$user["demande"]["env"][$i_demande]["id"] = $user["demande"]["env"][($i_demande+1)]["id"];
						$user["demande"]["env"][$i_demande]["etat"] = $user["demande"]["env"][($i_demande+1)]["etat"];
							
						$i_demande++;
					}
					$nbEnv = $nbEnv - 1;
					/*fin de process de rafraichissement*/
				}
				else {exit('PB : Erreur de requete pour '.$id_demande);}
			}
