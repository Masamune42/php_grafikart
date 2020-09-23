<?php
function est_connecte()
{
    // Si la session n'est pas active, en démarre une
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

function forcer_utilisateur_connecte()
{
    if (!est_connecte()) {
        header('Location: login.php');
        exit;
    }
}
