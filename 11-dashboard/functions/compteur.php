<?php

/**
 * Fonction qui ajoute 1 au compteur de vues sur le site à tous les fichiers
 *
 * @return void
 */
function ajouter_vue()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    $fichier_journalier = $fichier . '-' . date('Y-m-d');
    // Initialisation à 1 de la valeur du compteur
    incrementer_compteur($fichier);
    incrementer_compteur($fichier_journalier);
}

/**
 * Fonction ajoutant 1 au compteur de vues au fichier renseigné
 *
 * @param string $fichier chemin vers le fichier
 * @return void
 */
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

/**
 * Lit le fichier avec le compteur de visite sur le site
 *
 * @return int le nombre de visites du site
 */
function nombre_vues()
{
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}
