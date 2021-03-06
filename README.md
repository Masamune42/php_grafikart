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
Lien de redirection :
- "/index.php" -> [chemin racine du site]/index.php
- "index.php" -> [chemin actuel du site]/index.php

## Formulaires
Eviter à un utilisateur de rentrer des valeurs suspectes :
- htmlentities() : transforme les caractères ensibles (ex : ">" -> &gt)

Exemple de code à retranscrire pour adapter :
````php
<?php
$aDeviner = 150;

require 'header.php';
?>

<?php if (isset($_GET['chiffre'])) : ?>
    <?php if ($_GET['chiffre'] > $aDeviner) : ?>
        Votre chiffre est trop grand
    <?php elseif ($_GET['chiffre'] < $aDeviner) : ?>
        Votre chiffre est trop petit
    <?php else : ?>
        Bravo ! Vous avez deviné le chiffre <?= $aDeviner ?>
    <?php endif ?>
<?php endif ?>

<form action="jeu.php" method="GET">
    <input type="number" name="chiffre" placeholder="Entre 0 et 1000" value="<?php if (isset($_GET['chiffre'])) { echo htmlentities($_GET['chiffre']); } ?>">
    <button type="submit">Deviner</button>
</form>

<?php require 'footer.php' ?>
````
Résultat :
Le code est bien partitionné 
````php
<?php
// PARTIE LOGIQUE

// Déclaration des variables
$aDeviner = 150;
$erreur = null;
$succes = null;
$value = null;

// Tests
if (isset($_GET['chiffre'])) {
    if ($_GET['chiffre'] > $aDeviner) {
        $erreur = "Votre chiffre est trop grand";
    } elseif ($_GET['chiffre'] < $aDeviner) {
        $erreur = "Votre chiffre est trop petit";
    } else {
        $succes = "Bravo ! Vous avez deviné le chiffre <strong>$aDeviner</strong>";
    }

    $value = (int) $_GET['chiffre'];
}

// PARTIE HTML
require 'header.php';
?>

<?php if ($erreur) : ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php elseif ($succes) : ?>
    <div class="alert alert-success">
        <?= $succes ?>
    </div>
<?php endif ?>

<form action="jeu.php" method="GET">
    <input type="number" name="chiffre" placeholder="Entre 0 et 1000" value="<?= $value ?>">
    <button type="submit">Deviner</button>
</form>
````

## Dates
/!\ NON VALABLE POUR PHP 5.6+ /!\
````php
// Déclarer un tableau dans une constante -> utiliser la fonction serialize
define('JOURS', serialize([
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche'
]));

// Récupérer les informations du tableau de la constante -> unserialize
unserialize(JOURS)
````
Si 2 tableaux sont liés (par le même index), alors on peut réutiliser l'index d'un tableau dans une boucle pour afficher l'autre
````php
<?php foreach (unserialize(JOURS) as $k => $jour) : ?>
// ...
    <?= creneaux_html(unserialize(CRENEAUX)[$k]) ?>
````

Disponible depuis PHP 7
````php
// Exemple d'utilisation pour: Opérateur de fusion Null
$action = $_POST['action'] ?? 'default';

// le code ci-dessus est équivalent à cette structure if/else 
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = 'default';
}
````

## Lecture de fichiers
https://www.php.net/manual/fr/function.fopen.php

format csv -> problématique car si les champs contiennent des virgules, ils seront mis entre guillemets et si on fait un explode on va les récupérer
format tsv -> même chose que csv mais avec des tabulations à place des virgules (pas le même problème)

On peut utiliser facilement les constantes magiques pour les utiliser dans le chemin d'accès pour les require.
````php
// EXEMPLE
// DIRECTORY_SEPARATOR : Remplace l'antislash pour s'asdapter au système d'exploitation
// dirname(__DIR__) : récupère le chemin du dossier parent
var_dump(dirname(dirname(dirname(dirname(__DIR__)))));
// depuis PHP 7
// dirname(__DIR__, 5) : récupère le chemin du dossier parent à 5 niveaux au-dessus
$fichier =  dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . 'demo.txt';

// UTILISATION
// On est sûr d'importer le fichier au bon endroit
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';
````

## Cookies

Utilisation d'un cookie avec un tableau de valeurs
````php
// Définition du tableau
$user = [
    'prenom' => 'John',
    'nom' => 'Doe',
    'age' => 18
];
// On sérialiase le tableau avant de le passer dans le cookie
setcookie('user',serialize($user));

$utilisateur = $_COOKIE['user'];
// On le désérialise avant de l'afficher
var_dump(unserialize($utilisateur));
````
Un cookie ne doit pas gérer la connexion / déconnexion des utilisateurs car pas assez sécurisé.

## Session
- Une session ne vie que pendant une navigation de l'utilisateur, si il ferme son navigateur : session perdue.
- Lorsque l'on démarre une session, PHP va créer un identifiant qu'il va définir dans un cookie et qui va identifier l'utilisateur pour lui afficher ses informations. Les informations sauvegardés en session ne peuvent pas être altérées.
- N'utiliser la session que sur les pages qui en ont besoin et pas sur toutes les pages (ex : ne pas mettre session_start dans functions.php)

## Chiffrage de mot de passe
````php
// Hahage du mdp
$password = password_hash('Doe',PASSWORD_DEFAULT, ['cost' => 12]);
// Vérification du mot de passe reçu dans un formulaire en méthode POST
password_verify($_POST['motdepasse'], $password);
````

## DateTime
https://www.php.net/manual/fr/class.datetime.php
````php
// Instanciation
$date = new DateTime();
$date->format('d/m/Y'); // Affichage la date : 21/05/2020
$date->modify('+1 month'); // Rajoute un mois à la date : 21/06/2020

$d = new DateTime('2019-01-01');
$d2 = new DateTime('2019-04-01');

// Compare la différence entre les 2 dates puis récupère les jours
$diff = $d->diff($d2, true)->days; // de type DateInterval
echo "Il y a {$diff} jours de différence";

// Utilisation de DateInterval
// Compare la différence entre les 2 dates
$diff = $d->diff($d2, true);
echo "Il y a {$diff->y} jours, {$diff->m} jours et {$diff->d} jours de différence";

// Déclaration d'un nouvel objet de type DateInterval
// Période 1 Mois 1 Jour Time 1 Minute
$interval = new DateInterval('P1M1DT1M'); 

// Ajouter à une date un interval
$date->add($interval);
````

## autoloader
1. https://getcomposer.org/download/ : Utiliser les lignes de commandes pour importer des fichiers composer
2. Exécuter les commandes, définir un nom de projet (ex : grafikart/site) et répondre non pour créer les dépendances
```console
php composer.phar
php composer.phar init
```
3. Remplir le fichier composer.json, ajouter les lignes suivante afin définir la correspondance entre le namespace et le dossier local
```json
"autoload": {
    "psr-4": {
        "App\\":"class/"
    }
},
```
4. On charge le fichier json avec les paramètres passés pour créer un fichier d'autoloader
```console
php composer.phar dump-autoload
```
5. On peut maintenant utiliser l'autoloader
```php
// PHP va savoir dynamiquement où se trouve la classe que l'on veut importer
require 'vendor/autoload.php';
```

## Composer
Installer les librairies
```console
composer install
```
Update les librairies
```console
composer update
```
On peut downgrade la version de la librairie utilisée dans composer.json
```json
// version 1.7 est supérieur
"require": {
    "erusev/parsedown": "^1.7"
}
// version 1.7 est max
"require": {
    "erusev/parsedown": "~1.7"
}
```

## Tableau dynamique
- On peut gérer dynamiquement les liens en les générant avec une fonction PHP et lui ajouter des paramètres si besoin (avec array_merge)
```php
// Cette fonction génère un code URL avec les paramètres existant en ajoutant des paramètres grâce à array_merge
// Très utile lorsque que l'on veut gérer dynamiquement les liens (ex: recherches avec plusieurs critères)
http_build_query(array_merge($_GET, $params);
```

## Tests avec PHPUnit
- Documentation des assertions : https://phpunit.readthedocs.io/fr/latest/assertions.html
1. Installer PHPUnit via composer : composer require --dev phpunit/phpunit ^9
2. Créer un dossier "tests" à la racine et "[NomClass]Test.php"
3. Créer une fonction avec une fonction "assert" qui vérifie la cohérence d'une fonction
4. Pour tester toutes les classes dans "tests" => ./vendor/bin/phpunit tests
5. On peut visualiser les tests qui ont réussi ou échoué

## TIPS

### Ecrire une balise avec classes inclues
div.alert.alert-danger -> ````<div class="alert alert-danger"></div>````<br>
OU .alert.alert-danger

### Se déplacer à une ligne dans VSCode
ctrl + G : numéro de la ligne

### Extensions utiles
- PHP Namespace Resolver : pour importer automatiquement la classe sélectionnée (raccourci : Ctrl + alt + I)

## FONCTIONS UTILES
str_pad : https://www.php.net/manual/fr/function.str-pad.php
````php
// int $mois = 2
// Ici on lui dit qu'on va utiliser remplir $mois avec des 0 jusqu'à une taille = 2
$mois = str_pad($mois, 2, '0');
````

glob : https://www.php.net/manual/fr/function.glob
````php
$fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-*';
// Récupération des fichiers ayant le même pattern avec * -> n'importe quoi
$fichiers = glob($fichier);
````

basename : https://www.php.net/manual/fr/function.basename
````php
// Retourne le nom du fichier
basename($fichier)
````

## TODO
- Passer le projet en PHP 7
- Ajouter des commentaires