<?php
// Filtrage d'insultes
$insultes = ['merde', 'con'];
$asterisque = [];
foreach ($insultes as $insulte) {
    // On rempli le tableau avec le même nombre d'asterisque que la taille du mot écrit
    $asterisque[] = str_repeat('*', strlen($insulte));
}
$phrase = readline('Entrez une phrase : ');
$phrase = str_replace($insultes, $asterisque, $phrase);
echo $phrase;