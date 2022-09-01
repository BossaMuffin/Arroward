<?php
function Fparse_text($content) {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a href="$0" target="_blank">$0</a>', $content);
	// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
		$content = preg_replace('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a href="http://www.$1" target="_blank">www.$1</a>', $content);
		//preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);
	}

	// Insérez vos smiley ici, dans le premier tableau smiliesName
	// Et dans la colonne correpsondante du second tableau smiliesUrl	
	// Indiquez le nom de l'image
	
	$smiliesName = array(':mad', ':crise', ':exclamation', ':question', ':web', ':gauche', ':bas', ':droite', ':haut', ':no', ':copyright', ':nuclear', ':peace', ':recyle', ':x', ':ok', ':peur',':oops', ':love', ':music', ':\\$', ':blank',':colere:', ':\'\\(', ':waw:', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh', ':\\(', ':o', ':vampire', 'o_O', '\\^\\^', ':\\-@');
	$smiliesUrl  = array( 'mad.gif', 'crise.gif', 'exclamation.gif', 'question.gif', 'arobas.gif', 'gauche.gif', 'bas.gif', 'droite.gif', 'haut.gif', 'interdit.gif', 'copyright.gif', 'nuclear.gif', 'yingyang.gif', 'recycled.gif', 'x.gif', 'mark.gif',  'peur.gif', 'oops.gif', 'love.gif', 'music.gif', 'dolar.gif', 'blank.gif','colere.gif', 'dead.gif', 'waw.gif', 'smile.gif', 'biggrin.gif', 'sunglass.gif', 'dum.gif', 'laugh.gif', 'thinking.gif', 'cry.gif', 'shock.gif', 'vampire.gif', 'sick.gif', 'happy.gif', 'smoke.gif');
	$smiliesPath = "http://www.arroward.comozone.com/IMG/smilies/Orange/";

	for ($i = 0, $c = count($smiliesName); $i < $c; $i++) {
		$content = preg_replace('`' . $smiliesName[$i] . '`isU', '<img src="' . $smiliesPath . $smiliesUrl[$i] . '" alt="smiley" />', $content);
	}
	
	$content = stripslashes($content);
	return $content;
}
