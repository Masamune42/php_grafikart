<?php
/*
ATTENTION : LANCER EN MODE SERVEUR AVEC LA COMMANDE PHP :
php -S localhost:8000 -t public, sinon problème de redirection
*/
require_once '../vendor/autoload.php';



// Méthode à la main !
// $uri = $_SERVER['REQUEST_URI'];

// if ($uri === '/nous-contacter') {
//     require '../templates/contact.php';
// } else if ($uri === '/') {
//     require '../templates/home.php';
// } else {
//     echo '404';
// }

$router = new AltoRouter();

// Version closure
// $router->map('GET', '/', function () {
//     echo 'salut';
// });
// $router->map('GET', '/nous-contacter', function () {
//     echo 'Nous contacter';
// });
// $router->map('GET', '/blog/[*:slug]-[i:id]', function ($slug, $id) {
//     echo "Je suis sur l'article $slug avec le numéro $id";
// });
// Version appel de page
$router->map('GET', '/', 'home');
/**
 * 1. Méthode
 * 2. chemin
 * 3. page à afficher dans templates
 * 4. nom de la page
 */
$router->map('GET', '/nous-contacter', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
// Match est un tableau contenant 3 valeurs : target -> closure, params -> paramètres (en donnant des noms) et name -> nom de la route
$match = $router->match();

// Si l'adresse match, on appelle la closure dans un target
if (is_array($match)) {
    require_once '../elements/header.php';
    if (is_callable($match['target'])) {
        // Permet d'appeler une fonction callback avec des paramètres
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../templates/{$match['target']}.php";
    }
    require_once '../elements/footer.php';
} else {
    echo '404';
}
