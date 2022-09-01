<?php
 
/************************************************************
 * Script realise par Emacs
 * Crée le 19/12/2004
 * Maj : 23/06/2008
 * Licence GNU / GPL
 * webmaster@apprendre-php.com
 * http://www.apprendre-php.com
 * http://www.hugohamon.com
 *
 *************************************************************/
 
/************************************************************
 * Definition des constantes / tableaux et variables
 *************************************************************/
 
// Constantes
define('MAX_SIZE', 20000000);    // Taille max en octets du fichier
define('WIDTH_MAX', 2000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 2000);    // Hauteur max de l'image en pixels
 
// Tableaux de donnees
$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
$infosImg = array();
 
// Variables
$extension = '';
$messageUpload = '';
$nomImage = '';
 

/************************************************************
 * Script d'upload
 *************************************************************/
if(!empty($_POST))
{
	
  // On verifie si le champ est rempli
  if( !empty($_FILES['fichier']['name']) )
  {
	  
    // Recuperation de l'extension du fichier
    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

    // On verifie l'extension du fichier
    if(in_array(strtolower($extension),$tabExt))
    {
		
      // On recupere les dimensions du fichier
      $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
	
      // On verifie le type de l'image
      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
      {
		   
        // On verifie les dimensions et taille de l'image
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
        {
			
          // Parcours du tableau d'erreurs
          if(isset($_FILES['fichier']['error']) 
            && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
          {
            // On renomme le fichier
           // $nomImage = md5(uniqid()) .'-'.count_files($dirUpload).'.'. $extension;
           
			$nomImage = $user["id"].'-'.$num_imgFond ;
			
            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['fichier']['tmp_name'], $upload_target.'/'.$nomImage.'.'.$extension))
            {
				
				$new_fond = $bdd->prepare("UPDATE Tusers SET imgPath = :imgPath WHERE id = :id");
			   


			    $new_fond->execute(array(
			    'imgPath' => $upload_target.'/'.$nomImage.'.'.$extension,
			    'id' => $user['id']
			    ))
			    or die(print_r($new_fond->errorInfo()));
			    $new_fond->closeCursor();//on ferme la req de nouvo fond//
			    
		
			
              $messageUpload = 'Upload réussi !';
              $num_img_max = Fcount_files($upload_target);
			  $num_imgFond = $num_img_max+1;
			  $img_path_user = $upload_target.'/'.$nomImage.'.'.$extension;
			  $positionUser["fond"] = $img_path_user ;
			  if(Fredim_image($upload_target.'/'.$nomImage.'.'.$extension, $upload_target2.'/'.$nomImage.'mini.jpeg', $width = 100, $height = 100, $useGD = TRUE))
			  {
				$redimImage = "Redim Img Ok";  
				}else{$redimImage = "Redim Img  NOk";}
				
            }
            else
            {
              // Sinon on affiche une erreur systeme
              $messageUpload = 'Problème lors de l\'upload !';
            }
          }
          else
          {
            $messageUpload = 'Une erreur interne a empêché l\'uplaod de l\'image';
          }
        }
        else
        {
          // Sinon erreur sur les dimensions et taille de l'image
          $messageUpload = 'Erreur dans les dimensions de l\'image !';
        }
      }
      else
      {
        // Sinon erreur sur le type de l'image
        $messageUpload = 'Le fichier à uploader n\'est pas une image !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour l'extension
      $messageUpload = 'L\'extension du fichier est incorrecte !';
    }
  }
  else
  {
    // Sinon on affiche une erreur pour le champ vide
    $messageUpload = 'Veuillez remplir le formulaire svp !';
    // exit('PB6');
  }
}

