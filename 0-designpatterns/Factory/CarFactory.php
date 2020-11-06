<?php

namespace App;

class CarFactory{
    /**
     * Permet de créer le type de voiture qu'on lui passe en paramètre
     *
     * @param string $type Type de voiture
     * @return Car
     */
    public static function getCar(string $type): Car
    {
        $type = ucfirst($type);
        // On définit le nom de la classe et on retourne une nouvelle voiture
        // ATTENTION : en utilisant les namespace, on indique le namespace COMPLET de la classe à retourner
        $class_name = "App\Car$type";
        return new $class_name();
    }
}