		<?php include('JS/readyAJAXchat.inc.php'); ?>
				<table class="chat"><tr>        
					<!-- zone des messages -->
					<td valign="top" class="text-td bordure">
						<div class="text noir" id="<?php echo 'messages_'.$chat_name ; ?>">
							<?php 
								echo $chat_name ;
								$i = 0;
								$j = 0;
								echo "<ul>";
								while($i<$nb_message_max and !empty($user["amis"][$chat_name][$i]["message"]) ){
									echo "<li>pseudo : ".$user["amis"][$chat_name][$i]["id_env"]."<br/>
									d_ : ".$user["amis"][$chat_name][$i]['heure'].$user["amis"][$chat_name][$i]['minute'].$user["amis"][$chat_name][$i]['seconde']."<br/>
									m_ : ".$user["amis"][$chat_name][$i]['message']."<br/>";
									$j = $i;
									$i++;
									while($user["amis"][$chat_name][$j]["id_env"] == $user["amis"][$chat_name][$i]["id_env"] and $i<$nb_message_max and !empty($user["amis"][$chat_name][$i]["message"])){
										echo "
										m_ : ".$user["amis"][$chat_name][$i]['message']."<br/>";
										$j++;
										$i++;
									}
									echo "</li>";
									
								}
								echo "<li id=".$chat_name."_retour></li>";
								echo "</ul>";
								
								?>
								
							<div class="loading">
								<center>
									<span class="info">Chargement du chat en cours...</span><br />
									<img src="IMG/ajax-loader.gif" alt="patientez...">
								</center>
							</div>
						</div>
					</td>

				</tr></table>
				<!-- Zone de texte //////////////////////////////////////////////////////// -->
				<table class="post_message"><tr>
					<td>
						<form action="#" method="post" id="<?php echo $chat_name.'_form' ; ?>" name="<?php echo $chat_name.'_form' ; ?>">
							<input  type="text" placeholder="un mess ...?" name="chat_text"  id="<?php echo $chat_name.'_message' ; ?>"  maxlength="255" />
							<input type="hidden" name="chat" id="<?php echo $chat_name.'_ctrl' ; ?>" value="<?php echo $chat_name ; ?>"  />
							<input class="post submit" type="submit"  value="Envoyer"  />
						</form>
					</td>
				</tr></table>

