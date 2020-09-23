<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';
$creneau = new Creneau(5,6);
$creneau->debut = 9;
$creneau->fin = 7;
var_dump($creneau);