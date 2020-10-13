<?php
use App\App;

require '../vendor/autoload.php';
// On vérifie via notre objet d'authentification, si le user est un admin
App::getAuth()->requireRole('admin');
?>

Réservé à l'admin