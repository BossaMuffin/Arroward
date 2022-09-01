<?php
//démrage de seesion pour donnée de contact
/* session_start(); */

// on test les variable super globale, SI NON VIDE alors c'est que le formulaire a été envoyé
if(!empty($_POST) OR !empty($_FILES))
{
    // on sauvegarde POST et FILE dans la SESSION pour evité quelles soient détruit par le HEADER LOCATION
    $_SESSION['sauvegarde'] = $_POST ;

    $_SESSION['sauvegardeFILES'] = $_FILES ;

    $fichierActuel = $_SERVER['PHP_SELF'] ;

    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
    }

    
//Rafraichissement AUTOMATIQUE grace à header LOCATION
    header('Location: ' . $fichierActuel);
    exit;

}

// SI SESSION SAUVEGARDE exist alors la page vient d'être rafraichi pour l'envoie du formulaire
if(isset($_SESSION['sauvegarde']))
{
    $_POST = $_SESSION['sauvegarde'] ;
    $_FILES = $_SESSION['sauvegardeFILES'] ;
    
    // ON VIDE les SUPERGLOBALES
    unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);

}

