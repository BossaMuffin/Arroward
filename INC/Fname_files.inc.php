 <?php
 
 // Recuperation des nom des fichiers dans un dossier dans NAME_FILES[num] 
		function Fname_files($filePath){
		$name_files[0] = "";
		$i = 1;
		$repertoire = opendir($filePath);
                 
		while (false !==($fichier = readdir($repertoire)))
		{
			
			$name_files[$i]=$fichier;
			$i += 1;
		}
		 closedir($filePath);
		 return $name_files;

		//$nomPhoto = $fichier->getFilename();
		
		}
