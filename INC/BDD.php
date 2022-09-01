<?php 
try {
  $bdd= new PDO('mysql:host=ThePathToDb;dbname=TheDbName', 'YourDblogin', 'YourPassword'); 
}
catch(Exception $e) {
  die('Erreur:'.$e->getMessage());
}

