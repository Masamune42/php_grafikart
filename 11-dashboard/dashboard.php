<?php
require_once 'functions/compteur.php';
// Récupération du nombre de vues
$total = nombre_vues();
// Récupération de l'année actuelle
$annee = (int) date('Y');
// Si on a envoyé l'année ou le mois en requête, définition de ceux-ci, sinon null
$annee_selection = empty($_GET['annee']) ? null : (int) $_GET['annee'];
$mois_selection = empty($_GET['mois']) ? null : $_GET['mois'];

// Tableau de numéro de mois => nom du mois
$mois = [
    '01' => 'Janvier',
    '02' => 'Février',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Aout',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
];

require 'elements/header.php';
?>

<div class="row">
    <div class="col-md-4">
        <div class="list-group">
            <?php for ($i = 0; $i < 5; $i++) : ?>
                <!-- Affichage de l'année courante et des 4 précédentes et active si on est sur celle sélectionnée -->
                <a class="list-group-item <?= $annee - $i == $annee_selection ? 'active' : '' ?>" href="?annee=<?= $annee - $i ?>"> <?= $annee - $i ?> </a>
                <!-- Si on se trouve sur l'année courante dans le menu -->
                <?php if ($annee - $i == $annee_selection) : ?>
                    <?php foreach ($mois as $numero => $nom) : ?>
                        <!-- Affichage des mois de cette année -->
                        <a class="list-group-item <?= $numero == $mois_selection ? 'active' : '' ?>" href="?annee=<?= $annee_selection ?>&mois=<?= $numero ?>">
                            <?= $nom ?>
                        </a>
                    <?php endforeach ?>
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <!-- Affichage du nombre total de visites sur le site -->
                <strong style="font-size: 3em"><?= $total ?></strong><br>
                Visite<?= $total > 1 ? 's' : '' ?> total
            </div>
        </div>

    </div>
</div>


<?php require 'elements/footer.php'; ?>