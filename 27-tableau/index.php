<?php

use App\NumberHelper;
use App\TableHelper;
use App\URLHelper;

define('PER_PAGE', 20);

require 'vendor/autoload.php';
$pdo = new PDO("sqlite:./data.sql", null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = "SELECT * FROM products ";
$queryCount = "SELECT COUNT(id) as count FROM products";
$params = [];
$sortable = ["id", "name", "city", "price", "address"];

// Rechercher par ville
if (!empty($_GET['q'])) {
    $query .= "     WHERE city LIKE :city ";
    $queryCount .= "     WHERE city LIKE :city ";
    $params['city'] = '%' . $_GET['q'] . '%';
}

// Organisation
if (!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)) {
    $direction = isset($_GET['dir']) ? $_GET['dir'] : 'asc';
    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc';
    }
    $query .= " ORDER BY " . $_GET['sort'] . " $direction ";
}

// Pagination
$page = isset($_GET['p']) ? $_GET['p'] : 1;
$offset = ($page - 1) * PER_PAGE;

$query .= "LIMIT " . PER_PAGE . " OFFSET $offset";

$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();

$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$count = (int)$statement->fetch()['count'];
$pages = ceil($count / PER_PAGE);

// dump($count)
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biens immobiliers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="p-4">
        <h1>Les biens immobiliers</h1>
        <form action="" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="q" placeholder="Rechercher par ville" value="<?= isset($_GET['q']) ? htmlentities($_GET['q']) : null ?>">
            </div>
            <button class="btn btn-primary">Rechercher</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= TableHelper::sort('id', 'ID', $_GET) ?></th>
                    <th><?= TableHelper::sort('name', 'Nom', $_GET) ?></th>
                    <th><?= TableHelper::sort('price', 'Prix', $_GET) ?></th>
                    <th><?= TableHelper::sort('city', 'Ville', $_GET) ?></th>
                    <th><?= TableHelper::sort('address', 'Adresse', $_GET) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= NumberHelper::price($product['price'], '€') ?></td>
                        <td><?= $product['city'] ?></td>
                        <td><?= $product['address'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($pages > 1 && $page > 1) : ?>
            <a href="?<?= URLHelper::withParam($_GET, "p", $page - 1) ?>" class="btn btn-primary">Page précédente</a>
        <?php endif ?>
        <?php if ($pages > 1 && $page < $pages) : ?>
            <a href="?<?= URLHelper::withParam($_GET, "p", $page + 1) ?>" class="btn btn-primary">Page suivante</a>
        <?php endif ?>
    </div>
</body>

</html>