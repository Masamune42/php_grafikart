<?php
namespace App;

use PDO;

class App {

    public static $pdo;

    public static $auth;

    // Fonction static qui renvoie une instance de PDO
    public static function getPDO(): PDO
    {
        if (!self::$pdo) {
            self::$pdo = new PDO("sqlite:../data.sqlite", null, null, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }

    // Fonction qui renvoie une instance de l'authentification
    public static function getAuth(): Auth
    {
        if (!self::$auth) {
            self::$auth = new Auth(self::getPDO(), '/login.php');
        }
        return self::$auth;
    }

}