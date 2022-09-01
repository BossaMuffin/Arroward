  <?php
  // On met les variables utilisé dans le code PHP à FALSE (C'est-à-dire les désactiver pour le moment).
  $registerOK = false;

    // On regarde si l'utilisateur est bien passé par le module d'inscription
    if(isset($_POST["register"])){
    //temoin de passage au formulaire
    $nb_mail=0;
    $nb_pseudo=0;
    $inscription = false ; // est inscrit
    $registerOK = true; // a demandé une inscription
    $inscriptionOK = true; // il nexiste pas de doublon mail dans la BDD
    $erreur=10;
 
      
    //sil a repondu au formulaire, on initialise les variables
      $cpx_vides = false;
      $mail1_ok = false;
      $mail2_ok = false;
      $nom_ok = false;
      $prenom_ok = false;
      $mail_ok = false;
      $pseudo_ok = false;
      $ctrl_ok = false;
      $img_ctrl = 'empty';
   
  // on test le cryptogramme 
  if (isset($_POST["img_ctrl"])){
      $img_ctrl = $_POST["img_ctrl"];
      if ($img_ctrl == 'ok'){
	$ctrl_ok = true;
      }
  }
    
  // on test le post MAIL1 dans mail1 < 64 
  if (isset($_POST["mail1"])){
    if(strlen($_POST["mail1"] < 64)){
      $mail1_ok = true;
      $mail1 = $_POST["mail1"];
      }
  }
    // on test le post MAIL2 dans mail2 < 64 
  if (isset($_POST["mail2"])){
    if(strlen($_POST["mail2"] < 64)){
      $mail2_ok = true;
      $mail2=$_POST["mail2"];
      }
    
  }
    // on test le post nom dans nom < 64 
  if (isset($_POST["nom"])){
    if(strlen($_POST["nom"] < 20)){
      $nom_ok = true;
      $nom = $_POST["nom"];
    }
  }
    // on test le post prenom dans prenom < 64 
  if (isset($_POST["prenom"])){
    if(strlen($_POST["prenom"] < 20)){
      $prenom_ok = true;
      $prenom = $_POST["prenom"];   
      }
  }
  // on test le post prenom dans prenom < 64 
  if (isset($_POST["pseudo"])){
    if(strlen($_POST["pseudo"] < 12)){
      $pseudo_ok = true;
      $pseudo = $_POST["pseudo"];   
      }
  }

  if($mail1_ok and $mail2_ok){
       
      if ($mail1 == $mail2){
	$mail=stripslashes(htmlentities($_POST["mail1"]));  
	$mail_ok=true;
   
  } 
  }
  //si le cryptogramme est correctement rempli ...
  if ($ctrl_ok){
    if($mail_ok and $nom_ok and $prenom_ok and $pseudo_ok){
      //filtre sur nom prenom adresse
      $erreur = 0;
      $verif='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';  
      //quelques remplacements pour les specialchars  
      $nom=preg_replace('#(<|>)#', '-', $nom);  
      $nom=str_replace('"', "'",$nom);  
      $nom=str_replace('&', 'et',$nom);  
      $prenom=preg_replace('#(<|>)#', '-', $prenom);  
      $prenom=str_replace('"', "'",$prenom);  
      $prenom=str_replace('&', 'et',$prenom);  
      // On assigne et/ou protège nos variables  
      $nom=stripslashes(htmlspecialchars($nom));  
      $prenom=stripslashes(htmlspecialchars($prenom)); 
      $pseudo=htmlspecialchars($pseudo);
      //input envoi/previsualiser   
      //on enlève les espaces  
      $mail=trim($mail);  
      $nom=trim($nom);  
      $prenom=trim($prenom);
      $pseudo=trim($pseudo);
      //donne lip de user
      $ip = $_SERVER['REMOTE_ADDR'];
      $com = '';

      /*On vérifie si l'e mail et le message sont pleins, et on agit en fonction.  
	(on affiche Apercu du resultat, tel ou tel champ est vide, etc...*/  

      if((empty($pseudo))or(empty($nom))or(empty($prenom))or(!preg_match($verif,$mail)))  
	{  
      //Si ca ne vas pas (mal rempli, mail non valide...)  
	  //les 3 champs sont vides  
	  if(empty($mail)and(empty($nom))and(empty($prenom))and(empty($pseudo)))  
	    {  
	      $erreur = 1; 
	      $nom='';$mail='';$prenom='';$pseudo='';
	    }  
	  //un des champs est vide  
	  else  
	    {  
	      $erreur = 2; //au moins un champs vide
	      }
	  
	}  
      //Si les trois sont pleins et que l'adresse est valide, on envoie prévisualise sans envoi  
      else  
	{  
	if(preg_match($verif,$mail))  
	      {
	      
	  $domaine=preg_replace('#[^@]+@(.+)#','$1',$mail);  
	  $DomaineMailExiste=checkdnsrr($domaine,'MX');  
	  if(!$DomaineMailExiste){
	    $erreur = 5 ; //le domaine de l'adresse mail n'existe pas  
	    }
	  else {  
	  //verification de lunicité du pseudo et du mail
		  // Si c'est bon on regarde dans la base de donnée si le nom de compte est déjà utilisé :
	    //Check avec les données déjà présentes
	  $recherche_1 = "SELECT COUNT(id) AS nb_pseudo FROM Tusers  WHERE pseudo = '".$pseudo."'";
	  $recherche_pseudo = $bdd->query($recherche_1);
	  $doublon_pseudo = $recherche_pseudo->fetch(PDO::FETCH_ASSOC);  
	  // Affichage du résultat   
	  $nb_pseudo = $doublon_pseudo['nb_pseudo']; 
	  $recherche_pseudo->closeCursor();
	  
	  // Si c'est bon on regarde dans la base de donnée si le nom de compte est déjà utilisé :
	    //Check avec les données déjà présentes
	  $recherche_2 = "SELECT COUNT(id) AS nb_mail FROM Tusers  WHERE mail = '".$mail."'";
	  $recherche_mail = $bdd->query($recherche_2);
	  $doublon_mail = $recherche_mail->fetch(PDO::FETCH_ASSOC);  
	  // Affichage du résultat   
	  $nb_mail = $doublon_mail['nb_mail']; 
	  $recherche_mail->closeCursor();
	  
	  //si le mail et le speudo n\existe pas
		  if (($nb_pseudo==0) and ($nb_mail==0)){
		  
		  // Si tout ce passe correctement, on peut maintenant l'inscrire dans la base de données :
			  
			      //inscription
			    //preparation de envoi 2 dONE
				//ajouter les verif de syntaxe//
			    $new_vote = $bdd->prepare('INSERT INTO Tusers(mail, nom, prenom, pseudo, pos, ip, AmiH, AmiD, AmiB, AmiG) 
			    VALUES(:mail, :nom, :prenom, :pseudo, :pos, :ip, :AmiH, :AmiD, :AmiB, :AmiG)');


			    $new_vote->execute(array(
			    'mail' => $mail,
			  'nom' => $nom,
			  'prenom' => $prenom,
			  'pseudo' => $pseudo,
			  'pos'	=> $posDefo,
			  'ip' => $ip,
			  'AmiH' => $AmiHdefo,
			  'AmiD' => $AmiDdefo,
			  'AmiB' => $AmiBdefo,
			  'AmiG' => $AmiGdefo ))
			    
			    or die(print_r($new_vote->errorInfo()));
			    $new_vote->closeCursor();//on ferme la req de nouvel article//
			    
			    
			    
			    //INSCRIPTION OK
			  $inscription = true;
			  //SESSION ACTIVE
				$_SESSION['groupe']= 1;
				$_SESSION['pseudo']=$pseudo;
				/* INFOS USER par SQL dans array $user */
				$recherche_user = "SELECT id, pseudo FROM Tusers WHERE pseudo = '".$_SESSION['pseudo']."'";
				if ($recherche_infos = $bdd->query($recherche_user)){
				  $infos_user = $recherche_infos->fetch(PDO::FETCH_ASSOC);  
				  // Affichage du résultat    
					$user = [
						"id" 		=> $infos_user['id'],
						"pseudo" 	=> $infos_user['pseudo']
						];
					 $recherche_infos ->closeCursor();
			 	
			 	
			 	//INITIALISATION de la POSITION USER sur sa propre position
			 	$new_pos = $bdd->prepare("UPDATE Tusers SET pos = :pos WHERE id = :id");
			    $new_pos->execute(array(
			    'pos' => $user['id'],
			    'id' => $user['id']
			    ))
			    or die(print_r($new_pos->errorInfo()));
			    $new_pos->closeCursor();//on ferme la req de nouvo fond//
			   
				$user["pos"] = $user['id'];
			 	
				// CIBLE DOSSIER USER 
				$upload_target = $dirUpload.'/'.$user["id"];  //  Repertoire cible
				$upload_target2 = $dirUpload.'/'.$user["id"].'/MINI';   // Repertoire cible 2 Mini

				}
					
					/************************************************************
					 * Creation du repertoire cible si inexistant !is_dir(TARGET)
					 *************************************************************/
					 
				 
					if(is_dir($upload_target)){
					$file_crea = 1;
					}
					else { 
						if( !mkdir($upload_target, 0755)){
						$file_crea = 2;
						}
						else{	
							
							copy("IMG/index.php", $upload_target."/index.php");
							copy("IMG/defaut.png", $upload_target."/defaut.png");
							$file_crea = 10;
							if(!is_dir($upload_target2)){

								  if( !mkdir($upload_target2, 0755) ) {
									$file_crea = 4;
								  }
								  else{	copy("IMG/index.php", $upload_target2."/index.php");
										$file_crea = 100;
										}
							}
							else {$file_crea = 3;}
						}
					}
					
				
		    }
		    //il existe des risque de doublon
		    else {$inscriptionOK = false;}
		  }   
	  
	  
	    }
	    else
	      {  
		$erreur = 3; //pb de mail
	      }  
	    }  
    }
  }
  }
  else { $registerOK = false;}

