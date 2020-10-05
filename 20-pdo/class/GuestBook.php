<?php
require_once 'Message.php';

class GuestBook
{

    private $file;

    public function __construct($file)
    {
        $directory = dirname($file);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        if (file_exists($file)) {
            touch($file);
        }

        $this->file = $file;
    }

    // Fonction qui ajoute un message suivi d'un saut de ligne (PHP_EOL) au fichier contenant les messages
    public function addMessage($message)
    {
        file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }

    // Fonction qui récupère tous les messages contenus dans le fichier des messages
    public function getMessages()
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        foreach ($lines as $line) {
           $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }
}
