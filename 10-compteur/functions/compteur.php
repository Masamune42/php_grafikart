<?php

function ajouter_vue()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    $fichier_journalier = $fichier . '-' . date('Y-m-d');
    // Initialisation à 1 de la valeur du compteur
    incrementer_compteur($fichier);
    incrementer_compteur($fichier_journalier);
}

function incrementer_compteur($fichier)
{
    $compteur = 1;
    if (file_exists($fichier)) {
        // Si le fichier existe on incrémente
        $compteur = (int) file_get_contents($fichier);
        $compteur++;
    }
    file_put_contents($fichier, $compteur);
}

function nombre_vues()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}
