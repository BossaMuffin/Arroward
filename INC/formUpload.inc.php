<?php 
		
      if( !empty($messageUpload) ) 
      {
        echo '<p>',"\n";
        echo "\t\t<strong>", htmlspecialchars($messageUpload) ,"</strong>\n";
        echo "\t</p>\n\n";
      }
      if(is_dir($upload_target))
      {
       echo "\t\t<p>", $upload_target ,"</p>\n";
       echo "\t\t<p>", Fcount_files($upload_target)," - ",$num_img_max,"</p>\n";
   }else { echo "NO DIR";}
   
    ?>
    <!-- Debut du formulaire  echo htmlspecialchars($_SERVER['PHP_SELF']); -->
   <form id="upload_form" class="largeur4" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <fieldset>
        <legend>Formulaire</legend>
          <p>
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <input name="fichier" type="file" id="fichier_a_uploader" />
            <input type="submit" name="submit" value="Uploader" />
          </p>
      </fieldset>
    </form>
    
    <!-- Fin du formulaire -->

