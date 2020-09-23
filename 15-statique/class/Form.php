<?php

class Form
{

    // Variable static
    public static $class = "form-control";

    /**
     * Crée une checkbox avec le nom du parfum et détermine si elle doit être cochée avec la requête GET reçue.
     * Méthode statique
     * @param string $name nom de la checkbox 
     * @param string $value valeur de la checkbox
     * @param array $data tableau de données reçu en méthode GET
     * @return string une checkbox
     */
    public static function checkbox($name, $value, $data)
    {
        $attributes = '';
        // $data[$name] -> $_GET['parfum'], parfum étant un tableau rempli par les checkbox
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }

        $attributes = ' class="' . self::$class . '"';
        return <<<HTML
    <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
    }

    /**
     * Crée un radio avec le nom du supplément et détermine si il doit être coché avec la requête GET reçue
     *
     * @param string $name nom du radio 
     * @param string $value valeur du radio
     * @param string $data donnée reçue en méthode GET
     * @return string un radio
     */
    public static function radio($name, $value, $data)
    {
        $attributes = '';
        // $data[$name] -> $_GET['supplement'], supplement étant la valeur renvoyée par le radio
        if (isset($data[$name]) && $value == $data[$name]) {
            $attributes .= 'checked';
        }
        return <<<HTML
    <input type="radio" name="$name" value="$value" $attributes>
HTML;
    }

    /**
     * Permet de créer un select avec des options
     *
     * @param string $name nom du select
     * @param string $value valeur de chaque option
     * @param array $options tableau des jours de la semaine
     * @return string code HTML pour créer un select avec les options
     */
    public static function select($name, $value, $options)
    {
        $html_options = [];
        foreach ($options as $k => $option) {
            $attributes = $k == $value ? ' selected' : '';
            $html_options[] = "<option value='$k' $attributes>$option</option>";
        }
        return "<select class='form-control' name='$name'>" . implode($html_options) . '</select>';
    }
}
