<script>
		<?php
		//France = VRAI ou FAUX
		// GEOLOC = VRAI ou FAUX
		$france = true ;
		$geoloc = false ;
		
		// LOCALISATION DEJA FAITE ?
		  if (isset($_POST['france'])){
		    $france = $_POST['france'];
		   ?>
		 /*  alert("POST FRANCE OK");*/
		   <?php
		    $geoloc = true ;
		    }
		    else {
		    $geoloc = false ;
		    }
		  ?>
		
		     //Permet à lutilisateur de stopper la geoloc
		      function stopWatch(){
		      navigator.geolocation.clearWatch(watchId);
		      document.location.href="http://www.comozone.com/fr-accueil.php" ;
		      }
		      
		      
		      
		      // détecte si le navigateur supporte ou non la geolocalisation
		      if (navigator.geolocation){
			//declenche la geoloc
			var watchId = navigator.geolocation.watchPosition(successCallback, errorCallback, {enableHighAccuracy:true});
		      }
		      else { 
		      //la geoloc nest pas possible on redirige vers la page France
		      alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
		      alert ("Bienvenue chez vous ! Welcome, to choose US version, thanks to click on flag.");
		      document.location.href="http://www.comozone.com/fr-accueil.php" ;
		      }

		    
			// cette fonction est déclencher achaque rafraichissement du GPS
		      function successCallback(position){
			// on recupere LAT et LONGITUDE
			var Lat = position.coords.latitude ;
			var Long = position.coords.longitude ;
			// on encadre le resultat pour la zone FRANCOPHONE  FRANCE : VRAI ou FAUX
			
			  /*pays concernés : France / Algérie / Andorre / belgique / benin/ Burkina Faso / burundi / cameroun / Canada / 
			  RCA / iles Comores / congo
			  Cote divoir / Djibouti / gabon / Gouadeloupe / guinee / guyane / haiti / cambodge / laos / luxembourg / Liban /
			  madagascar / martinique / Maurice / Mauritanie
			  Mayotte / Monaco / Niger / Nouvelle Cal / Polynésie / Rwanda / Réunion /
			  sénégal / seychelles / Saint Pierre et Miquelon / Suisse /
			  Togo / Tunisie / Vanautu / Vietnam / Wallis et Futuna / Zaire 
			  
			  DECOUPAGE DES ZONES FRANCOPHONES 
			  
Zone Géo				Longitude		Latitude	
Référence	Nom			x min	x max	y min	y max

E1		Canada			-66	-47	40	60
E2		Haïti			-75	-70	17	20
E3		Caraïbes		-65	-60	10	20
E4		Guyane			-55	-50	2	7
E5		Clipperton		-120	-105	0	15
E6		Marquises		-145	-133	-14	-7
E7		Polynésie		-155	-133	-30	-14
E8		Liban			33	35	32	35
E9		Maghreb			-15	10	22	37
E10		Sahara			-20	25	5	20
E11		Afrique centrale	0	30	-12	5
E12		Djibouti		43	45	10	12
E13		Seychelles		48	60	-7	0
E14		Madagascar nord		42	60	-20	-7
E15		Madagascar sud		37	60	-26	-20
E16		Siam Nord		100	110	17	22
E17		Siam Sud		103	110	7	17
E18		Vanuatu			162	172	-20	-14
E19		Wallis et Futuna	180	185	-15	-12
E20		Nouvelle Calédonie	162	180	-25	-20
E21		Saint – Paul		70	90	-45	-33
E22		Kerguelen		45	90	-50	-45
E23		Méditerranée		-15	10	37	43
E24		France			-7	10	43	52
E25		Europe Est		10	30	35	50	  
			  */
			  
			var result = ((Long < (-47) && Long > (-66) &&  Lat < 60 && Lat > 40 )
			/* E2 */
			|| (Long < (-70) && Long > (-75) &&  Lat < 20 && Lat > 17)
			/* E3 */
			|| (Long < (-60) && Long > (-65) &&  Lat < 20 && Lat > 10)
			/* E4 */
			|| (Long < (-50) && Long > (-55) &&  Lat < 7 && Lat > 2 )
			/* E5 */
			|| (Long < (-105) && Long > (-120) &&  Lat < 15 && Lat > 0 )
			/* E6 */
			|| (Long < (-133) && Long > (-145) &&  Lat < (-7) && Lat > (-14) )
			/* E7 */
			|| (Long < (-133) && Long > (-155) &&  Lat < (-14) && Lat > (-30) )
			/* E8 */
			|| (Long < 35 && Long > 33 &&  Lat < 35 && Lat > 32 )
			/* E9 */
			|| (Long < 10 && Long > (-15) &&  Lat < 37 && Lat >22 )
			/* E10 */
			|| (Long < 25 && Long > (-25) &&  Lat < 20 && Lat > 5 )
			/* E11 */
			|| (Long < 30 && Long > 0 &&  Lat < 50 && Lat > (-12) )
			/* E12 */
			|| (Long < 45 && Long > 43 &&  Lat < 12 && Lat > 10 )
			/* E13 */
			|| (Long < 68 && Long > 48 &&  Lat < 0 && Lat > (-7) )
			/* E14 */
			|| (Long < 60 && Long > 42 &&  Lat < (-7) && Lat > (-20) )
			/* E15 */
			|| (Long < 60 && Long > 37 &&  Lat < (-20) && Lat > (-26) )
			/* E16 */
			|| (Long < 110 && Long > 100 &&  Lat < 22 && Lat > 17 )
			/* E17 */
			|| (Long < 110 && Long > 103 &&  Lat < 17 && Lat > 7 )
			/* E18 */
			|| (Long < 172 && Long > 162 &&  Lat < (-14) && Lat > (-20) )
			/* E19 */
			|| (Long < 185 && Long > 180 &&  Lat < (-12) && Lat > (-15) )
			/* E20 */
			|| (Long < 180 && Long > 162 &&  Lat < (-20) && Lat > (-25) )
			/* E21 */
			|| (Long < 90 && Long > 70 &&  Lat < (-33) && Lat > (-45) )
			/* E22 */
			|| (Long < 90 && Long > 45 &&  Lat < (-45) && Lat > (-50) )
			/* E23 */
			|| (Long < 30 && Long > (-30) &&  Lat < 43 && Lat > 37 )
			/* E24 */
			|| (Long < 10 && Long > (-7) &&  Lat < 52 && Lat > 43 )
			/* E25 */
			|| (Long < 30 && Long > 10 &&  Lat < 50 && Lat > 35 )
			);
			if (result){
			alert( "Bonjour cher visiteur, voilà tes coordonnées GPS : (Lat)"+Lat+" ; (Long)"+Long+".");  
			 document.location.href="http://www.comozone.com/fr-accueil.php";
			 
			}
			else {
			 // alert( "Hello world, your GPS location : (Lat)"+Lat+" ; (Long)"+Long+".");
			  document.location.href="http://www.comozone.com/us-home.php" ;
			}
		      
		      };
		    
		    
		    // si la fonction ne repond pas
		    function errorCallback(error){
		      switch(error.code){
			case error.PERMISSION_DENIED:
			  alert("Vous n'avez pas autorisé l'accès à votre position.");
			  break;      
			case error.POSITION_UNAVAILABLE:
			  alert("Votre emplacement n'a pas pu être déterminé");
			  break;
			case error.TIMEOUT:
			  alert("Le service GPS n'a pas répondu à temps");
			  break;
			}
			alert ("Bienvenue chez vous ! WellCom, to choose US version, thanks to click on flag.");
			document.location.href="http://www.comozone.com/fr-accueil.php" ;
		    };
		    
		    <?php
			    //GEOLOC indique la lang du navigateur
			    $langNav = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
			    $ip = $_SERVER['REMOTE_ADDR'];
			    //envoi de la reponse sur mail pour reportoire LANG NAV
			   //  mail("epervans@hotmail.fr", $langNav, $ip , "COZsite");
			  ?>
		    setTimeout(function() {
		    document.location.href="http://www.comozone.com/fr-accueil.php" ;
		    }, 15000);
		</script>
