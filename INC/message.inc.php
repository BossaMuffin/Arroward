<?php
/* ********** VERIF CONNEXION - JSON INIT **************** */
/* On vérifie d'abord que le compte existe, si ce n'est pas le cas, 
on s'arrête, on supprime les sessions et on renvoie 0. */


/* *************** Afficher les derniers messages des chats *************  */
/* On effectue la requête sur la table contenant les messages. On récupère
les 10 derniers messages. Enfin, on affiche le tout. */

if ($sessionType == 1){
	
	$chat_id = $posDefo;

	if (isset($_POST['chat'])){
		if ($_POST['chat'] == 'chatH'){
			$chat_id = $user["amis"]["amiH"];
		}
		else if ($_POST['chat'] == "chatD"){
			$chat_id = $user["amis"]["amiD"];
		}
		else if ($_POST['chat'] == "chatB"){
			$chat_id = $user["amis"]["amiB"];
		}
		else if ($_POST['chat'] == "chatG"){
			$chat_id = $user["amis"]["amiG"];
		}
		
		//envoi du text du message
		if (isset($user['id']) and !empty($_POST['chat_text']) and $chat_id != $user['id']){
		/* au format int AAAAMMDDHHMMSS */	
		//$date = date("YmdHis");
		$annee = date("Y");
		$mois = date("m");
		$jour = date("d");
		$heure = date("H");
		$minute = date("i");
		$seconde = date("s");
		
		//preparation de envoi 2 dONE
					//ajouter les verif de syntaxe//
					/*$message = mysql_real_escape_string(htmlspecialchars(trim($_POST['chat_text'])));*/
					
					// On supprime les balises HTML
					$message = htmlspecialchars($_POST['chat_text']); 

					// On transforme les liens en URLs cliquables
					$message = Fparse_text($message);
			
					
					//exit('id user: '.$user['id'].' id env : '.$chat_id.' - TEXT : '.$_POST['chat_text']);
					$new_message = $bdd->prepare('INSERT INTO Tchats(id_rec, id_env, message, annee, mois, jour, heure, minute, seconde) 
					VALUES(:id_rec, :id_env, :message, :annee, :mois, :jour, :heure, :minute, :seconde)');


					$new_message->execute(array(
					'id_rec' => $chat_id,
					'id_env' => $user['id'],
					'message' => $message,
					'annee' => $annee, 
					'mois'=> $mois, 
					'jour' => $jour, 
					'heure' => $heure, 
					'minute' => $minute, 
					'seconde' => $seconde
					))
					
					or die(print_r($new_message->errorInfo()));
					$new_message->closeCursor();//on ferme la req de nouvel article//
					
	}
	if (empty($_POST['chat_text'])){$chat_error = "Message vide";}

	}
	
	

	$query_chats = $bdd->prepare("
		SELECT *
		FROM Tchats
		WHERE ( id_env = :id_user AND id_rec = :id_ami ) 
		OR ( id_env = :id_ami AND id_rec = :id_user )
		ORDER BY id DESC
	");

	//On demande le CHAT H
	$query_chats->execute(array(
		'id_user' => $user['id'],
		'id_ami' => $user["amis"]["amiH"]
	));
	$i=0;
	$nb_message_max=10;
	// il y a $i reponse 
	while($resp_chats = $query_chats->fetch(PDO::FETCH_ASSOC)){ 
	$user["amis"]["chatH"][$i] = $resp_chats;
	$i++;
	// echo "RESP_CHATS 1".$user["amis"]["chatH"];
	}

	//On demande le CHAT D
		$query_chats->execute(array(
			'id_user' => $user['id'],
			'id_ami' => $user["amis"]["amiD"]
		));
		$i=0;
		// il y a $i reponse 
		while($resp_chats = $query_chats->fetch(PDO::FETCH_ASSOC)){ 
			$user["amis"]["chatD"][$i] = $resp_chats;
			$i++;
			// echo "RESP_CHATS 2".$user["amis"]["chatD"];
		}

	//On demande le CHAT B
		$query_chats->execute(array(
			'id_user' => $user['id'],
			'id_ami' => $user["amis"]["amiB"]
		));
		$i=0;
		// il y a $i reponse 
		while($resp_chats = $query_chats->fetch(PDO::FETCH_ASSOC)){ 
			$user["amis"]["chatB"][$i] = $resp_chats;
			$i++;
			// echo "RESP_CHATS 3".$user["amis"]["chatB"];
		}
	//On demande le CHAT G

	$query_chats->execute(array(
			'id_user' => $user['id'],
			'id_ami' => $user["amis"]["amiG"]
		));
		$i=0;
		// il y a $i reponse 
		while($resp_chats = $query_chats->fetch(PDO::FETCH_ASSOC)){ 
			$user["amis"]["chatG"][$i] = $resp_chats;
			$i++;
			// echo "RESP_CHATS 4".$user["amis"]["chatG"];
		}


	$query_chats->closeCursor();


	
}

