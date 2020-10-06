<?php

// CONNEXION
try {
    // Le dernier paramètre déclare l'utilisation par défaut du PDO
    $pdo = new PDO('mysql:host=localhost;dbname=pdo;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$error = null;
$success = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'Votre article a bien été modifié';
    }
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    // Création d'un tableau associatif
    $post = $query->fetch();
    // Création d'un objet avec chaque nom de propriété qui correspond au nom d'une colonne (peut être déclaré par défaut pour le PDO)
    // $posts = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}
require '../elements/header.php'; ?>

<div class="container">
    <p>
        <a href="./">Revenir au listing</a>
    </p>
    <?php if ($success) : ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php endif ?>
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif ?>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name) ?>">
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control" name="content"><?= htmlentities($post->content) ?></textarea>
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>

</div>
<?php require '../elements/footer.php';
