<?php
require_once 'functions.php';
$title = "Notre menu";
// AVANT
// $menu = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv');
// $lignes = explode(PHP_EOL, $menu);
// APRES, mais récupère le saut de ligne à la fin
$lignes = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv');
foreach ($lignes as $k => $ligne) {
    // \t -> tabulation
    $lignes[$k] = explode("\t", trim($ligne));
}
require 'elements/header.php';
?>

<h1>Menu</h1>
<?php foreach ($lignes as $ligne) : ?>
    <?php if (count($ligne) === 1) : ?>
        <h2><?= $ligne[0] ?></h2>
    <?php else : ?>
        <div class="row">
            <div class="col-sm-8">
                <p>
                    <strong><?= $ligne[0] ?></strong>
                    <div>

                        <?= $ligne[1] ?>
                    </div>
                </p>
            </div>
            <div class="col-sm-4">
                <strong><?= number_format($ligne[2], 2, ',', ' ') ?> €</strong>
            </div>
        </div>

    <?php endif ?>
<?php endforeach ?>
<?php

require 'elements/footer.php';
