<?php
function Fcount_files($path)
{
    $nbFichiers = 0;
    $repertoire = opendir($path);
                 
    while (false !==($fichier = readdir($repertoire)))
    {
        $nbFichiers += 1;
    }
     closedir($path);
    $nbFichiers = $nbFichiers - 2 ;
    return (int) $nbFichiers;
}
