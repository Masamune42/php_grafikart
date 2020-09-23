<?php
class Creneau
{
    public $debut;
    public $fin;

    public function __construct(int $debut, int $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    /**
     * On vérifie si l'heure rentrée est inclus dans l'heure de début et de fin du créneau
     *
     * @param integer $heure heure à tester
     * @return bool true si l'heure est incluse dans le créneau, sinon false
     */
    public function inclusHeure(int $heure)
    {
        return $heure >= $this->debut && $heure <= $this->fin;
    }

    /**
     * Affichage du créneau
     *
     * @return string code HTML d'affichage
     */
    public function toHTML () {
        return "<strong>{$this->debut}h</strong> à <strong>{$this->fin}h</strong>";
    }

    /**
     * On vérifie que le créaneau de début et de fin ne se croisent pas
     *
     * @param Creneau $creneau Le créneau testé
     * @return bool true si les créneaux se croisent, sinon false
     */
    public function intersect(Creneau $creneau)
    {
        return $this->inclusHeure($creneau->debut) ||
        $this->inclusHeure($creneau->fin) ||
        ($this->debut > $creneau->debut && $this->fin < $creneau->fin);
    }
}
