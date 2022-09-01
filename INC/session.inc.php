	<?php
	
/* VARIABLES D'ETAT *******/
	
	if (!isset($_SESSION['groupe'])){
		/* pas de connexion */
	$sessionType=0;
	}
	
	if (isset($_SESSION['groupe'])){
		if ($_SESSION['groupe'] == 0){
			/* pas de connexion */
			$user_session = "NO USER SESSION";
			$sessionType = 0 ;
			$positionUser["pos"] = $posDefo ;
		}
		else if ($_SESSION['groupe'] == 1){
			
/*** VAR USER ************/
			
			
			/* connexion CLASSIQUE */
			$user_session = "USER SESSION 1";
			$sessionType = 1 ;
			
			/* INFOS USER par SQL dans array $user */
			$recherche_user = "SELECT * FROM Tusers WHERE pseudo = '".$_SESSION['pseudo']."'";
		  if ($recherche_infos = $bdd->query($recherche_user)){
		
	
		  $infos_user = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
		  // Affichage du résultat    
			
			$user = [
				"id" 		=> $infos_user['id'],
				"pseudo" 	=> $infos_user['pseudo'],
				"prenom" 	=> $infos_user['prenom'],
				"nom" 	=> $infos_user['nom'],
				"mail" 		=> $infos_user['mail'],
				"mdp" 		=> $infos_user['mdp'],
				"amis"		=>  [
						"amiH" => $infos_user['AmiH'],
						"amiD" => $infos_user['AmiD'],
						"amiB" => $infos_user['AmiB'],
						"amiG" => $infos_user['AmiG'],
						],
				"fond"		=> $infos_user['imgPath'],
				"pos"		=> $infos_user['pos'],
				"likes"		=> $infos_user['likes'],

				
				"vues"		=> "Uvues"
				];
			 $recherche_infos ->closeCursor();
			 //POSITION	
			 $positionUser["pos"] = $user["pos"];
				
			//DEMANDE ENV
			$recherche_demande = "SELECT id_rec, etat FROM Tdemandes WHERE id_env = '".$user["id"]."'";
				  if ($recherche_infos = $bdd->query($recherche_demande)){	
						$nbEnv = 0;
						
						while ($infos_user = $recherche_infos->fetch(PDO::FETCH_ASSOC)){
						$nbEnv++;
						$user["demande"]["env"][$nbEnv]["id"]  = $infos_user['id_rec'];
						$user["demande"]["env"][$nbEnv]["etat"]  = $infos_user['etat'];
						}
						
						$recherche_infos ->closeCursor();
					}
					//exit(print_r($user["demande"]["env"]));
			//DEMANDE REC
			$recherche_demande = "SELECT id_env, etat FROM Tdemandes WHERE id_rec = '".$user["id"]."'";
				  if ($recherche_infos = $bdd->query($recherche_demande)){	
					   $nbRec = 0;	
						while ($infos_user = $recherche_infos->fetch(PDO::FETCH_ASSOC)){ 
						$nbRec++;
						$user["demande"]["rec"][$nbRec]["id"]  = $infos_user['id_env'];
						$user["demande"]["rec"][$nbRec]["etat"]  = $infos_user['etat'];
						}
					$recherche_infos ->closeCursor();
					}
					
					
					
				/************************************************************
				* Cheque du repertoire cible si inexistant !is_dir(TARGET)
				*************************************************************/
				 //TEST SUR DOSSIER UPLOAD upload_target
				$upload_target = $dirUpload.'/'.$user['id'];  //  Repertoire cible
					if (is_dir($upload_target)){
						// CIBLE DOSSIER USER 
						
						$upload_target2 = $upload_target.'/MINI';   // Repertoire cible 2 Mini
				
						//CBIEN IMG dans DIR ?

						$num_img_max = Fcount_files($upload_target);
						//IMG de FOND est la derniere du dossier USER UPLOAD 
						$num_imgFond = $num_img_max - 2 ;
						$num_imgFond2 = $num_img_max + 2 ;
						/*
						$img_user = Fname_files($upload_target);
						$img_path_user = $upload_target.'/'.$img_user[$num_imgFond2];
						*/
						$img_path_user = $user["fond"];
						$file_crea = 1;
					}
					else { 
						// CIBLE DOSSIER PAR DEFO 	
						$file_crea = 0;		 	
						$upload_target = $dirUpload.'/defaut';  //  Repertoire cible
						$upload_target2 = $dirUpload.'/defaut/MINI';   // Repertoire cible 2 Mini
						
						$img_path_user = $upload_target.'/defaut.jpeg';
						
						//CBIEN IMG dans DIR ?
						$num_img_max = Fcount_files($upload_target);
						//IMG de FOND est la derniere du dossier USER UPLOAD
						$num_imgFond = $num_img_max-2;
						}
					//FIN TEST
				
				
			}
			else {
				/* INFOS USER PAR DEFO ou exit('Un problème est survenu, nous cherchons à rétablir votre connexion'); */
				$test = "NOK";
				$user = [
				"id" 		=> 0,
				"pseudo" 	=> "DefoPseudo",
				"mail" 		=> "DefoMail",
				"mdp" 		=> "DefoMdp",
				"amis"		=>  [
						"amiH" => "DefoAmiH",
						"amiD" => "DefoAmiD",
						"amiB" => "DefoAmiB",
						"amiG" => "DefoAmiG"
						],
				"fond"		=> "DefoPATHImgFond",
				"pos"	=> $posDefo,
				"likes"		=> 0,
				"demande"	=>  [
						"env"  => "UEnv",
						"rec"  => "URec",
						],
				"vues"		=> "Uvues"
				];
				
				// CIBLE DOSSIER PAR DEFO 			 	
				$upload_target = $dirUpload.'/defaut' ;  //  Repertoire cible
				$upload_target2 = $dirUpload.'/defaut/MINI' ;   // Repertoire cible 2 Mini

				$img_path_user = $upload_target.'/defaut.jpeg';
				
				//CBIEN IMG dans DIR ?
				$num_img_max = Fcount_files($upload_target) ;
				//IMG de FOND est la derniere du dossier USER UPLOAD
				$num_imgFond = $num_img_max -2;
				
				$positionUser["pos"] = $user["pos"];
			}
			
		}
		else if ($_SESSION['groupe'] == 2){
			$user_session = "USER SESSION 2";
			$sessionType = 2 ;
			$positionUser["pos"] = $posDefo;
		}
		else{$_SESSION['groupe']=0; $user_session = "SESSION REDIRECT - NO USER SESSION"; $sessionType = 0; $positionUser["pos"] = $posDefo;
		}

	} 
	else{$_SESSION['groupe']=0; $user_session = "NO SESSION - NO USER SESSION"; $sessionType = 0;  $positionUser["pos"] = $posDefo;
	}
