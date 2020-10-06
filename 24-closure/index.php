<?php
// tri
require_once 'vendor/autoload.php';

$eleves = [
    [
        'nom' => 'Marc',
        'age' => 21,
        'moyenne' => 18
    ],
    [
        'nom' => 'Jean',
        'age' => 20,
        'moyenne' => 13
    ],
    [
        'nom' => 'Marie',
        'age' => 25,
        'moyenne' => 15
    ],
    [
        'nom' => 'Anne',
        'age' => 22,
        'moyenne' => 9
    ]
];

// $key = 'moyenne';

// OPTION 1
// function sorterByKey($key)
// {
//     // use permet d'utiliser une autre variable qui n'appartient pas à la closure
//     return function ($eleve1, $eleve2) use ($key) {
//         return $eleve1[$key] - $eleve2[$key];
//     };
// }

// usort($eleves, sorterByKey('moyenne'));

// OPTION 2
function sorterByKey($array, $key)
{
    // $array qui est passé en paramètre va être trié et remplacé dans usort
    usort($array, function ($a, $b) use ($key) {
        return $a[$key] - $b[$key];
    });
    // Il sera ensuite renvoyé par la fonction
    return $array;
}

$elevesSorted = sorterByKey($eleves, 'moyenne');

dump($elevesSorted);


// filtre
dump($eleves);
// Filtrage d'un tableau avec une règle dans une fonction callback
$eleveMoyenne = array_filter($eleves, function($eleve) {
    return $eleve['moyenne'] > 10;
});

dump($eleveMoyenne);