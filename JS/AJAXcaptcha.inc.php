
<script>
	function Fform_captcha(){
	//Captcha
		/*var chat_ctrl = $('#<?php echo $chat_name.'_ctrl' ; ?>').val();
		var chat_message = $('#<?php echo $chat_name.'_message' ; ?>').val();*/
		//AJAX
		/*$.post('captcha.php', {chat_ctrl:, chat_message:chat_message}, function(html){
			$('#<?php echo $chat_name.'_retour' ; ?>').html(html);
		}); */
		$.post('captcha.php', {}, function(html3){
		$('#<?php echo $chat_name.'_retour' ; ?>').html(html3);
		
	   $('#messages_<?php echo $chat_name ; ?>').html(html2);
	  
	  
	  
	  /* var iHaut = 100;
	   var iLarg = 200;
	   var sPage = "captcha.php";
	   ouvrePopup(sPage, iLarg, iHaut);
	   */
	}
</script>
