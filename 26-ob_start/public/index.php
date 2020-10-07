<?php
/*
ATTENTION : LANCER EN MODE SERVEUR AVEC LA COMMANDE PHP :
php -S localhost:8000 -t public, sinon problème de redirection
*/
require_once '../vendor/autoload.php';

$router = new AltoRouter();

require '../config/routes.php';
// Match est un tableau contenant 3 valeurs : target -> closure, params -> paramètres (en donnant des noms) et name -> nom de la route
$match = $router->match();

// Si l'adresse match, on appelle la closure dans un target
if (is_array($match)) {
    if (is_callable($match['target'])) {
        // Permet d'appeler une fonction callback avec des paramètres
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        ob_start();
        require "../templates/{$match['target']}.php";
        $pageContent = ob_get_clean();
    }
    require_once '../elements/layout.php';
} else {
    echo '404';
}
