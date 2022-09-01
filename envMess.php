<?php session_start();	
	/* JQUERY AJAX envoi des messages chat*/
	
	
	
/*****VAR META***/
	/*url racine */
	$url="http://arroward.comozone.com/";
	/*url de la page*/
	$page="envMess.php";
	/*nom de la page*/
	$nomPage="envMess";
	/*description courte */
	$descriptionPage="...";
	/*Mots clefs de la page*/
	$motClefPage="..., ...";
	/* gestion de la navigation et de lindexage des robots 
		 1= index/follow
		 2= NOindex/follow
		 3=index/NOfollow
		 0=NOindex/NOfollow
	*/
	$page_index = 0;
	
	
	
	/* BDD */
	require("INC/BDD.php");
	
	//UPLOAD
		$dirUpload = 'IMG/UPLOAD';
		$file_crea = 0;
	//exit("heho");	
	// Fonction de contage dans le dossier DIR - count_files($chemin)
	require("INC/Fcount_files.inc.php");
	// Transforme un smiley en smiley img + url to link
	require("INC/Fparse_text.inc.php");
	// Script SESSION GROUPE script aiguillage session - config donnees users/img - $sessionType //
	require("INC/session.inc.php"); 
	/* -- ------------------------------- SSI CONNECTED -------------------------- -- */
	$data = "</br> pb : essaye encore";
	if (isset($sessionType)){
		
			if ($sessionType == 1){
			if(!empty($_POST['chat_message']) and !empty($_POST['chat_ctrl'])){
				$chat_id = $posDefo;
				

			if (isset($_POST['chat_ctrl'])){
				if ($_POST['chat_ctrl'] == 'chatH'){
					$chat_id = $user["amis"]["amiH"];
				}
				else if ($_POST['chat_ctrl'] == "chatD"){
					$chat_id = $user["amis"]["amiD"];
				}
				else if ($_POST['chat_ctrl'] == "chatB"){
					$chat_id = $user["amis"]["amiB"];
				}
				else if ($_POST['chat_ctrl'] == "chatG"){
					$chat_id = $user["amis"]["amiG"];
				}
		
				//envoi du text du message
				if (isset($user['id']) and !empty($_POST['chat_message']) and $chat_id != $user['id']){
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
				$message = htmlspecialchars($_POST['chat_message']); 

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
				
				$data = "</br>message envoyé : ";
				$data .= "</br>m_: ".$_POST['chat_message'];
				
				}
				if (empty($_POST['chat_message'])){$data .= " - erreur conexion";}

				}else{$data .= " - erreur chat ctrl";}
				
			}else{$data .= " - message vide";}
			echo $data;
				
			
				
				
				
		}
		else{echo "session type ok != 1";	}
	}else{echo "session type NOK";	}
	
			 
	/*  ------------------------------- Fin ssi CONNECTED -------------------------- */
	?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo $nomPage;?></title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--<meta http-equiv="content-language" content="fr-FR" />-->
		 <meta name="email" content="coz.web@comozone.com">
		<meta name="author" content="Jean-Eudes Méhus - Agence ComOZone">
		<meta name="publisher" content="Agence ComOZone">
		<meta name="language" content="fr-FR" />
		<meta name="description" <?php echo 'content="'.$descriptionPage.'"';?> />
		<!-- Mot clef -->
		<meta name="keywords" <?php echo 'content="'.$motClefPage.'"';?> />
		<link rel="canonical" <?php echo 'href="'.$url.$page.'"';?> />
		
		<!--STYLES-->
		<link rel="stylesheet" href="CSS/style.css" type="text/css" media="screen" />
		<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes" />

		
		<!-- LANGUE VERSION GOOGLE -->
		<link rel="alternate" <?php echo 'href="'.$url.$page.'"';?> hreflang="x-default" />
		<link rel="alternate"  <?php echo 'href="'.$url.$page.'"';?> hreflang="fr" />
				
		<?php 
		/*gestion de la navigation et de lindexage des robots 
		 --> voir $page_index dans VARIABLES */
		  include("INC/index_follow.inc.php"); 
		?>
		
</head>
	<body>
	</body>
</html>		
	
