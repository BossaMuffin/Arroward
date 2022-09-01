<?php

if (isset($_POST['like'])){
$x=''; /* nb de like deja passees de user vers rec - VIDE par defo */
$like_demande_alert= "Le like n'est pas passé";
	if (isset($_POST['posID'])){
	//VERIFICATIOn de la possibilité du like
				
				
				$recherche_like = "SELECT  id FROM Tlikes WHERE id_env = '".$user["id"]."' AND id_rec = '".$_POST['posID']."'";
				  if ($recherche_infos = $bdd->query($recherche_like)){	
						$x=0; /*si sql ok on arme x */
						while ($id_likes = $recherche_infos->fetch(PDO::FETCH_ASSOC)){
						$x++; /* x compte les doublons */
						}
						$recherche_infos ->closeCursor();	
					}
				/* si x est resté armé à 0 alors on envoi la demande */	
	
				if ($x==0){
					//ENVOI SQL
					
					//Nouvel ligne dans Tlikes
						$new_like = $bdd->prepare('INSERT INTO Tlikes(id_rec, id_env) 
						VALUES(:id_rec, :id_env)');
						$new_like->execute(array(
						'id_rec' => $_POST['posID'],
						'id_env' => $user["id"]
					   ))
						or die(print_r($new_like->errorInfo()));
						$new_like->closeCursor();//on ferme la req de nouvo like//
						
						//rafraichissement
						$nbLikes = $positionUser['likes'];
						$nbLikes++;
					//AJoute 1 au compteur LIKE du posID 
						$new_like = $bdd->prepare('UPDATE Tusers SET likes = :likes WHERE id = :id_rec');
						$new_like->execute(array(
						'likes' => $nbLikes,
						'id_rec' => $_POST['posID']
						))
						or die(print_r($new_like->errorInfo()));
						$new_like->closeCursor();//on ferme la req REFUSE//
						$positionUser['likes'] = $nbLikes;
						$like_demande_alert= "Tu l'aimes au grand jour";
				}	
				else if ($x==''){$like_demande_alert= "Pb désolé ...";
				}
				else if ($x==1){$like_demande_alert= "Tu l'as déjà liké";
				}
				else {$like_demande_alert="Tu as déjà liké ".$x." fois, calme-toi stp";
				}
				
				
	
	
	}
	else{$like_demande_alert= "On like qui ?";}



}
