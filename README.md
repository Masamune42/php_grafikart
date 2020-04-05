# Cours PHP Grafikart
Cours de PHP de la chaine YouTube Grafikart : https://www.youtube.com/playlist?list=PLjwdMgw5TTLVDv-ceONHM_C19dPW1MAMD

## Fonctions utilisateurs
````php
// typage fort : converti tout ce qui rentré dans la fonction en string
function demander_creneaux(string $phrase = 'Veuillez entrer vos créneaux')
````
````php
// Indique que les types sont stricts dans tout le code
declare(strict_types=1);
````
````php
// Indique la valeur de retour
function demander_creneau(string $phrase = 'Veuillez entrer un créneau'): array
````
````php
// ?string : indique que le paramètre null ou un string
function repondre_oui_non(?string $phrase = null): bool
````
````php
// ?bool : indique que la fonction renvoie null ou un booléen
function repondre_oui_non(?string $phrase = null): ?bool
````

## PHP & HTML
Mettre en surbrillance la page sur laquelle on se trouve dans la navbar Bootstrap
````php
// Définition d'une variable à identifier en début de page (avant require)
// Ici, dans index.php
$nav = 'index';
// header.php
<li class="nav-item <?php if ($nav === 'index') : ?>active <?php endif ?>">
````
Idem mais en utilisant $_SERVER
````php
// header.php
<li class="nav-item <?php if ($_SERVER['SCRIPT_NAME'] === '/PHP_grafikart/4-PHP_HTML/index.php') : ?>active <?php endif ?>">
````
Utilisation d'une fonction pour ajouter un élément à la navbar
````php
// header.php
// Utilisation d'une fonction la navbar : lien + titre de la page
function nav_item($lien, $titre)
{
    // Classe nav-item pour Bootstrap
    $classe = 'nav-item';
    // Ajoute la classe si on se trouve sur la bonne page
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe = $classe . ' active';
    }
    return $html = '    <li class="' . $classe . '">
        <a class="nav-link" href="' . $lien . '">' . $titre . '</a>
    </li>';
}
// ...
// Appel de la fonction avec le lien vers la page et le titre en paramètres
<?= nav_item('/PHP_grafikart/4-PHP_HTML/index.php', 'Accueil'); ?>
````
Utilisation avec Heredoc (utilisation avec les gros blocs de textes)
````php
// header.php
{
    $classe = 'nav-item';
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe .= ' active';
    }
    return <<<HTML // Déclaration avec <<<NOM_BALISE
    // On y place simplement des variables
    <li class="$classe">
        <a class="nav-link" href="$lien">$titre</a>
    </li>';
// fermeture obligatoirement sans indentation !
HTML;
````
