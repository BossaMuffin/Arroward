<?php session_start();	
	/* JQUERY AJAX Reception des messages chat*/
	/* BDD */
	
	
	
	/*****VAR META***/
	/*url racine */
	$url="http://arroward.comozone.com/";
	/*url de la page*/
	$page="recMess.php";
	/*nom de la page*/
	$nomPage="recMess";
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
	$data = "</br> Aucun message";
	if (isset($sessionType)){
		
			if ($sessionType == 1){
			if(!empty($user['id']) and !empty($_POST['chat_ctrl'])){
				
				if ($_POST['chat_ctrl'] == "chatH"){
					$id_ami_chat = $user["amis"]["amiH"];
				}
				else if ($_POST['chat_ctrl'] == "chatD"){
					$id_ami_chat = $user["amis"]["amiD"];
				}
				else if ($_POST['chat_ctrl'] == "chatB"){
					$id_ami_chat = $user["amis"]["amiB"];
				}
				else if ($_POST['chat_ctrl'] == "chatG"){
					$id_ami_chat = $user["amis"]["amiG"];
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
						'id_ami' => $id_ami_chat
					));
					$i=0;
					$j=0;
					$k=0;
					$nb_message_max=10;
					// il y a $i reponse 
					$data = "<ul>";
					while($resp_chats[$i] = $query_chats->fetch(PDO::FETCH_ASSOC)){ 
						//$data .= '// j:'.$resp_chats[$j]['id_env'].' i: '.$resp_chats[$i]['id_env'].'//';
								if($i<$nb_message_max and !empty($resp_chats[$i]['message']) ){
									if ($j==$i){
									$data .= "<li>pseudo : ".$resp_chats[$i]['id_env']."<br/>
									d_ : ".$resp_chats[$i]['heure'].$resp_chats[$i]['minute'].$resp_chats[$i]['seconde']."<br/>
									m_ : ".$resp_chats[$i]['message']."<br/>";
									$j = $i;
									$i=$i+1;
									$k=1;
									}
									else if(($j < $i) and ($resp_chats[$j]['id_env'] == $resp_chats[$i]['id_env'])){
										$data .= "
										m_ : ".$resp_chats[$i]['message']."<br/>";
										$j++;
										$i++;
										$k=1;
									}
									else if(($j < $i) and ($resp_chats[$j]['id_env'] != $resp_chats[$i]['id_env'])){
										$data .= "</li><li>pseudo : ".$resp_chats[$i]['id_env']."<br/>
										d_ : ".$resp_chats[$i]['heure'].$resp_chats[$i]['minute'].$resp_chats[$i]['seconde']."<br/>
										m_ : ".$resp_chats[$i]['message']."<br/>";
										$j++;
										$i++;
										$k=2;
									}
									
									
									
								}else if(empty($resp_chats[$i]['message']) and $k==1){
									$data .="</li>";
								}
								
								
					$i++;
					// echo "RESP_CHATS 1".$user["amis"]["chatH"];
					}
					$query_chats->closeCursor();
					$data .= "<li id=".$_POST['chat_ctrl']."_retour></li>";
					$data .= "</ul>";
								
				}else{$data .= " - pb chat ctrl";}
			
								
								
				
		}
		else{$data .=  " - session type ok != 1";	}
	}else{$data .=  " - session type NOK";	}
	
	echo $data;
			 
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
