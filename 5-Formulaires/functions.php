<?php

/**
 * Affiche un item dans le menu avec détection si c'est la page active
 *
 * @param string $lien lien vers le site
 * @param string $titre titre du menu
 * @param string $linkClass style du menu
 * @return string un élément d'une liste
 */
function nav_item($lien, $titre, $linkClass = '')
{
    $classe = 'nav-item';
    if ($_SERVER['SCRIPT_NAME'] === '/PHP_grafikart/5-Formulaires/' . $lien) {
        $classe .= ' active';
    }
    return <<<HTML
    <li class="$classe">
        <a class="$linkClass" href="$lien">$titre</a>
    </li>
HTML;
}

/**
 * Affiche un menu en utilisant plusieurs fois la fonction nav_item
 *
 * @param string $linkClass
 * @return string plusieurs élément d'une liste
 */
function nav_menu($linkClass = '')
{
    return nav_item('index.php', 'Accueil', $linkClass) .
        nav_item('contact.php', 'Contact', $linkClass);
}

/**
 * Crée une checkbox avec le nom du parfum et détermine si elle doit être cochée avec la requête GET reçue
 *
 * @param string $name nom de la checkbox 
 * @param string $value valeur de la checkbox
 * @param array $data tableau de données reçu en méthode GET
 * @return string une checkbox
 */
function checkbox($name, $value, $data)
{
    $attributes = '';
    // $data[$name] -> $_GET['parfum'], parfum étant un tableau rempli par les checkbox
    if (isset($data[$name]) && in_array($value, $data[$name])) {
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
}

/**
 * Crée un radio avec le nom du supplément et détermine si il doit être coché avec la requête GET reçue
 *
 * @param string $name nom du radio 
 * @param string $value valeur du radio
 * @param string $data donnée reçue en méthode GET
 * @return string un radio
 */
function radio($name, $value, $data)
{
    $attributes = '';
    // $data[$name] -> $_GET['supplement'], supplement étant la valeur renvoyée par le radio
    if (isset($data[$name]) && $value == $data[$name]) {
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="radio" name="$name" value="$value" $attributes>
HTML;
}

function dump($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}
