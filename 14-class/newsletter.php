<?php
$error = null;
$success = null;
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    // filter_var : filtrage de variable avec le second paramètre
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Définition du chemin d'accès du fichier
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.txt';
        // Ecriture dans le fichier
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        $success = "Votre email a bien été enregistré";
    } else {
        $error = "Email invalide";
    }
}
require 'elements/header.php';
?>
<h1>S'inscrire à la newsletter</h1>

<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad odit voluptates ipsa tempora hic mollitia ut nesciunt quisquam vel eum nobis quasi, tenetur adipisci animi fugiat ea vitae illo aliquid.
</p>

<?php if($error) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif ?>

<?php if($success) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif ?>

<form action="newsletter.php" method="post" class="form-inline">
    <div class="form-group">
        <input type="email" name="email" placeholder="Entrer votre email" value="<?= htmlentities($email) ?>" required>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </div>
</form>

<?php
require 'elements/footer.php';
