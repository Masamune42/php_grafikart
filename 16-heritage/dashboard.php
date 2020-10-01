<?php
require_once 'functions/auth.php';
require_once 'functions/compteur.php';
forcer_utilisateur_connecte();
// Récupération de l'année actuelle
$annee = (int) date('Y');
// Si on a envoyé l'année ou le mois en requête, définition de ceux-ci, sinon null
$annee_selection = empty($_GET['annee']) ? null : (int) $_GET['annee'];
$mois_selection = empty($_GET['mois']) ? null : $_GET['mois'];

// Récupération du nombre de vues
if ($annee_selection && $mois_selection) {
    $total = nombre_vues_mois((int) $annee_selection, (int) $mois_selection);
    $detail = nombre_vues_detail_mois((int) $annee_selection, (int) $mois_selection);
} else {
    $total = nombre_vues();
}

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

require_once 'elements/header.php';
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
        <div class="card mb-4">
            <div class="card-body">
                <!-- Affichage du nombre total de visites sur le site -->
                <strong style="font-size: 3em"><?= $total ?></strong><br>
                Visite<?= $total > 1 ? 's' : '' ?> total
            </div>
        </div>
        <?php if (isset($detail)) : ?>
            <h2>Détails des visites pour le mois</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Nombre de visites</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail as $ligne) : ?>
                        <tr>
                            <td><?= $ligne['jour'] ?></td>
                            <td><?= $ligne['visites'] ?> visite<?= $ligne['visites'] > 1 ? 's' : '' ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>


<?php require 'elements/footer.php'; ?>