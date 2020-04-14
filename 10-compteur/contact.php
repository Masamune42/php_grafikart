<?php
// Démarrage de la session ou continue si une existe déjà
session_start();

// On déclare des variables à utiliser
$title = 'Nous contacter';
$nav = 'contact';

// On inclut les fichiers php nécessaires
// config.php pour les constantes
require_once 'data/config.php';
// functions.php pour les fonctions utiles (comme création de menu de navigation)
require_once 'functions.php';

// Configuration du décalage horaire
date_default_timezone_set('Europe/Paris');

// Récupérer l'heure d'aujourd'hui $heure
// Si on récupère le paramètre heure dans la méthode GET on l'utilise, sinon on récupère l'heure actuel
// Idem pour le jour (numéro du jour de la semaine)
// PHP 7+
// $heure = (int)($_GET['heure'] ??  date('G'));
// $jour = (int)($_GET['jour'] ??  date('N') - 1);
// SINON
$heure = (int) (isset($_GET['heure']) ?  $_GET['heure'] : date('G'));
$jour = (int) (isset($_GET['jour']) ?  $_GET['jour'] : date('N') - 1);

// Récupérer les créneaux d'aujourd'hui
// unserialize pour récupérer les tableaux : PHP 5.5
// AVANT la sélection du jour possible
// $creneaux = unserialize(CRENEAUX)[date('N') - 1];
// APRES
$creneaux = unserialize(CRENEAUX)[$jour];

// $creneaux = creneaux_html(unserialize(CRENEAUX));
$ouvert = in_creneaux($heure, $creneaux);

// Couleur à utiliser pour colorer le texte si ouvert ou fermé
// Plus utilisé depuis la possibilité de sélection de l'heure
// $color = $ouvert ? 'green' : 'red';

require 'elements/header.php'; ?>


<div class="row">
    <div class="col-md-8">
        <!-- <h2>Debug</h2>
        <pre><?php var_dump($_SESSION) ?></pre> -->
        <h2>Nous contacter</h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi cum quibusdam accusantium non ea optio odio sit nihil deleniti minus, eius accusamus neque architecto, voluptatum voluptas nesciunt laboriosam itaque nobis!</p>
    </div>
    <div class="col-md-4">
        <h2>Horaires d'ouverture</h2>

        <!-- Si in_creneaux() a renvoyé true, on affiche le message -->
        <?php if ($ouvert) : ?>
            <div class="alert alert-success">
                Le magasin est ouvert
            </div>
        <?php else : ?>
            <div class="alert alert-danger">
                Le magasin est fermé
            </div>
        <?php endif ?>

        <!-- Formulaire permettant de sélectionner un jour de la semaine et une heure pour vérifier si le magasin sera ouvert -->
        <form action="" method="GET">
            <div class="form-group">
                <!-- Un select avec un option par jour de la semaine -->
                <?= select('jour', $jour, unserialize(JOURS)) ?>
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure ?>">
            </div>
            <button class="btn btn-primary">Voir si le magasin est ouvert</button>
        </form>
        <ul>
            <!-- 0 => 'Lundi', 1 => 'Mardi' -->
            <?php foreach (unserialize(JOURS) as $k => $jour) : ?>
                <!-- On colore le texte en vert si $k + 1 = N (numéro du jour de la semaine) -->
                <!-- A mettre que si l'on a pas la possibilité de choisir une date d'ouverture -->
                <!-- <li <?php if ($k + 1 === (int) date('N')) : ?> style="color: <?= $color ?>" <?php endif ?>> -->
                <li>
                    <strong><?= $jour ?></strong> :
                    <!-- On a bien CREANEAUX[0] => horaires de lundi, etc., donc même index que JOURS -->
                    <?= creneaux_html(unserialize(CRENEAUX)[$k]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>


<?php require 'elements/footer.php';
