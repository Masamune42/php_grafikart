<?php
// AUCUN CONTENU AFFICHE AVANT LA MANIPULATION D'EN-TÊTE HTTP
// time() + 60 * 60 * 24 : le cookie va expirer dans 24h
setcookie('utilisateur','John', time() + 60 * 60 * 24);

var_dump($_COOKIE);
