<?php
class Message
{
    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    // Fonction qui décode du JSON et renvoie un objet Message (self) au bon format
    public static function fromJSON($json)
    {
        // 2e param : true -> tableau associatif
        $data = json_decode($json, true);
        return new self($data['username'], $data['message'], new DateTime("@" . $data['date']));
    }

    public function __construct($username, $message, $date = null)
    {
        $this->username = $username;
        $this->message = $message;
        // Si $date existe, on retourne date, sinon new DateTime()
        $this->date = $date ?: new DateTime();
    }

    // Si On a repéré des erreurs dans l'envoie du formulaire, renvoie false, sinon true
    public function isValid()
    {
        return empty($this->getErrors());
    }

    // Vérifie que chaque champ n'a pas d'erreur et renvoie un tableau qui les contient s'il y en a
    public function getErrors()
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }

    // Fonction qui affiche au format HTML les messages
    public function toHTML()
    {
        $username = htmlentities($this->username);
        $this->date->setTimeZone(new DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d/m/Y à H:i');
        $message = nl2br(htmlentities($this->message));
        return <<<HTML
        <p>
            <strong>{$username}</strong> <em>le {$date}</em><br>
            {$message}
        </p>
HTML;
    }

    // Fonction qui encode les données au format JSON
    public function toJSON()
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
}
