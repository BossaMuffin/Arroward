 <?php
 if ($page_index==1)
 {
 echo '<meta name="robots" content="index, follow"/> ';
 }
 elseif ($page_index==2)
 {
 echo '<meta name="robots" content="noindex, follow"/> ';
 }
  elseif ($page_index==3)
 {
 echo '<meta name="robots" content="index, nofollow"/> ';
 }
 else { echo '<meta name="robots" content="noindex, nofollow"/> ';}