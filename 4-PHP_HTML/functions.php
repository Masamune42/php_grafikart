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
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
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
    return nav_item('/PHP_grafikart/4-PHP_HTML/index.php', 'Accueil', $linkClass) .
        nav_item('/PHP_grafikart/4-PHP_HTML/contact.php', 'Contact', $linkClass);
}
