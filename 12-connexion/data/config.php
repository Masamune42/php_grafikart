<?php
define('JOURS', serialize([
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche'
]));

// serialize pour que la constante puisse contenir un tableau : PHP 5.5
define(
    'CRENEAUX',
    serialize(
        [
            [
                [8, 12],
                [14, 19]
            ],
            [
                [8, 12],
                [14, 19]
            ],
            [
                [8, 12]
            ],
            [
                [8, 12],
                [14, 19]
            ],
            [
                [8, 12],
                [14, 19]
            ],
            [],
            []
        ]
    )
);
