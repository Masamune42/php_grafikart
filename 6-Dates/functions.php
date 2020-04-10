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

/**
 * Renvoie un créneau des horaires d'ouverture
 *
 * @param array $creneaux table de créneaux horaires
 * @return string le créneau horaire
 */
function creneaux_html($creneaux)
{
    if (count($creneaux) === 0) {
        return 'Fermé';
    }
    $phrases = [];
    foreach ($creneaux as $creneau) {
        $phrases[] = "de <strong>$creneau[0]h</strong> à <strong>$creneau[1]h</strong>";
    }
    return implode(' et ', $phrases);
}

/**
 * Fonction qui retourne true si l'heure est comprise dans le créneau
 *
 * @param int $heure heure
 * @param array $creneaux tableau de créneaux
 * @return bool true si l'heure se trouve dans le créneau, sinon false
 */
function in_creneaux($heure, $creneaux)
{
    foreach ($creneaux as $creneau) {
        $debut = $creneau[0];
        $fin = $creneau[1];
        if ($heure >= $debut && $heure < $fin) {
            return true;
        }
    }
    return false;
}

/**
 * Permet de créer un select avec des options
 *
 * @param string $name nom du select
 * @param string $value valeur de chaque option
 * @param array $options tableau des jours de la semaine
 * @return string code HTML pour créer un select avec les options
 */
function select($name, $value, $options)
{
    $html_options = [];
    foreach ($options as $k => $option) {
        $attributes = $k == $value ? ' selected' : '';
        $html_options[] = "<option value='$k' $attributes>$option</option>";
    }
    return "<select class='form-control' name='$name'>" . implode($html_options) . '</select>';
}
