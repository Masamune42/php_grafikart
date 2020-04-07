<?php
// FICHIER NON UTILISE ICI (dans une précédente méthode)
if (!function_exists('nav_item')) {

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
}
?>

<?= nav_item('/PHP_grafikart/4-PHP_HTML/index.php', 'Accueil', $class); ?>
<?= nav_item('/PHP_grafikart/4-PHP_HTML/contact.php', 'Contact', $class); ?>