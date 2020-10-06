<?php

use App\Post;

require_once '../vendor/autoload.php';
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

try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('location: edit.php?id=' . $pdo->lastInsertId());
        exit;
    }
    $query = $pdo->query('SELECT * FROM posts');
    // Création d'un tableau associatif (si pas de paramètre par défaut)
    // $posts = $query->fetchAll();
    // Création d'un objet utilisant la class Post
    // PHPDoc qui indique la nature de ce que l'on récupère
    /** @var Post[] */
    // Méthode 1 : sans use
    // $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Post');
    // Méthode 2 : avec use et Post::class qui renvoie une chaine de caractères
    $posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
    // Création d'un objet avec chaque nom de propriété qui correspond au nom d'une colonne (peut être déclaré par défaut pour le PDO)
    // $posts = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    $error = $e->getMessage();
}

require '../elements/header.php'; ?>

<div class="container">
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif ?>
    <?php foreach ($posts as $post) : ?>
        <h2><a href="edit.php?id=<?= $post->id ?>"><?= $post->name ?></a></h2>
        <p class="small text-muted">
            Ecrit le : <?= $post->created_at->format('d/m/Y H:i'); ?>
        </p>
        <p>
            <?= nl2br(htmlentities($post->getExcerpt())) ?>
        </p>
    <?php endforeach ?>

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
