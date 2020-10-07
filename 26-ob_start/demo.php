<?php
// Mise en mémoire tampon tout ce qui est affiché
ob_start();
echo 'Salut !'; ?>
du texte
<?php
// Tout ce qui est en tampon est détruit
// ob_end_clean();
// Affiche les données en mémoire tampon
// ob_end_flush();
// Récupère en tout ce qui est en mémoire tampon pour le récupérer dans une variable
$content = ob_get_clean();
var_dump($content);