<?php
// POSITION definition - miniatures
	
		/* $positionUser["pos"] = $user["pos"] id de visite VARIABLE  : $user["pos"] trouve dans session.inc
		/* intégrer un module de recherche de position */
		/* ATTENTION imgPath !!!! */


	// ------------- Position si connect 
	if ($sessionType == 1){
		//exit(print_r($_GET));
		
			if (isset($_GET['pos']))
			{
				//	exit("GETok".$positionUser["pos"]);
				$positionUser["pos"] = $_GET['pos'];
				
				//Mise à jour de la nouvelle POSITION dans BDD
				$new_pos = $bdd->prepare("UPDATE Tusers SET pos = :pos WHERE id = :id_user");
							$new_pos->execute(array(
							'pos' => $positionUser["pos"],
							'id_user' => $user['id']
							));
							
				$new_pos->closeCursor();//on ferme la req ACCEPT//
			
			
				//on detremine les variable de position Soit lors de la navigation, soit la page par defo, soit la page perso
				if ($positionUser['pos'] != $user['id'] AND $positionUser["pos"] != $posDefo){
					//le membre navigue
				
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$positionUser['pos']."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							//	exit('ok  get infoPos sql '.print_r($positionUser["fond"]));
						}
				
				}
				else if ($positionUser['pos'] == $user['id']){
					//le membre est chez lui 
					$positionUser = [
							"pos" 	=> $user['id'],
							"AmiH" 	=> $user['amis']['amiH'],
							"AmiD" 	=> $user['amis']['amiD'],
							"AmiB" 	=> $user['amis']['amiB'],
							"AmiG" 	=> $user['amis']['amiG'],
							"fond"	=> $user['fond'],
							"likes"	=> $user['likes'],
							"vues"	=> $user['vues'],
							];
							
							//exit('ok  get infoPos sql '.print_r($positionUser));
				}
				else if ($positionUser["pos"] == $posDefo){
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$posDefo."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				//le membre est à la page par defaut
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							
						}
					
				
				}
			}
			else {
										
					$recherche_pos = "SELECT pos FROM Tusers WHERE id = '".$user["id"]."'";
					  if ($recherche_infos = $bdd->query($recherche_pos)){
					
				//le membre est à la page par defaut
					  $pos_archive = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser["pos"] = $pos_archive['pos'];
						
						 $recherche_infos ->closeCursor();
							
							
						}
					
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$positionUser["pos"]."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				//le membre est à la page par defaut
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							
						}
					
				
				}
			
		}
		else { 
			//POSITION de NAVIGATION d1 USER non CONNECTE
			if (isset($_GET['pos'])){
				$positionUser["pos"] = $_GET['pos'];
			
				if ($positionUser["pos"] == $posDefo){
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$posDefo."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				//le membre est à la page par defaut
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							
						}
					}
					else{
						
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$positionUser["pos"]."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				//le membre est à la page par defaut
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							
						}
					}
				}
				else {
					
					$recherche_position = "SELECT * FROM Tusers WHERE id = '".$posDefo."'";
					  if ($recherche_infos = $bdd->query($recherche_position)){
					
				//le membre est à la page par defaut
					  $infos_position = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
					  // Affichage du résultat    
						
						$positionUser = [
							"pos" 	=> $infos_position['id'],
							"AmiH" 	=> $infos_position['AmiH'],
							"AmiD" 	=> $infos_position['AmiD'],
							"AmiB" 	=> $infos_position['AmiB'],
							"AmiG" 	=> $infos_position['AmiG'],
							"fond"	=> $infos_position['imgPath'],
							"likes"	=> $infos_position['likes'],
							"vues"	=> $infos_position['vues'],
							];
						 $recherche_infos ->closeCursor();
							
							
						}
					
				}
		}
		
		
		//Recherche des miniatures //
		
		
		/* INFOS USER par SQL dans array $user */
		//Miniature en Haut
			$recherche_mini = "SELECT imgPath FROM Tusers WHERE id = '".$positionUser['AmiH']."'";
		  if ($recherche_infos = $bdd->query($recherche_mini)){
		
	
			$infos_mini = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
			// Affichage du résultat    
			
			$positionMini["H"] = $infos_mini['imgPath'];
			$recherche_infos ->closeCursor();
		}
		
		//Miniature a droite
			$recherche_mini = "SELECT imgPath FROM Tusers WHERE id = '".$positionUser['AmiD']."'";
		  if ($recherche_infos = $bdd->query($recherche_mini)){
		
	
			$infos_mini = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
			// Affichage du résultat    
			
			$positionMini["D"] = $infos_mini['imgPath'];
			$recherche_infos ->closeCursor();
		}
		
		//Miniature en bas
			$recherche_mini = "SELECT imgPath FROM Tusers WHERE id = '".$positionUser['AmiB']."'";
		  if ($recherche_infos = $bdd->query($recherche_mini)){
		
	
			$infos_mini = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
			// Affichage du résultat    
			
			$positionMini["B"] = $infos_mini['imgPath'];
			$recherche_infos ->closeCursor();
		}
		
		//Miniature a gauche
			$recherche_mini = "SELECT imgPath FROM Tusers WHERE id = '".$positionUser['AmiG']."'";
		  if ($recherche_infos = $bdd->query($recherche_mini)){
		
	
			$infos_mini = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
			// Affichage du résultat    
			
			$positionMini["G"] = $infos_mini['imgPath'];
			$recherche_infos ->closeCursor();
		}
			
