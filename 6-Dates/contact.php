<?php
$title = 'Nous contacter';
$nav = 'contact';
require_once 'config.php';
require_once 'functions.php';
// Configuration du décalage horaire
date_default_timezone_set('Europe/Paris');
// Récupérer l'heure d'aujourd'hui $heure
// PHP 7+
// $heure = (int)($_GET['heure'] ??  date('G'));
// $jour = (int)($_GET['jour'] ??  date('N') - 1);
// SINON
$heure = (int)(isset($_GET['heure']) ?  $_GET['heure'] : date('G'));
$jour = (int)(isset($_GET['jour']) ?  $_GET['jour'] : date('N') - 1);

// Récupérer les créneaux d'aujourd'hui
// AVANT la sélection du jour possible
$creneaux = unserialize(CRENEAUX)[date('N') - 1];
// après
$creneaux = unserialize(CRENEAUX)[$jour];
// unserialize pour récupérer les tableaux : PHP 5.5
// $creneaux = creneaux_html(unserialize(CRENEAUX));
$ouvert = in_creneaux($heure, $creneaux);
$color = $ouvert ? 'green' : 'red';
require 'header.php'; ?>


<div class="row">
    <div class="col-md-8">
        <h2>Nous contacter</h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi cum quibusdam accusantium non ea optio odio sit nihil deleniti minus, eius accusamus neque architecto, voluptatum voluptas nesciunt laboriosam itaque nobis!</p>
    </div>
    <div class="col-md-4">
        <h2>Horaires d'ouverture</h2>

        <?php if ($ouvert) : ?>
            <div class="alert alert-success">
                Le magasin est ouvert
            </div>
        <?php else : ?>
            <div class="alert alert-danger">
                Le magasin est fermé
            </div>
        <?php endif ?>

        <form action="" method="GET">
            <div class="form-group">
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
                <li <?php if ($k + 1 === (int) date('N')) : ?> style="color: <?= $color ?>" <?php endif ?>>
                    <strong><?= $jour ?></strong> :
                    <!-- On a bien CREANEAUX[0] => horaires de lundi, etc., donc même index que JOURS -->
                    <?= creneaux_html(unserialize(CRENEAUX)[$k]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>


<?php require 'footer.php';
