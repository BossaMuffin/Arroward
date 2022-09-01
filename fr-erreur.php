

<!-- VARIABLES -->
<?php 
	/*url racine */
	$url="http://www.comozone.com/";
	
	/*url de la page*/
	$page="fr-erreur.php";
	
	/*nom de la page*/
	$nomPage="Erreur";
	
	/*description courte */
	$descriptionPage="Page de gestion des erreurs";
	
	/*Mots clefs de la page*/
	$motClefPage="erreur, erreur 401, erreur 403, erreur 404, 401, 403, 404";
	
	/* gestion de la navigation et de lindexage des robots 
		 1= index/follow
		 2= NOindex/follow
		 3=index/NOfollow
		 0=NOindex/NOfollow
	*/
	$page_index = 0;
	
	/* Lien de navigation */
	include("INC/liensNav.inc.php");
?>
<!-- Fin VARIABLES -->



<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo $nomPage;?></title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--<meta http-equiv="content-language" content="fr-FR" />-->
		 <meta name="email" content="com@comozone.com">
		<meta name="author" content="Jean-Eudes Méhus - Agence ComOZone">
		<meta name="publisher" content="Agence ComOZone">
		<meta name="language" content="fr-FR" />
		<meta name="description" <?php echo 'content="'.$descriptionPage.'"';?> />
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		
		<!-- Mot clef -->
		<meta name="keywords" <?php echo 'content="'.$motClefPage.'"';?> />
		<link rel="canonical" <?php echo 'href="'.$url.$page.'"';?> />
		
		<!--STYLES-->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" media="screen and (min-width:795px) and (max-width:1023px)" href="css/stylesTablettes.css" />
		<link rel="stylesheet" media="screen and (max-width:794px)" href="css/stylesMobiles.css" />
		
		<!-- LANGUE VERSION GOOGLE -->
		<link rel="alternate" <?php echo 'href="'.$url.$page.'"';?> hreflang="x-default" />
		<link rel="alternate"  <?php echo 'href="'.$url.$page.'"';?> hreflang="fr" />
				
		<script>
		/*
		Pour interdire le zoom
		function ch_zoom() {
			document.body.style.zoom = "100%";
			setTimeout(ch_zoom, 100);
		}*/
		</script>	
				
		<?php 
		/*gestion de la navigation et de lindexage des robots 
		 --> voir $page_index dans VARIABLES */
		  include("INC/index_follow.inc.php"); 
		?>
		
		<!-- MOUCHARD -->
		 <?php 
		 // include("INC/analyticstracking.inc.php"); 
		 ?> 
		 
		 <!-- validation Bing
		 <meta name="msvalidate.01" content="9624339056C30092180B78698C554970" />    -->
	</head>
	
	
	<body>
		
	<?php
		/* RECUPERATIOn DES INFOS d'ERREUR */
		if (isset($_GET["erreur"])) {// si il y a une erreur (variable erreur non vide)
		$erreur = $_GET["erreur"];
		$referer = getenv('HTTP_REFERER'); // on récupère l'URL de la page d'origine
		$uri = $_SERVER['REQUEST_URI']; // on récupère l'URL de la page cause de l'erreur
		$ip_visiteur = $_SERVER['REMOTE_ADDR']; // on récupère l'IP du visiteur (pour stats - facultatif)
		$date = date('d/m/y',time()); // on récupère la date de l'erreur (pour stats - facultatif)
		$heure = date('h:m:s',time()); // on récupère l'heure de l'erreur (pour stats - facultatif)

		// On décide d'envoyer cette erreur par mail : on prépare donc le contenu :
		$contenu_mail = "
		Erreur $erreur
		Le $date à $heure
		IP du visiteur : $ip_visiteur
		Page d'origine : $referer
		Lien concerné : $uri ";
		
		/* ENVOI DU COMPTE RENDU PAR MAIL*/
		mail("coz.web@comozone.com","$date : erreur $erreur",$contenu_mail,"From: Erreur <com@comozone.com>");
	}
	?>
		<a <?php echo 'href="'.$referer.'"';?>> 
			<img src="IMG/Comozone-Agence-De-Communication-2.jpeg" 
			height="100%" width="100%" alt="Erreur de navigation ... redirection en cours ..." 
			title="Agence Comozone ... Erreur de navigation ... cliquez pour atteindre notre site"/>
		</a>
	
	</body>
</html>
