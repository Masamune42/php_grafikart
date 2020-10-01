<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Compteur.php';

class DoubleCompteur extends Compteur {
    const INCREMENT = 10;
    // On récupère la classe parente pour la modifier
    // public function recuperer()
    // {
    //     // Récupère la fonction parente et multiplie le résultat par 2
    //     return 2 * parent::recuperer();
    // }
}