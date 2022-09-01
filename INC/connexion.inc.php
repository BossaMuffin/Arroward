  <?php
  // On met les variables utilisé dans le code PHP à FALSE (C'est-à-dire les désactiver pour le moment).
  $idOK = false;
 // $ligne_conex = 0; // nombre de ligne de la reponse à la requete
  $nb_couple = 0;
  
  // CONNEXION 
    // On regarde si l'utilisateur est bien passé par le module d'inscription
    if(isset($_POST["conex"])){
		//temoin de passage au formulaire
		$nb_mail=0;
		$nb_pseudo=0;
		$erreur_conex=10;
		
		  
		//sil a repondu au formulaire, on initialise les variables
		
		$mail_conex_ok = false;
		$pseudo_conex_ok = false;
		$ctrl_conex_ok = false;
		$img_ctrl = 'empty';
		  
		// on test le cryptogramme 
		if (isset($_POST["img_ctrl_conex"])){
			$img_ctrl_conex = $_POST["img_ctrl_conex"];
			if ($img_ctrl_conex == 'ok'){
			  $ctrl_conex_ok = true;
			}
		}
		// on test le post pseudo dans prenom < 12
		if (isset($_POST["pseudo"])){
		  if(strlen($_POST["pseudo"] < 12)){
			$pseudo_conex_ok = true;
			$pseudo_conex = $_POST["pseudo"];   
			}
		}
		// test le mail
		if (isset($_POST["mail"])){
		  if(strlen($_POST["mail"] < 64)){
			$mail_conex=stripslashes(htmlentities($_POST["mail"]));  
			$mail_conex_ok=true;
		  }
		}
		
		  //si le cryptogramme est correctement rempli ...
		  if ($ctrl_conex_ok){
			if($mail_conex_ok and $pseudo_conex_ok){
			  //filtre sur nom prenom adresse
			  
			  $verif='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#'; 
			  
			  // On assigne et/ou protège nos variables  
			  $pseudo_conex=htmlspecialchars($pseudo_conex);
			  //input envoi/previsualiser   
			  //on enlève les espaces  
			  $mail_conex=trim($mail_conex);  
			  $pseudo_conex=trim($pseudo_conex);
			  //donne lip de user


			  /*On vérifie si l'e mail et le message sont pleins, et on agit en fonction.  
				(on affiche Apercu du resultat, tel ou tel champ est vide, etc...*/  

			  if(!preg_match($verif,$mail_conex))  // (empty($pseudo_conex))or( ... pour l'instant on ne mais pas se filtre car certain pseudo sont vides
				{  
					$erreur_conex = 0;
			  //Si ca ne vas pas (mal rempli, mail non valide...)  
				  //les 2 champs sont vides  
				  if(empty($mail_conex)and(empty($pseudo_conex)))  
				{  
				  $erreur_conex = 1; 
				 $mail_conex='';$pseudo_connex='';
				}  
				  //un des champs est vide  
				  elseif(empty($pseudo_conex))    
				{  
				  $erreur_conex = 2; //au moins un champs vide
				  }
				  elseif(empty($mail_conex))    
				{  
				  $erreur_conex = 3; //au moins un champs vide
				  }
				  
				}  
			  //Si les trois sont pleins et que l'adresse est valide,
			  else  
				{  
				if(preg_match($verif,$mail_conex))  
				  {
				  
				  $domaine=preg_replace('#[^@]+@(.+)#','$1',$mail_conex);  
				  $DomaineMailExiste=checkdnsrr($domaine,'MX');  
				  if(!$DomaineMailExiste){
						$erreur_conex = 5 ; //le domaine de l'adresse mail n'existe pas  
				}
				  else {  
				  //verification de lunicité du pseudo et du mail
					  // Si c'est bon on regarde dans la base de donnée si le nom de compte est déjà utilisé :
				//Check avec les données déjà présentes
				/*  $recherche_3 = "SELECT mail, pseudo FROM jesuisaussicharlie  WHERE pseudo = '".$pseudo_conex."'";
				  $recherche_pseudo_conex = $bdd->query($recherche_3) or die(print_r($recherche_pseudo_conex->errorInfo()));
				  $recherche_pseudo_conex->closeCursor();//on ferme la req de verif ID//
				while ($couple = $recherche_pseudo_conex->fetch()) {
				$ligne_conex++;
				
				}*/
				 $recherche_3 = "SELECT COUNT(id) AS nb_couple FROM Tusers 
						  WHERE mail = '".$mail_conex."' AND pseudo = '".$pseudo_conex."'";
				  $recherche_ID = $bdd->query($recherche_3);
				
				  $couple_ID = $recherche_ID->fetch(PDO::FETCH_ASSOC);  
				  // Affichage du résultat   
				  $nb_couple = $couple_ID['nb_couple']; 
				 
				   $recherche_ID ->closeCursor();
				
					if ($nb_couple ==1){ 
						$idOK = true;
						$_SESSION['groupe']= 1;
						$_SESSION['pseudo']= $pseudo_conex;
						 $erreur_conex = 11;

						 
						 
						}
						elseif ($nb_couple == 0){
						 $idOK = false;
						}
						else {$erreur_conex = 4;}
				  }
				

					  
				}
					
				}   
				  
				}
				
		}  
      }
    

/* DECONNEXION */
    else if (isset($_POST["deconex"])){
    /* On écrase le tableau de session */
      $_SESSION = array();

    /* On détruit la session */
      session_destroy(); 
    }

