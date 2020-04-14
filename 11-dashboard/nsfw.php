<?php
// age non défini avant d'avoir lu le cookie
$age = null;

// On vérifie dans la requête POST si 'birthday' a été envoyé
if (!empty($_POST['birthday'])) {
    setcookie('birthday', $_POST['birthday']);
    // On défini manuellement la valeur du cookie car sinon la valeur ne sera effective qu'à la prochaine requête
    $_COOKIE['birthday'] = $_POST['birthday'];
}

// On vérifie dans la cookie si 'birthday' existe
if (!empty($_COOKIE['birthday'])) {
    // On converti 'birthday' en int pour calculer l'âge de la personne
    $birthday = (int) $_COOKIE['birthday'];
    $age = (int) date('Y') - $birthday;
}


require 'elements/header.php'; ?>

<!-- Si l'âge de la personne est supérieur à 18 -->
<?php if ($age > 18) : ?>
    <h1>Du contenu réservé aux adultes</h1>
    <!-- Si l'âge est différent d'une valeur non définie, cela signifie qu'il n'a pas l'âge requis -->
<?php elseif ($age !== null) : ?>
    <div class="alert alert-danger">Vous n'avez pas l'âge requis pour voir le contenu</div>
    <!-- Sinon, on demande l'année de naissance -->
<?php else : ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="birthday">Section réservée pour les adultes, entrer votre année de naissance :</label>
            <select name="birthday" id="birthday" class="form-control">
                <?php for ($i = 2010; $i > 1919; $i--) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
            </select>
        </div>
        <button type="submit">Envoyer</button>
    </form>
<?php endif ?>


<?php require 'elements/footer.php'; ?>