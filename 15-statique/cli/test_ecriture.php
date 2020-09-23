<?php
// DIRECTORY_SEPARATOR : Remplace l'antislash pour s'asadpter au système d'exploitation
// dirname(__DIR__) : récupère le chemin du dossier parent
// var_dump(dirname(dirname(dirname(dirname(__DIR__)))));
// depuis PHP 7
// dirname(__DIR__, 5) : récupère le chemin du dossier parent à 5 niveaux au-dessus
$fichier =  dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . 'demo.txt';

// Crée un fichier si inexistant
// Chemin relatif
// FILE_APPEND : pour rajouter le texte après celui déjà existant
// @ : rend silencieux toutes les erreurs d'une fonction
$size = @file_put_contents($fichier, 'ça va?');

// Vérification si le fichier a bien été écrit = droit d'écriture dans un dossier
if($size === false) {
    echo 'Impossible d\'écrire daans le fichier';
} else {
    echo 'Ecriture réussie';
}