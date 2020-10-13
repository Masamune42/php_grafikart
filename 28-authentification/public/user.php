<?php
use App\App;

require '../vendor/autoload.php';
// On vérifie via notre objet d'authentification, si le user est un user ou admin
App::getAuth()->requireRole('user', 'admin');
?>
Réservé à l'utilisateur