
<?php
// On regarde si l'utilisateur est bien passé par le module d'inscription
	 if(isset($register0K)){
		require("JS/AJAXcaptcha.inc.php");
	    if($registerOK and (!$inscription or !$inscriptionOK)){
	      // affiche le formulaire d'admission aves variables intégrées
	      

			echo '<h2>Admission</h2><form action="#" method="post">
						<table>
						
					  <tr>
					<td><label for="nom" ><strong>Votre nom :</strong></label></td>
					<td><input type="text" name="nom" id="nom" value="'.$nom.'"/></td>
					  </tr>
					  
					  <tr>
					<td><label for="prenom"><strong>Prenom :</strong></label></td>
					<td><input type="text" name="prenom" id="prenom" value="'.$prenom.'"/></td>
					  </tr>
					  
					   <tr>
					<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
					<td><input type="text" name="pseudo" id="pseudo" value='.$pseudo.'/>
					  </tr>
					  
					  <tr>
					<td><label for="mail1"><strong>Votre @ mail :</strong></label></td>
					<td><input type="mail" name="mail1" id="mail1" value="'.$mail1.'" /></td>
					  </tr>
					  
					  <tr>
					<td><label for="mail2"><strong>Confirmeation:</strong></label></td>
					<td><input type="mail" name="mail2" id="mail2" value="'.$mail2.'" /></td> 
					  </tr>
					  
					  </table>
					  <input type="hidden" value="" name="img_ctrl" />
					  <input type="submit" name="register" value="Envoyer" 
					  onclick="
					   Fask(\'petition\', \'img_ctrl\', \'1789\'); 
						  "
					  />
				   
					</form>'; 
		}
	    elseif (!$registerOK){
	      //le fomulaire d'admission nest pas encore rempli
	             //formulair d'admission
		echo '<h2>Admission</h2><form action="#" name="petition" method="post">
					<table>
					
				  <tr>
				<td><label for="nom"><strong>Votre nom :</strong></label></td>
				<td><input type="text" name="nom" id="nom" value="'.$nom.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="prenom"><strong>Prenom :</strong></label></td>
				<td><input type="text" name="prenom" id="prenom" value="'.$prenom.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
				<td><input type="text" name="pseudo" id="pseudo" value="'.$mail1.'"/></td>
				  </tr>
				  
				  <tr>
				  </tr>
				  
				  <tr>
				<td><label for="mail1"><strong>Votre @ mail :</strong></label></td>
				<td><input type="mail" name="mail1" id="mail1" value="'.$mail1.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="mail2"><strong>Confirmation :</strong></label></td>
				<td><input type="mail" name="mail2" id="mail2" value="'.$mail2.'"/></td> 
				  </tr>
				  
				  </table>
				  <input type="hidden" value="" name="img_ctrl" />
				  <input type="submit" name="register" value="Envoyer" 
				  onclick="
				   Fask(\'petition\', \'img_ctrl\', \''.$captcha.'\'); 
					  "
				  />
			   
				</form>';
	      }
	  elseif ($inscriptionOK and $inscription) {
	    echo '<h2>Admission</h2><br/>Votre compte est valide.';
		  
		  }
	  else { 
	      // affiche le formulaire de pétition
	      	             //formulair d'admission
		echo '<h2>Admission</h2><form action="#" name="petition" method="post">
					<table>
					
				  <tr>
				<td><label for="nom"><strong>Votre nom :</strong></label></td>
				<td><input type="text" name="nom" id="nom" value="'.$nom.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="prenom"><strong>Prenom :</strong></label></td>
				<td><input type="text" name="prenom" id="prenom" value="'.$prenom.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
				<td><input type="text" name="pseudo" id="pseudo" value="'.$mail1.'"/></td>
				  </tr>
				  
				  <tr>
				  </tr>
				  
				  <tr>
				<td><label for="mail1"><strong>Votre @ mail :</strong></label></td>
				<td><input type="mail" name="mail1" id="mail1" value="'.$mail1.'"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="mail2"><strong>Confirmation :</strong></label></td>
				<td><input type="mail" name="mail2" id="mail2" value="'.$mail2.'"/></td> 
				  </tr>
				  
				  </table>
				  <input type="hidden" value="" name="img_ctrl" />
				  <input type="submit" name="register" value="Envoyer" 
				  onclick="
				   Fask(\'petition\', \'img_ctrl\', \''.$captcha.'\'); 
					  "
				  />
			   
				</form>';
	  }       
	}
	else { 
		 $captcha = rand(10000, 999999);
	    //le fomulaire de pétition nest pas encore rempli
	    	             //formulair d'admission
		echo '<h2>Admission</h2><form action="#" name="petition" method="post">
					<table>
					
				  <tr>
				<td><label for="nom"><strong>Votre nom :</strong></label></td>
				<td><input type="text" name="nom" id="nom"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="prenom"><strong>Prenom :</strong></label></td>
				<td><input type="text" name="prenom" id="prenom"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
				<td><input type="text" name="pseudo" id="pseudo"/></td>
				  </tr>
				
				  <tr>
				<td><label for="mail1"><strong>Votre @ mail :</strong></label></td>
				<td><input type="mail" name="mail1" id="mail1"/></td>
				  </tr>
				  
				  <tr>
				<td><label for="mail2"><strong>Confirmation :</strong></label></td>
				<td><input type="mail" name="mail2" id="mail2"/></td> 
				  </tr>
				  
				  </table>
				  <input type="hidden" value="" name="img_ctrl" />
				  <input type="submit" name="register" value="Envoyer" 
				  onclick="
				  Fask(\'petition\', \'img_ctrl\', \''.$captcha.'\'); 
					  "
				  />
			   
				</form>';
	}       
	


