<?php 
$erreur_file = 0;
$file_bbtxt = "";
if (isset($_POST['file_submit'])){
	if (isset($_POST['wysifile_text'])){
		require_once("../JBBCode/Parser.php");
		$file_bbtxt = htmlspecialchars($_POST['wysifile_text']);
		if (!empty($file_bbtxt)){
		
			die();
			if (strlen($file_bbtxt) <= 16000000){
			  //Envoi du BB file
				//preparation 
				//ajouter les verif de syntaxe//
				$new_file = $bdd->prepare('INSERT INTO Tfiles(user_id, file) 
				VALUES(:user_id, :file_txt)');
				$new_file->execute(array(
				'user_id' => $user['id'],
				'file' => $file_bbtxt ))
				
				or die(print_r($new_file->errorInfo()));
				$new_file->closeCursor();//on ferme la req de nouvel article//
			}
			else{$erreur_file = 4;}
		}
		else{$erreur_file = 3;}
	}
	else{$erreur_file = 2;}
}
else{
	
	/* INFO FILE USER */
		$recherche_file = "SELECT file FROM Tfiles WHERE user_id = '".$user['id']."'";
		if ($recherche_infos = $bdd->query($recherche_file)){
			$infos_file = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
		  // Affichage du résultat    
			$file_bbtxt = $infos_file['file'];
			$recherche_infos ->closeCursor();
			}
	echo 'pas de file submit'; 
	}


	$parser = new JBBCode\Parser();
	$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());

	$parser->parse($file_bbtxt);

	
