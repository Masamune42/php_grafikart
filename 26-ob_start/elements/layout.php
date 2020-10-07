<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Mon site' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : '' ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?= $pageContent ?>
    </div>
    <?= isset($pageJavascript) ? $pageJavascript : '' ?>
</body>

</html>