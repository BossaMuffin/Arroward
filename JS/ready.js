<script>$(document).ready(function(){
	//AJAX pour les CHATS
	$('#form_message').submit(function(){
		var chat_ctrl = $('.chat_ctrl').val();
		var chat_message = document.forms["general"].elements["champ1"].val();
		alert(chat_ctrl + chat_message + 'ok');
		$.post('envMess.php', {chat_ctrl:chat_ctrl, chat_message:chat_message}, function(donnees){
			$('.afficher').text(donnees);
		}); 
		$.ajax({
			url: 'envMess.php', 
			cache: false,
			success: function(html){
				alert("c ok AJAX" + chat_ctrl + chat_message);
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					alert(textStatus);
				}
		})
	return false; 
	});
});
