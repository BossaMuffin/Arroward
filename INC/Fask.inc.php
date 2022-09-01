<script type="text/javascript">
   function Fask(nom_form, nom_input, quoi) {
       var saisie = prompt("Pour plus de sécurité, veuillez reproduire le cryptogramme suivant : \n      '" + quoi+"'", "???");
       if (saisie == quoi) {
       //on vérifie la possibilité de pseudo en vérifiant les doublon pseudo potentiel
	      document.forms[nom_form].elements[nom_input].value="ok";
	      alert('Cryptogramme correct');
	    }
       else {
	  document.forms[nom_form].elements[nom_input].value="empty";
	  alert('Cryptogramme incorrect !!! Echec ... ');
	  }
   }
   
   function new_pseudo(nom_form, nom_input, quoi) {
	var saisie = prompt("Votre pseudo par défault est : ' ' \n Veuillez choisir un pseudo à votre image'", "Votre nouveau pseudo");
       if (saisie != "") {
       //on vérifie la possibilité de pseudo en vérifiant les doublon pseudo potentiel
	     
	      document.forms[nom_form].elements[nom_input].value= saisie;
	       alert('Pseudo ok');
	    }
       else {
	/*  document.forms[nom_form].elements[nom_input].value="empty";*/
	  alert('Pseudo vide');
	  }
   }
   
</script>
