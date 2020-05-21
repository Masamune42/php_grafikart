<?php
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if ($_POST['pseudo'] === 'John' && $_POST['motdepasse'] === 'Doe') {
        session_start();
        $_SESSION['connecte'] = 1;
        header('Location: dashboard.php');
    } else {
        $erreur = "Identifiants incorrects";
    }
}

require_once 'functions/auth.php';
// Vérifie sur l'utilisateur est connecté et le redirige vers le dashboard si c'est le cas
if(est_connecte()) {
    header('Location: dashboard.php');
    exit;
}

require_once 'elements/header.php';
?>

<?php if ($erreur) : ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <div class="form-group">
        <input class="form-control" type="text" name="pseudo" placeholder="Nom d'utilisateur">
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="motdepasse" placeholder="Votre mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require_once 'elements/footer.php'; ?>