<script>

$(document).ready(function(){
	//AJAX pour les CHATS
	$('#<?php echo $chat_name.'_form' ; ?>').submit(function(){
		var chat_ctrl = $('#<?php echo $chat_name.'_ctrl' ; ?>').val();
		var chat_message = $('#<?php echo $chat_name.'_message' ; ?>').val();
		
		$.post('envMess.php', {chat_ctrl:chat_ctrl, chat_message:chat_message}, function(html){
			$('#<?php echo $chat_name.'_retour' ; ?>').html(html);
		}); 
		/*$.ajax({
			url: 'envMess.php', 
			cache: false,
			success: function(html){
				
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					alert(textStatus);
				}
		})
		*/
	return false; 
	});
	
	
});

function load_messages_<?php echo $chat_name ; ?>(){
		var chat_ctrl = $('#<?php echo $chat_name.'_ctrl' ; ?>').val();
		$.post('recMess.php', {chat_ctrl:chat_ctrl}, function(html2){
			//alert(html2);
		$('#messages_<?php echo $chat_name ; ?>').html(html2);
		})
	}
	setInterval('<?php echo "load_messages_".$chat_name."()" ; ?>', 500);
/*
function afficher_<?php echo $chat_name.'_retour' ; ?>(data){
	alert('fonction ok');
	$('#<?php echo $chat_name.'_retour' ; ?>').fadeOut(500, function(){
	$('#<?php echo $chat_name.'_retour' ; ?>').empty();
	$('#<?php echo $chat_name.'_retour' ; ?>').append(data);
	$('#<?php echo $chat_name.'_retour' ; ?>').fadeIn(1000);
})
	*/

</script>
