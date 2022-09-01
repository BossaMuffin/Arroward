<?php
      if ($registerOK){
      //sil a repondu au formulaire, on vérifie les variables derreur
	    echo '<p><span class="rouge">';
	    if (!$ctrl_ok){
	      echo 'Erreur cryptogramme ; ';
	      }
	    if ($cpx_vides){
	      echo '3 champs vides ; ';
	      }
	    if ((!$mail1_ok)or(!$mail2_ok)){
	      echo 'Veuillez inscrire votre mail afin d\'être admis ; ';
	    }
	    if (!$nom_ok){
	      echo 'Bug Nom ; ';
	    }
	    if (!$prenom_ok){
	      echo 'Bug Prénom ; ';
	    }
	    if (!$mail_ok){
	      echo 'Bug Mail ; ';
	    }
	    if (!$pseudo_ok){
	      echo 'Bug Pseudo ; ';
	    }
	    else if ($erreur==1){
	      echo 'Les 3 champs sont vides ;';
	      }
	    else if ($erreur==2){
	      echo 'Renseignez tous les champs ;';
	      }
	    else if ($erreur==3){
	      echo 'Le mail renseigné est invalide ;';
	      }
	    else if ($erreur==5){
	      echo 'Le domaine mail est incorrecte ;';
	      }
	    if (!$inscriptionOK){
	      if (($nb_mail!=0)or($nb_pseudo !=0)){
		if ($nb_mail !=0){
		echo 'Mail déjà inscrit ;';
		  }
		if ($nb_pseudo !=0){
		    echo 'Pseudo déjà pris ;';
		  }
		}
		else {
		  echo 'Une erreur est survenue sur votre pseudo et votre mail ;</li>';
		  }
	    }
	    echo  '<span>';
	    if ($inscriptionOK and $inscription){
	      echo 'Vous vous êtes correctement inscrit. Vous recevrez un mail afin de confirmer votre admission;</li>';
	    }
	    echo  '</p>';
	    
	    }   
	    
