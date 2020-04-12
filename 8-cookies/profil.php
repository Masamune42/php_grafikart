<?php
$nom = null;
// Si on a cliqué sur "se déconnecter"
if(!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    // Détruction du cookie
    unset($_COOKIE['utilisateur']);
    // Re-définition du cookie à une date antérieure = cookie automatiquement périmé
    setcookie('utilisateur', '', time() -10);
}
if (!empty($_COOKIE['utilisateur'])) {
    $nom = $_COOKIE['utilisateur'];
}
if (!empty($_POST['nom'])) {
    setcookie('utilisateur', $_POST['nom']);
    $nom = $_POST['nom'];
}
require 'elements/header.php';
?>
<?php if ($nom) : ?>
    <h1>Bonjour <?= htmlentities($nom) ?></h1>
    <a href="profil.php?action=deconnecter">Se déconnecter</a>
<?php else : ?>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="nom" placeholder="Entrer votre nom">
        </div>
        <button class="btn btn-primary">
            Se connecter
        </button>
    </form>
<?php endif ?>


<?php require 'elements/footer.php'; ?>