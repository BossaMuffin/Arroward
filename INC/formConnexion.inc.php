  <?php 
  // On regarde si l'utilisateur est bien passé par le module d'inscription

		
		if(isset($_POST['conex']) and isset($id0K)){
	    if((!$idOK) and ($mail_conex_ok or $pseudo_conex_ok)){
	      // affiche le formulaire dde connexion aves variables intégrées
			
			  echo '<h2>Connexion</h2><form action="#" name="connexion" method="post">
				<table>
					
				  <tr>
				<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
				<td><input type="text" name="pseudo" id="pseudo"/>'.$pseudo_conex.'</td>
				  </tr>
				  
				  <tr>
				<td><label for="mail"><strong>@Mail :</strong></label></td>
				<td><input type="mail" name="mail" id="mail"/>'.$mail_conex.'</td>
				  </tr>
					
				  </table>
				  <input type="hidden" value="" name="img_ctrl_conex" />
				  <input type="submit" name="conex" value="Se connecter"
				  />
				  
				</form>';
				
		}
		elseif (!$idOK and !$mail_conex_ok and !$pseudo_conex_ok){
		 
				 //formulair de connexion
				echo '<h2>Connexion</h2><form action="#" name="connexion" method="post">
						<table>
							Erreur Connexion
						  <tr>
						<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
						<td><input type="text" name="pseudo" id="pseudo"/></td>
						  </tr>
						  
						  <tr>
						<td><label for="mail"><strong>@Mail :</strong></label></td>
						<td><input type="mail" name="mail" id="mail"/></td>
						  </tr>
							
						  </table>
						  <input type="hidden" value="" name="img_ctrl_conex" />
						  <input type="submit" name="conex" value="Se connecter" 
						  />
						</form>';
		}
		elseif ($inscriptionOK and $inscription) {
				echo 'Votre compte est valide.';
		  
		}
		else {
			// affiche le formulaire de connexion
	      	             //formulair de connexion
				echo '<h2>Connexion</h2><form action="#" name="connexion" method="post">
						<table>
							
						  <tr>
						<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
						<td><input type="text" name="pseudo" id="pseudo"/></td>
						  </tr>
						  
						  <tr>
						<td><label for="mail"><strong>@Mail :</strong></label></td>
						<td><input type="mail" name="mail" id="mail"/></td>
						  </tr>
							
						  </table>
						  <input type="hidden" value="" name="img_ctrl_conex" />
						  <input type="submit" name="conex" value="Se connecter" 
						  />
						</form>';
		 }       
	}
	else { 
	    //aucune demade de connexion nest encore remplie
	    	             //formulair d'admission
				echo '<h2>Connexion</h2><form action="#" name="connexion" method="post">
						<table>
							
						  <tr>
						<td><label for="pseudo"><strong>Pseudo :</strong></label></td>
						<td><input type="text" name="pseudo" id="pseudo"/></td>
						  </tr>
						  
						  <tr>
						<td><label for="mail"><strong>@Mail :</strong></label></td>
						<td><input type="mail" name="mail" id="mail"/></td>
						  </tr>
							
						  </table>
						  <input type="hidden" value="" name="img_ctrl_conex" />
						  <input type="submit" name="conex" value="Se connecter" 
						  />
						</form>';
	}
					echo '<h2>Captcha</h2>
						<form action="" id="captcha_form" name="captcha_form" method="post">
							<table>
								  <tr>
									<td><label for=""><strong>Recopier ce message</strong></label></td>
									<td><input type="text" name="captcha" id="captcha"/></td>
								  </tr>
							  </table>
							  <input type="hidden" value="" name="img_ctrl_conex" />
							  <input type="submit" name="conex" value="verifier" 
								  onclick="
								  
								"
							  />
						</form>';
