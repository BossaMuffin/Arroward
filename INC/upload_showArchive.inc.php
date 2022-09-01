<ul>
	<?php
		  //affiche la liste des img dans DIR, num_img_max = COUNTFILE dans le dossier img source
		for ($num_img = 2; $num_img < $num_img_max+2 ; $num_img++)
		{
			echo '<li>
				<img			  
				src ="'.$dirUpload.$name_files[$num_img].'" 
				class =""
				title="" alt="">
				<!-- <div class="texte">
					<p>'.$name_files[$num_img].'</p>
					</div> -->
				  </li>';	
		}
	?>
</ul>
