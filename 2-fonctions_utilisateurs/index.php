<?php
// Fonctions utilisateurs

// Indique que les types sont stricts dans tout le code
declare(strict_types=1);

/**
 * Demande de choisir si l'utilisateur veut continuer ou pas
 *
 * @param string $phrase la phrase
 * @return boolean true si 'o', false si 'n'
 */
function repondre_oui_non(?string $phrase = null): bool
{
    while (true) {
        $reponse = readline($phrase . "- (o)ui/(n)on : ");
        if ($reponse === "o") {
            return true;
        } elseif ($reponse === "n") {
            return false;
        }
    }
}

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

$creneaux = demander_creneaux();
var_dump($creneaux);
