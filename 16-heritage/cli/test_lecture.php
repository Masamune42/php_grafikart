<?php
// Fichier txt
// $fichier =  __DIR__ . DIRECTORY_SEPARATOR . 'demo.txt';
// FIchier csv
$fichier =  __DIR__ . DIRECTORY_SEPARATOR . 'participants.csv';
// Obtenir le contenu d'un fichier
// Contenu d'une URL possible mais déconseillé
// echo file_get_contents($fichier);

// Fonction f
// r -> ouverture en lecture uniquement
$resource = fopen($fichier, 'r+');

// Lit les 2 1ers octets
// echo fread($resource, 2);

// Renvoie les infos sur le fichier
// var_dump(fstat($resource)); 

// Assignation dans la boucle, tant que
while ($line = fgets($resource)) {
    $k++;
    if ($k == 5) {
        // Affiche la ligne 5
        // echo $line;
        // écrire dans un fichier
        fwrite($resource, 'Yo les gens');
        break;
    }
}

fclose($fichier);
