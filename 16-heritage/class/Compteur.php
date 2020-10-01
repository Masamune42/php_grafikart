<?php
class Compteur
{
    const INCREMENT = 1;
    protected $fichier;

    public function __construct($fichier)
    {
        $this->fichier = $fichier;
    }

    public function incrementer()
    {
        $compteur = 1;
        if (file_exists($this->fichier)) {
            // Si le fichier existe on incrémente
            $compteur = (int) file_get_contents($this->fichier);
            // Si on met self::INCREMENT, on fera référence à Compteur et pas DoubleCompteur
            // static : il va comprendre dans quel contexte il se trouve (enfant...)
            $compteur += static::INCREMENT;
        }
        file_put_contents($this->fichier, $compteur);
    }

    public function recuperer()
    {
        if (!file_exists($this->fichier)) {
            return 0;
        }
        return file_get_contents($this->fichier);
    }
}
