--
-- Structure de la table `chat_messages`
-- - message_id > L'ID du message
-- - message_user > L'ID de l'utilisateur
-- - message_time > La date d'envoi
-- - message_text > Le contenu du message
--
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `message_id` int(11) NOT NULL auto_increment,
  `message_user` int(11) NOT NULL,
  `message_time` bigint(20) NOT NULL,
  `message_text` varchar(255) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM ;


--
-- Structure de la table `chat_online`
-- - online_id > L'ID du membre connecte
-- - online_ip > Son adresse IP
-- - online_user > L'ID de l'utilisateur
-- - online_status > Pour informer les membres (ex : en ligne, absent, occupe)
-- - online_time > Pour indiquer la date de derniere actualisation
--
CREATE TABLE IF NOT EXISTS `chat_online` (
  `online_id` int(11) NOT NULL auto_increment,
  `online_ip` varchar(100) collate latin1_german1_ci NOT NULL,
  `online_user` int(11) NOT NULL,
  `online_status` enum('0','1','2') collate latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL,
  PRIMARY KEY  (`online_id`)
) ENGINE=MyISAM ;


--
-- Structure de la table `chat_annonce`
-- - annonce_id > L'ID de l'annonce
-- - annonce_text > Le contenu de l'annonce
--
CREATE TABLE IF NOT EXISTS `chat_annonce` (
  `annonce_id` int(11) NOT NULL auto_increment,
  `annonce_text` varchar(300) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`annonce_id`)
) ENGINE=MyISAM ;


--
-- Structure de la table `chat_accounts`
-- - account_id > L'ID du membre
-- - account_login > Le pseudo du membre entre 2 et 30 caractères
-- - account_pass > Le mot de passe
--
CREATE TABLE IF NOT EXISTS `chat_accounts` (
  `account_id` int(11) NOT NULL auto_increment,
  `account_login` varchar(30) collate latin1_german1_ci NOT NULL,
  `account_pass` varchar(255) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`account_id`)
) ENGINE=MyISAM ;

<link rel="stylesheet" type="text/css" href="stylechat.css">
<script src="chat.js"></script>



<div id="container">
	<h1>Mon super chat</h1>

        <!-- Statut //////////////////////////////////////////////////////// -->				
	<table class="status"><tr>
		<td>
			<span id="statusResponse"></span>
			<select name="status" id="status" style="width:200px;" onchange="setStatus(this)">
				<option value="0">Absent</option>
				<option value="1">Occup&eacute;</option>
				<option value="2" selected>En ligne</option>
			</select>
		</td>
	</tr></table>
	
	
	<table class="chat"><tr>		
	<!-- zone des messages -->
	<td valign="top" id="text-td">
            	<div id="annonce"></div>
		<div id="text">
			<div id="loading">
				<center>
				<span class="info" id="info">Chargement du chat en cours...</span><br />
				<img src="ajax-loader.gif" alt="patientez...">
				</center>
			</div>
		</div>
	</td>
			
	<!-- colonne avec les membres connectés au chat -->
	<td valign="top" id="users-td"><div id="users">Chargement</div></td>
</tr></table>


<!-- Zone de texte //////////////////////////////////////////////////////// -->
        <a name="post"></a>
    <table class="post_message"><tr>
        <td>
        <form action="" method="" onsubmit="envoyer(); return false;">
            <input type="text" id="message" maxlength="255" />
            <input type="button" onclick="envoyer()" value="Envoyer" id="post" />
        </form>
                <div id="responsePost" style="display:none"></div>
        </td>
    </tr></table>
</div>

<style>
body {
    background: #d2d2d2;
}
/* Pour que les liens ne soient pas soulignés */
a {
    text-decoration: none;
}
img {
    vertical-align: middle;
}
/* Conteneur principal des blocs de la page */
#container {
    width: 80%;
    margin: 50px auto;
    padding: 2px 20px 20px 20px;
    background: #fff;
}

/* Bloc contenant la zone de texte et bouton */
.post_message  {
    width: 95%;
    margin: auto;
    border: 1px solid #d2d2d2;
    background: #f8fafd;
    padding: 3px;
}
/* Zone de texte */
.post_message #message {
    width: 80%;
}
/* Bouton d'envoi */
.post_message #post {
    width: 18%;
}

/* La zone où sont affichés les messages
et utilisateurs connectés */
.chat {
    width: 95%;
    margin: 10px auto;
    border: 1px solid #d2d2d2;
    padding: 0px;
}
/* Bloc de chargement */
.chat #loading {
    margin-top: 50px;
}
/* Annonce */
.chat #annonce {
    background: #f8fafd;
    margin: -6px -7px 5px -7px;
    padding: 5px;
    height:20px;
    box-shadow: 8px 8px 12px #aaa;
    -webkit-box-shadow: 0px 8px 15px #aaa;
}
/* Zone des messages */
.chat #text-td {
    margin: 0px; 
    padding: 5px; 
    width: 80%; 
    background: #fff; 
}
/* Zone des utilisateurs connectés */
.chat #users-td, .chat #users-chat-td {
    margin: 0px; 
    padding: 5px; 
    width: 20%; 
    background: #ddd;
}
.chat #text, .chat #users, .chat #users-chat {
    height:500px; 
    overflow-y: auto;
}

/* Modification du statut */
.status {
    width: 95%;
    border: none;
    background: #fff;
    margin: auto;
    text-align: right;
}

.info {
    color: green;
}


</style>

<?php
function db_connect() {
	// définition des variables de connexion à la base de données	
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		// INFORMATIONS DE CONNEXION
		$host = 	'nom d\' hote';
		$dbname = 	'nom de la base';
		$user = 	'nom d\'utilisateur';
		$password = 	'mot de passe';
		// FIN DES DONNEES
		
		$db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);
		return $db;
	} catch (Exception $e) {
		die('Erreur de connexion : ' . $e->getMessage());
	}
}
?>
<?php
function user_verified() {
	return isset($_SESSION['id']);
}
?>
<?php
function urllink($content='') {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a href="$0" target="_blank">$0</a>', $content);
	// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
		$content = preg_replace('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a href="http://www.$1" target="_blank">www.$1</a>', $content);
		//preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);
	}

	$content = stripslashes($content);
	return $content;
}
?>
{
	"variable-1" : "valeur",
	"variable-2" : "valeur",
	"variable-3" : {
		"sous-variable-1" : "valeur",
		"sous-variable-2" : "valeur",
		"sous-variable-3" : "valeur"
	}
}
<?php
session_start();
include('functions.php');
// Appel de la fonction de connexion à la base de données
$db = db_connect();
?>
<?php
/* On vérifie d'abord que le compte existe, si ce n'est pas le cas, 
on s'arrête, on supprime les sessions et on renvoie 0. */
$checkUser = $db->prepare("SELECT * FROM chat_accounts WHERE account_id = :id AND account_login = :login ");
$checkUser->execute(array(
	'id' => $_SESSION['id'],
	'login' => $_SESSION['login']
));	
$countUser = $checkUser->rowCount();
if($countUser == 0) {
	// On indique qu'il y a une erreur de type unlog
	// donc que l'utilisateur connecté n'a pas de compte
	$json['error'] = 'unlog';
	// On supprime les sessions
	unset($_SESSION['time']);
	unset($_SESSION['id']);
	unset($_SESSION['login']);
} else {
	// On indique qu'il n'y a aucune erreur
	$json['error'] = '0';
	// ON PEUT CONTINUER !!!
}
$checkUser->closeCursor();

// Encodage de la variable tableau json et affichage
echo json_encode($json);
?>
<?php
// Affichage de l'annonce //////////////////////////////////////////
$query = $db->query("SELECT * FROM chat_annonce LIMIT 0,1");
while ($data = $query->fetch())
	$json['annonce'] = $data['annonce_text'];
$query->closeCursor();
?>
<?php
/* On effectue la requête sur la table contenant les messages. On récupère
les 100 derniers messages. Enfin, on affiche le tout. */

/* Si vous voulez faire appraître les messages depuis l'actualisation
de la page, laissez l'AVANT-DERNIERE ligne de la requete, sinon, supprimez-la */
$query = $db->prepare("
	SELECT message_id, message_user, message_time, message_text, account_id, account_login
	FROM chat_messages
	LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_messages.message_user
	WHERE message_time >= :time
	ORDER BY message_time ASC LIMIT 0,100
");
$query->execute(array(
	'time' => $_GET['dateConnexion']
));
$count = $query->rowCount();
if($count != 0) {
	$json['messages'] = '<div id="messages_content">';
	// On crée un tableau qui continendra notre...tableau
	// Afin de placer les emssages en bas du chat
	// On triche un peu mais c'est plus simple :D
	$json['messages'] .= '<table><tr><td style="height:500px;" valign="bottom">';
	$json['messages'] .= '<table style="width:100%">';

	$i = 1;
	$e = 0;
	$prev = 0;
	while ($data = $query->fetch()) {
		// Change la couleur dès que l'ID du membre est différent du précédent
		if($i != 1) {
			$idNew = $data['message_user'];		
			if($idNew != $id) {
				if($colId == 1) {
					$color = '#077692';
					$colId = 0;
				} else {
					$color = '#666';
					$colId = 1;
				}
				$id = $idNew;
			} else
				$color = $color;
		} else {
			$color = '#666';
			$id = $data['message_user'];
			$colId = 1;
		}


		$text .= '<tr><td style="width:15%" valign="top">';
		// Si le dernier message est du même membre, on écrit pas de nouveau son pseudo
		if($prev != $data['account_id']) {
			// contenu du message	
			$text .= '<a href="#post" onclick="insertLogin(\''.addslashes($data['account_login']).'\')" style="color:black">';
			$text .= date('[H:i]', $data['message_time']);
			$text .= '&nbsp;<span style="color:'.$color.'">'.$data['account_login'].'</span>';
			$text .= '</a>';	
		}
		$text .= '</td>';			
		$text .= '<td style="width:85%;padding-left:10px;" valign="top">';

			
		// On supprime les balises HTML
		$message = htmlspecialchars($data['message_text']); 

		// On transforme les liens en URLs cliquables
		$message = urllink($message);
			
		// Si le nom apparaît suivi de >, on le colore en orange
		if(user_verified()){
			if(preg_match('#'.$_SESSION['login'].'&gt;#is', $message)) {
				$message = preg_replace('#'.$_SESSION['login'].'&gt;#is', '<b><span style="color:orange;">'.$_SESSION['login'].'&gt;</span></b>', $message);
			}
		}
			
		// On ajoute le message en remplaçant les liens par des URLs cliquables
		$text .= $message.'<br />';
		$text .= '</td></tr>';

		$i++;
		$prev = $data['account_id'];
	}
		
	/* On crée la colonne messages dans le tableau json
	qui contient l'ensemble des messages */
	$json['messages'] = $text;

	$json['messages'] .= '</table>';
	$json['messages'] .= '</td></tr></table>';
	$json['messages'] .= '</div>';			
} else {
	$json['messages'] = 'Aucun message n\'a été envoyé pour le moment.';
}
$query->closeCursor();
?>
<?php
session_start();
include('functions.php');
$db = db_connect();
?>
<?php
// On vérifie que l'utilisateur est inscrit dans la base de données
$query = $db->prepare("
	SELECT *
	FROM chat_online
	WHERE online_user = :user 
");
$query->execute(array(
	'user' => $_SESSION['id']
));
// On compte le nombre d'entrées
$count = $query->rowCount();
$data = $query->fetch();

if(user_verified()) {
	/* si l'utilisateur n'est pas inscrit dans la BDD, on l'ajoute, sinon
	on modifie la date de sa derniere actualisation */
	if($count == 0) {
		$insert = $db->prepare('
			INSERT INTO chat_online (online_id, online_ip, online_user, online_status, online_time) 
			VALUES(:id, :ip, :user, :status, :time)
		');
		$insert->execute(array(
			'id' => '',
			'ip' => $_SERVER["REMOTE_ADDR"],
			'user' => $_SESSION['id'],
			'status' => '2',
			'time' => time()
		));
	} else {
		$update = $db->prepare('UPDATE chat_online SET online_time = :time WHERE online_user = :user');
		$update->execute(array(
			'time' => time(),
			'user' => $_SESSION['id']
		));
	}
}

$query->closeCursor();
?>
<?php
// On supprime les membres qui ne sont pas sur le chat,
// donc qui n'ont pas actualisé automatiquement ce fichier récemment
$time_out = time()-5;
$delete = $db->prepare('DELETE FROM chat_online WHERE online_time < :time');
$delete->execute(array(
	'time' => $time_out
));
?>
<?php
// Récupère les membres en ligne sur le chat
// et retourne une liste
$query = $db->prepare("
	SELECT online_id, online_id, online_user, online_status, online_time, account_id, account_login
	FROM chat_online 
	LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_online.online_user 
	ORDER BY account_login
");
$query->execute();
// On compte le nombre de membres
$count = $query->rowCount();

/* Si au moins un membre est connecté, on l'affiche.
Sinon, on affiche un message indiquant que personne n'est connecté */
if($count != 0) {
	// On affiche qu'il n'y a aucune erreur
	$json['error'] = '0';
	
	$i = 0;
	while($data = $query->fetch()) {
		if($data['online_status'] == '0') {
			$status = 'inactive';
		} elseif($data['online_status'] == '1') {
			$status = 'busy';
		} elseif($data['online_status'] == '2') {
			$status = 'active';
		}
		
		// On enregistre dans la colonne [status] du tableau
		// le statut du membre : busy, active ou inactive (occupé, en ligne, absent)
		$infos["status"] = $status;
		// Et on enregistre dans la colonne [login] le pseudo
		$infos["login"] = $data['account_login'];
		
		// Enfin on enregistre le tableau des infos de CE MEMBRE
		// dans la [i ème] colonne du tableau des comptes 
		$accounts[$i] = $infos;
		$i++;
	}
	// On enregistre le tableau des comptes dans la colonne [list] de JSON
	$json['list'] = $accounts;
} else {
	// Il y a une erreur, aucun membre dans la liste
	$json['error'] = '1';
}

$query->closeCursor();

// Encodage de la variable tableau json et affichage
echo json_encode($json);
?>


<?php
if(user_verified()) {
	if(isset($_POST['message']) AND !empty($_POST['message'])) {	
		/* On teste si le message ne contient qu'un ou plusieurs points et
		qu'un ou plusieurs espaces, ou s'il est vide. 
			^ -> début de la chaine - $ -> fin de la chaine
			[-. ] -> espace, rien ou point 
			+ -> une ou plusieurs fois
		Si c'est le cas, alors on envoie pas le message */
		if(!preg_match("#^[-. ]+$#", $_POST['message'])) {	
			$query = $db->prepare("SELECT * FROM chat_messages WHERE message_user = :user ORDER BY message_time DESC LIMIT 0,1");
			$query->execute(array(
				'user' => $_SESSION['id']
			));
			$count = $query->rowCount();
			$data = $query->fetch();
			// Vérification de la similitude
			if($count != 0)
				similar_text($data['message_text'], $_POST['message'], $percent);

			if($percent < 80) {
				// Vérification de la date du dernier message.
				if(time()-5 >= $data['message_time']) {

					// YES ! ON PEUT CONTINUER ! Ouiiiii.

				} else
					echo 'Votre dernier message est trop récent. Baissez le rythme :D';	
			} else
				echo 'Votre dernier message est très similaire.';	
		} else
			echo 'Votre message est vide.';	
	} else
		echo 'Votre message est vide.';	
} else
	echo 'Vous devez être connecté.';	
?>
<?php
// A placer à l'intérieur du if(time()-5 >= $data['message_time'])

$insert = $db->prepare('
	INSERT INTO chat_messages (message_id, message_user, message_time, message_text) 
	VALUES(:id, :user, :time, :text)
');
$insert->execute(array(
	'id' => '',
	'user' => $_SESSION['id'],
	'time' => time(),
	'text' => $_POST['message']
));
echo true;
?>
<?php
if(user_verified()) {
	$insert = $db->prepare('
		UPDATE chat_online SET online_status = :status WHERE online_user = :user
	');
	$insert->execute(array(
		'status' => $_POST['status'],
		'user' => $_SESSION['id']		
	));
}
?>
<?php
session_start();
include('phpscripts/functions.php');
$db = db_connect();
?>
<h1>Mon super chat</h1>
<?php
// permettra de créer l'utilisateur lors de la validation du formulaire
if(isset($_POST['login']) AND !preg_match("#^[-. ]+$#", $_POST['login'])) {
}

/* Si l'utilisateur n'est pas connecté, 
d'où le ! devant la fonction, alors on affiche le formulaire */
if(!user_verified()) {
?>
<div class="unlog">
	<form action="" method="post">
	Indiquez votre pseudo afin de vous connecter au chat. 
	Aucun mot de passe n'est requis. Entrez simplement votre pseudo.<br><br>
				
	<center>
		<input type="text" name="login" placeholder="Pseudo" /><br />
                <input type="password" name="pass" placeholder="Mot de passe" /><br /> 
		<input type="submit" value="Connexion" />
	</center>
	</form>
</div>
<?php
} else {
?>
<table class="post_message"><tr>
<option value="2">En ligne</option>
	</select>
	</td>
</tr></table>
<?php
	}
?>
</div>
<?php
/* On crée la variable login qui prend la valeur POST envoyée
car on va l'utiliser plusieurs fois */
$login = $_POST['login'];
$pass = $_POST['pass'];
			
// On crée une requête pour rechercher un compte ayant pour nom $login
$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login");
$query->execute(array(
	'login' => $login
));
// On compte le nombre d'entrées
$count=$query->rowCount();
			
// Si ce nombre est nul, alors on crée le compte, sinon on le connecte simplement
if($count == 0) {			
	// Création du compte
	$insert = $db->prepare('
		INSERT INTO chat_accounts (account_id, account_login, account_pass) 
		VALUES(:id, :login, :pass)
	');
	$insert->execute(array(
		'id' => '',
		'login' => htmlspecialchars($login),
		'pass' => md5($pass)
	));
				
	/* Création d'une session id ayant pour valeur le dernier ID créé
	par la dernière requête SQL effectuée */
	$_SESSION['id'] = $db->lastInsertId();
	// On crée une session time qui prend la valeur de la date de connexion
	$_SESSION['time'] = time();
	$_SESSION['login'] = $login;
} else {
	$data = $query->fetch();	
				
	if($data['account_pass'] == md5($pass)) {			
		$_SESSION['id'] = $data['account_id'];
		// On crée une session time qui prend la valeur de la date de connexion
		$_SESSION['time'] = time();
		$_SESSION['login'] = $data['account_login'];
	}
}
			
// On termine la requête
$query->closeCursor();
?>

<input type="hidden" id="dateConnexion" value="<?php echo $_SESSION['time']; ?>" />
$.ajax({
	type: "GET",
	url: "page-a-appeler.php",
	data: "valeur="+valeur+"&nom="+nom,
	success: function(msg){
		$("#bloc").html(msg);
	}
});
function insertLogin(login) {
	var $message = $("#message");
	$message.val($message.val() + login + '> ').focus();
}
var reloadTime = 1000;
var scrollBar = false;

function getMessages() {
	// On lance la requête ajax
	$.getJSON('phpscripts/get-message.php?dateConnexion='+$("#dateConnexion").val(), function(data) {
			/* On vérifie que error vaut 0, ce
			qui signifie qu'il n'y aucune erreur */
			if(data['error'] == '0') {
				// On intialise les variables pour le scroll jusqu'en bas
				// Pour voir les derniers messages
				var container = $('#text');
  				var content = $('#messages_content');
				var height = content.height()-500;
				var toBottom;

				// Si avant l'affichage des messages, on se trouve en bas, 
				// alors on met toBottom a true afin de rester en bas				
				// Il faut tester avant affichage car après, le message a déjà été
				// affiché et c'est aps facile de se remettre en bas :D
				if(container[0].scrollTop == height)
					toBottom = true;
				else
					toBottom = false;


				$("#annonce").html('<span class="info"><b>'+data['annonce']+'</b></span><br /><br />');
				$("#text").html(data['messages']);

				// On met à jour les variables de scroll
				// Après avoir affiché les messages
  				content = $('#messages_content');
				height = content.height()-500;
				
				// Si toBottom vaut true, alors on reste en bas
				if(toBottom == true)
					container[0].scrollTop = content.height();	
  
  				// Lors de la première actualisation, on descend
   				if(scrollBar != true) {
					container[0].scrollTop = content.height();
					scrollBar = true;
				}	
			} else if(data['error'] == 'unlog') {
				/* Si error vaut unlog, alors l'utilisateur connecté n'a pas
				de compte. Il faut le rediriger vers la page de connexion */
				$("#annonce").html('');
				$("#text").html('');
				$(location).attr('href',"chat.php");
			}
	});
}
function postMessage() {
	// On lance la requête ajax
	// type: POST > nous envoyons le message

	// On encode le message pour faire passer les caractères spéciaux comme +
	var message = encodeURIComponent($("#message").val());
	$.ajax({
		type: "POST",
		url: "phpscripts/post-message.php",
		data: "message="+message,
		success: function(msg){
			// Si la réponse est true, tout s'est bien passé,
			// Si non, on a une erreur et on l'affiche
			if(msg == true) {
				// On vide la zone de texte
				$("#message").val('');
				$("#responsePost").slideUp("slow").html('');
			} else
				$("#responsePost").html(msg).slideDown("slow");
			// on resélectionne la zone de texte, en cas d'utilisation du bouton "Envoyer"
			$("#message").focus();
		},
		error: function(msg){
			// On alerte d'une erreur
			alert('Erreur');
		}
	});
}
// Au chargement de la page, on effectue cette fonction
$(document).ready(function() {
	// On vérifie que la zone de texte existe
	// Servira pour la redirection en cas de suppression de compte
	// Pour ne pas rediriger quand on est sur la page de connexion
	if(document.getElementById('message')) {
		// actualisation des messages
		window.setInterval(getMessages, reloadTime);
		// on sélectionne la zone de texte
		$("#message").focus();
	}
});
function getOnlineUsers() {
    // On lance la requête ajax
    $.getJSON('phpscripts/get-online.php', function(data) {
        // Si data['error'] renvoi 0, alors ça veut dire que personne n'est en ligne
        // ce qui n'est pas normal d'ailleurs
        if(data['error'] == '0') {      
            var online = '', i = 1, image, text;
            // On parcours le tableau inscrit dans
            // la colonne [list] du tableau JSON
            for (var id in data['list']) {
                
                // On met dans la variable text le statut en toute lettre
                // Et dans la variable image le lien de l'image
                if(data["list"][id]["status"] == 'busy') {
                    text = 'Occup&eacute;';
                    image = 'busy';
                } else if(data["list"][id]["status"] == 'inactive') {
                    text = 'Absent';
                    image = 'inactive';
                } else {
                    text = 'En ligne';
                    image = 'active';
                }
                // On affiche d'abord le lien pour insérer le pseudo dans la zone de texte
                online += '<a href="#post" onclick="insertLogin(\''+data['list'][id]["login"]+'\')" title="'+text+'">';
                // Ensuite on affiche l'image
                online += '<img src="status-'+image+'.png" /> ';
                // Enfin on affiche le pseudo
                online += data['list'][id]["login"]+'</a>';
                
                // Si i vaut 1, ça veut dire qu'on a affiché un membre
                // et qu'on doit aller à la ligne           
                if(i == 1) {
                    i = 0;  
                    online += '<br>';
                }
                i++;        
            }
            $("#users").html(online);
        } else if(data['error'] == '1')
            $("#users").html('<span style="color:gray;">Aucun utilisateur connect&eacute;.</span>');
    });
}

// actualisation des membres connectés
window.setInterval(getOnlineUsers, reloadTime);
function setStatus(status) {
	// On lance la requête ajax
	// type: POST > nous envoyons le nouveau statut
	$.ajax({
		type: "POST",
		url: "phpscripts/set-status.php",
		data: "status="+status.value,
		success: function(msg){
			// On affiche la réponse
			$("#statusResponse").html('<span style="color:green">Le statut a &eacute;t&eacute; mis &agrave; jour</span>');
			setTimeout(rmResponse, 3000);
		},
		error: function(msg){
			// On affiche l'erreur dans la zone de réponse
			$("#statusResponse").html('<span style="color:orange">Erreur</span>');
			setTimeout(rmResponse, 3000);
		}
	});
}


function rmResponse() {
	$("#statusResponse").html('');
}


<?php
function urllink($content='') {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a href="$0" target="_blank">$0</a>', $content);
	// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
		$content = preg_replace('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a href="http://www.$1" target="_blank">www.$1</a>', $content);
		//preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);
	}

	$content = stripslashes($content);
	return $content;
}
?>
<?php
function parseText($content='') {
	$content = preg_replace('#(((https?://)|(w{3}\.))+[a-zA-Z0-9&;\#\.\?=_/-]+\.([a-z]{2,4})([a-zA-Z0-9&;\#\.\?=_/-]+))#i', '<a href="$0" target="_blank">$0</a>', $content);
	// Si on capte un lien tel que www.test.com, il faut rajouter le http://
	if(preg_match('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', $content)) {
		$content = preg_replace('#<a href="www\.(.+)" target="_blank">(.+)<\/a>#i', '<a href="http://www.$1" target="_blank">www.$1</a>', $content);
		//preg_replace('#<a href="www\.(.+)">#i', '<a href="http://$0">$0</a>', $content);
	}

	// Insérez vos smiley ici, dans le premier tableau smiliesName
	// Et dans la colonne correpsondante du second tableau smiliesUrl	
	// Indiquez le nom de l'image
	
	$smiliesName = array(':magicien:', ':colere:', ':diable:', ':ange:', ':ninja:', '&gt;_&lt;', ':pirate:', ':zorro:', ':honte:', ':soleil:', ':\'\\(', ':waw:', ':\\)', ':D', ';\\)', ':p', ':lol:', ':euh:', ':\\(', ':o', ':colere2:', 'o_O', '\\^\\^', ':\\-@');
	$smiliesUrl  = array('magicien.png', 'angry.gif', 'diable.png', 'ange.png', 'ninja.png', 'pinch.png', 'pirate.png', 'zorro.png', 'rouge.png', 'soleil.png', 'pleure.png', 'waw.png', 'smile.png', 'heureux.png', 'clin.png', 'langue.png', 'rire.gif', 'unsure.gif', 'triste.png', 'huh.png', 'mechant.png', 'blink.gif', 'hihi.png', 'siffle.png');
	$smiliesPath = "http://www.siteduzero.com/Templates/images/smilies/";

	for ($i = 0, $c = count($smiliesName); $i < $c; $i++) {
		$content = preg_replace('`' . $smiliesName[$i] . '`isU', '<img src="' . $smiliesPath . $smiliesUrl[$i] . '" alt="smiley" />', $content);
	}
	
	$content = stripslashes($content);
	return $content;
}
?>
<?php
if(user_verified()){
	if(preg_match('#'.$_SESSION['login'].'&gt;#is', $message)) {
		// Si le message n'a pas été lu, alors on compte
		if(!preg_match('#'.$_SESSION['id'].'#', $data['message_read'])) {
			$read = $db->prepare("
				UPDATE chat_messages
				SET message_read = :user
				WHERE message_id = :id
			");
			$read->execute(array(
				'user' => $data['message_read'].';'.$_SESSION['id'].';',
				'id' => $data['message_id']
			));
			$e++;
		}
		$message = preg_replace('#'.$_SESSION['login'].'&gt;#is', '<b><span style="color:orange;">'.$_SESSION['login'].'</span></b>', $message);
	}
}
?>
<?php
$json['messages'] .= $text;
		
$json['messages'] .= '</table>';
$json['messages'] .= '</div>';

// Dans la colonne unreads, on affiche le nombre de non lus
$json['unreads'] = $e;
?>
function playSound() {
	if(!isFocus)
		$('#soundNotification').trigger("play");
}
var isFocus = true;

$(window).focus(function() {isFocus=true});
$(window).blur(function() {isFocus=false});
// On joue un son si le nombre de messages non lus est non nul
if(data['unreads'] > 0) {
	playSound();
}


<!-- A placer n'importe où dans la page visible par les membres -->
<audio style="display:none" id="soundNotification">
	<source src="sound.ogg" type="audio/ogg" />
	<source src="sound.mp3" type="audio/mp3" />
</audio>
