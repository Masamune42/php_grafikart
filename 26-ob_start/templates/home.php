<h1>Ma homepage</h1>

<!-- On charge la page avec le nom indiqué = changement dynamique du lien -->
<a href="<?= $router->generate('contact') ?>">Nous contacter</a>
<!-- Génère le lien dynamiquement -->
<a href="<?= $router->generate('article', ['id' => 60, 'slug' => 'nimporte-quoi']) ?>">Voir l'article</a>

<?php ob_start() ?>
<script>
    alert('Salut')
</script>
<?php $pageJavascript = ob_get_clean(); ?>