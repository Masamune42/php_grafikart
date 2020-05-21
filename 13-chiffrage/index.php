<?php
// Démarrage de la session ou continue si une existe déjà
session_start();
// Utilisation comme un tableau
$_SESSION['role'] = 'administrateur';
// La session accepte des données complexes comme des tableaux (!$_COOKIE)
$_SESSION['user'] = [
    'username' => 'John',
    'password' => '0000'
];
// Si on veut supprimer la session
// unset($_SESSION['role']);
$title = "Page d'accueil";
$nav = 'index';
require_once 'elements/header.php';
?>


<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
</div>



<?php require_once 'elements/footer.php'; ?>