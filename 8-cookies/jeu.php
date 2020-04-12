<?php
require_once 'functions.php';
// PARTIE LOGIQUE

// Déclaration des variables
$aDeviner = 150;
$erreur = null;
$succes = null;
$value = null;

// PARTIE GLACE
$parfums = [
    'Fraise' => 4,
    'Chocolat' => 5,
    'Vanille' => 3
];

$cornets = [
    'Pot' => 2,
    'Cornet' => 3
];

$supplements = [
    'Pépite de chocolat' => 1,
    'Chantilly' => 0.5
];

$title = "Composez votre glace";
$ingredients = [];
$total = 0;

// Tests de la requête reçue
if (isset($_GET['parfum'])) {
    foreach ($_GET['parfum'] as $parfum) {
        if (isset($parfums[$parfum])) {
            $ingredients[] = $parfum;
            $total += $parfums[$parfum];
        }
    }
}
if (isset($_GET['supplement'])) {
    foreach ($_GET['supplement'] as $supplement) {
        if (isset($supplements[$supplement])) {
            $ingredients[] = $supplement;
            $total += $supplements[$supplement];
        }
    }
}
if (isset($_GET['cornet'])) {
    $cornet = $_GET['cornet'];
    if (isset($cornets[$cornet])) {
        $ingredients[] = $cornet;
        $total += $cornets[$cornet];
    }
}

// PARTIE HTML
require 'header.php';
?>

<!-- Test si il y a une erreur ou un succès et l'affiche -->
<?php if ($erreur) : ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php elseif ($succes) : ?>
    <div class="alert alert-success">
        <?= $succes ?>
    </div>
<?php endif ?>

<h1><?= $title ?></h1>
<!-- EXERCICE -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Votre glace</h5>
                <!-- Affiche dans une liste les ingrédients de la glace créée et son prix -->
                <ul>
                    <?php foreach ($ingredients as $ingredient) : ?>
                        <li><?= $ingredient ?></li>
                    <?php endforeach ?>
                </ul>
                <p>
                    <strong>Prix : <?= $total ?>€</strong>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <!-- Formulaire avec les éléments d'une glace -->
        <form action="jeu.php" method="GET">
            <h2>Choisissez vos parfums</h2>
            <!-- Affiche une checkbox pour chaque parfum avec son prix à coté -->
            <?php foreach ($parfums as $parfum => $prix) : ?>
                <div class="checkbox">
                    <label for="">
                        <?= checkbox('parfum', $parfum, $_GET); ?>
                        <?= $parfum ?> - <?= $prix ?>€
                    </label>
                </div>
                <?php endforeach ?>
                <h2>Choisissez votre cornet</h2>
                <!-- Affiche une checkbox pour chaque cornet avec son prix à coté -->
                <?php foreach ($cornets as $cornet => $prix) : ?>
                    <div class="checkbox">
                        <label for="">
                            <?= radio('cornet', $cornet, $_GET); ?>
                            <?= $cornet ?> - <?= $prix ?>€
                        </label>
                    </div>
                    <?php endforeach ?>
                    <h2>Choisissez vos suppléments</h2>
                    <!-- Affiche une checkbox pour chaque supplément avec son prix à coté -->
            <?php foreach ($supplements as $supplement => $prix) : ?>
                <div class="checkbox">
                    <label for="">
                        <?= checkbox('supplement', $supplement, $_GET); ?>
                        <?= $supplement ?> - <?= $prix ?>€
                    </label>
                </div>
            <?php endforeach ?>
            <button type="submit" class="btn btn-primary">Deviner</button>
        </form>
    </div>
</div>

<!-- Partie vérification des éléments d'une requête reçue -->
<h2>$_GET</h2>
<pre>
<?php var_dump($_GET) ?>
</pre>
<h2>$_POST</h2>
<pre>
<?php var_dump($_POST) ?>
</pre>

<?php require 'footer.php' ?>