<?php

/**
 * Demande un créneau à l'utilisateur
 *
 * @param string phrase à rentrer
 * @return array tableau avec une heure d'ouverture et de fermeture
 */
function demander_creneau(string $phrase = 'Veuillez entrer un créneau'): array
{
    echo $phrase . "\n";
    while (true) {
        $ouverture = (int) readline('Heure d\'ouverture :');
        if ($ouverture >= 0 && $ouverture <= 23) {
            break;
        }
    }

    while (true) {
        $fermeture = (int) readline('Heure de fermeture :');
        if ($fermeture >= 0 && $fermeture <= 23 && $fermeture > $ouverture) {
            break;
        }
    }

    return [$ouverture, $fermeture];
}

/**
 * Demande plusieurs créneaux
 *
 * @param string phrase à rentrer
 * @return array tableau de tableaux avec une heure d'ouverture et de fermeture
 */
function demander_creneaux(string $phrase = 'Veuillez entrer vos créneaux'): array
{
    $creneaux = [];
    $continuer = true;
    while ($continuer) {
        $creneaux[] = demander_creneau();
        $continuer = repondre_oui_non('Voulez-vous continuer ?');
    }

    return $creneaux;
}
