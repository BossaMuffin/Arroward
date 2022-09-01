<?php session_start();
	
	/* BDD */
	require("INC/BDD.php");
	
		
	
/* ****FONCTIONS PHP ***** */
	// verife la session, renvoi un booleen
		 require("INC/Fuser_verified.inc.php");
		 
	// Fonction de contage dans le dossier DIR - count_files($chemin)
		 require("INC/Fcount_files.inc.php");
		 
	// Fonction de redimensionnement IMG dossier DIR - 
	//                           darkroom($img, $to, $width = 0, $height = 0, $useGD = TRUE)
		 require("INC/Fredim_image.inc.php");
		 
	// QUELLE IMG ? donne le tablo name_files avec le path du dossier
		 require("INC/Fname_files.inc.php");
		 
	// Transforme une url dans le texte chat en lien cliquable
		 include("INC/Furl_link.inc.php");
		 
	// Transforme un smiley en smiley img + Furl_link
		 require("INC/Fparse_text.inc.php");
	
	
	//UPLOAD
		$dirUpload = 'IMG/UPLOAD';
		$file_crea = 0;
		
/* ****  DEFO ***** */
		//fond par defo
		$img_path_user = 'IMG/fond1.jpeg';
		//Position pos par defaut
		$posDefo = 85 ;
		$AmiHdefo = 85 ;
		$AmiDdefo = 85 ;
		$AmiBdefo = 85 ;
		$AmiGdefo = 85 ;
		
		$positionUser["pos"] = $posDefo ;
	
	
/****** Script CONTROLE CONNEXION BDD *************/
	require("INC/connexion.inc.php");
/****** Script CONTROLE INSCRIPTON BDD *************/
	require("INC/register.inc.php");
	
	

/****** header location Purge des POST / FILE  dans SESSION ************ */
	
/*	include("INC/rafraischissement.inc.php");*/
	
	
/*****VAR META***/
	/*url racine */
	$url="http://arroward.comozone.com/";
	/*url de la page*/
	$page="index.php";
	/*nom de la page*/
	$nomPage="PAGE1";
	/*description courte */
	$descriptionPage="...";
	/*Mots clefs de la page*/
	$motClefPage="..., ...";
	/* gestion de la navigation et de lindexage des robots 
		 1= index/follow
		 2= NOindex/follow
		 3=index/NOfollow
		 0=NOindex/NOfollow
	*/
	$page_index = 0;
	
	
	
	
/****** VAR NAV *************/
	include("INC/liensNav.inc.php");
	
	
	
/*** VAR ENVIRONEMENT *********/
	
	
		 
	// Script SESSION GROUPE script aiguillage session - config donnees users/img - $sessionType //
	 require("INC/session.inc.php"); 

	//-- -------------------------------  No CONNECTED -------------------------- -->
	if (isset($sessionType)){
		if ($sessionType == 1){
			require_once("JBBCode/Parser.php");
		}
	}

	//Demande dAJOUT AMI
	/* Traitement Method post pour BDD 
	 * -> gestion Ami et demande (annule, accpet, refuse) */
	 include("INC/ajout.inc.php");
	

	// Script POSITION definition - miniatures
	
		/* $positionUser["pos"] = $user["pos"] id de visite VARIABLE  : $user["pos"] trouve dans session.inc
		 *
		 */
	 require("INC/position.inc.php"); 
		
		
	
	// script LIKER //
	 include("INC/like.inc.php"); 
	
	// script UPLOADER //
	 include("INC/upload.inc.php"); 
	
	 

/* **** VAR IMAGES ***** */
	/* on récupère les infos de limage de fond du mur de la POS de NAV */
	/* la plus grande mesure entre HEIGHT et WIDTH sera la grandeur à 100% (dans le CSS) pour laffichage  */
	list($fondWidth, $fondHeight, $fondType, $fondAttr) = getimagesize($positionUser["fond"]);
	$fondVertical = false;
	$fondWidth100 = 100;
	$fondHeight100 = 100;
	$fondLeft100 = 0;
	$fondTop100 = 0;
	
	if($fondWidth <= $fondHeight){ 
		$fondVertical = true; 
		$fondWidth100 = ($fondWidth/$fondHeight)*100; 
		$fondWidth100 = number_format($fondWidth100,2);
		$fondLeft100 = (100-$fondWidth100)/2;
	}else{
		$fondVertical = false; 
		$fondHeight100 = ($fondHeight/$fondWidth)*100; 
		$fondHeight100 = number_format($fondHeight100,2);
		$fondTop100 = (100-$fondHeight100)/2;
	}
		
	
?>
<!-- Fin VARIABLES -->


<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo $nomPage;?></title>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--<meta http-equiv="content-language" content="fr-FR" />-->
		 <meta name="email" content="coz.web@comozone.com">
		<meta name="author" content="Jean-Eudes Méhus - Agence ComOZone">
		<meta name="publisher" content="Agence ComOZone">
		<meta name="language" content="fr-FR" />
		<meta name="description" <?php echo 'content="'.$descriptionPage.'"';?> />
		<!-- Mot clef -->
		<meta name="keywords" <?php echo 'content="'.$motClefPage.'"';?> />
		<link rel="canonical" <?php echo 'href="'.$url.$page.'"';?> />
		
		<!--STYLES-->
		<link rel="stylesheet" href="CSS/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="CSS/styleChat.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="CSS/wysibb_theme.css" media="screen" />
		<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes" />

		
		<!-- LANGUE VERSION GOOGLE -->
		<link rel="alternate" <?php echo 'href="'.$url.$page.'"';?> hreflang="x-default" />
		<link rel="alternate"  <?php echo 'href="'.$url.$page.'"';?> hreflang="fr" />
				
		<?php 
		/*gestion de la navigation et de lindexage des robots 
		 --> voir $page_index dans VARIABLES */
		  include("INC/index_follow.inc.php"); 
		?>
		
		<!-- MOUCHARD -->
		
		 <?php // include("INC/analyticstracking.inc.php"); ?> 
		 
		 <!-- validation Bing
		 <meta name="msvalidate.01" content="9624339056C30092180B78698C554970" />    -->
		<!-- JQUERY ACTUALISE AUTO :  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
		 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		 <script src="JS/jquery.min.js"></script>
		 <script type="text/javascript" src="JS/fonctions.js"></script>
		<!-- <script type="text/javascript" src="JS/ready.js"></script> -->
		<!-- <script src="chat.js"></script> -->
		 <script>
			 $(function(){
				 window.onload=function()
				{
				/* adaptation du fond */
				/*echo '
				$(\'#background\').removeClass(\'largeur0\');
				$(\'#background\').addClass(\'hauteur0\');
				';*/
				var background=document.getElementById('background');
				<?php echo '
					background.style.width=\''.$fondWidth100.'%\';
					background.style.height=\''.$fondHeight100.'%\';
					background.style.top=\''.$fondTop100.'%\';
					background.style.left=\''.$fondLeft100.'%\';
					
					';
				?>	
				};	
			});	
		</script>
		 <?php include("INC/Fask.inc.php"); ?>
		 <!-- ------------------------------- SSI CONNECTED -------------------------- -->	
		<?php if (isset($sessionType)){
					if ($sessionType == 0){
						//WysiBB
						echo '
							<script src="JS/jquery.wysibb.min.js"></script>
							<script src="/FONT/langues/wysibb_fr.js"></script>
							<script>
								$(document).ready(function() {	  
									 var wbbOpt = {
										lang : 	 "fr",
										buttons: "bold,italic,underline,|,img,link,|,code,quote",
										allButtons: {
										img: {
										  hotkey: "ctrl+shift+5"
										},
										link: {
										  hotkey: "ctrl+shift+k"
										}
										//hotkeys: false, disable hotkeys (native browser combinations will work)
										//showHotkeys: false hide combination in the tooltip when you hover.
										}
									}
									$("#wysifile").wysibb(wbbOpt);
					
									
									
								});


							</script>
						
						';
		 
				}
			}
		?>
		 
	</head>
	
	
	<body>
		
			<!-- -------------------------------  No CONNECTED -------------------------- -->
			<?php 
				if (isset($sessionType)){
					if ($sessionType == 0){
						require("INC/Slog0.inc.php");
				}
			}
			 ?> 
			
			<!-- ------------------------------- Fin No CONNECTED -------------------------- -->
			
			
			<!-- ------------------------------- SSI CONNECTED -------------------------- -->
			
			<?php if (isset($sessionType)){
					if ($sessionType == 1){
						require("INC/Slog1.inc.php");
				}
			}
			 ?> 
			 
			<!-- ------------------------------- Fin ssi CONNECTED -------------------------- -->
			
	
		
		
		<!-- PAGE fullscreen ARCHIVES/DEMANDES active sur demande -->
		<div id="page2" class="bordure fondNoir">ARCHIVES
		
		</div>
		<!-- FIN PAGE 1 : environnement ARCHIVES / DEMANDES -->

		
		
	</body>
</html>
