<?php


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

require_once 'functions_creneaux.php';