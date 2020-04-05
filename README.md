# Cours PHP Grafikart
Cours de PHP de la chaine YouTube Grafikart : https://www.youtube.com/playlist?list=PLjwdMgw5TTLVDv-ceONHM_C19dPW1MAMD

## Fonctions utilisateurs
````php
// typage fort : converti tout ce qui rentré dans la fonction en string
function demander_creneaux(string $phrase = 'Veuillez entrer vos créneaux')
````
````php
// Indique que les types sont stricts dans tout le code
declare(strict_types=1);
````
````php
// Indique la valeur de retour
function demander_creneau(string $phrase = 'Veuillez entrer un créneau'): array
````
````php
// ?string : indique que le paramètre null ou un string
function repondre_oui_non(?string $phrase = null): bool
````
````php
// ?bool : indique que la fonction renvoie null ou un booléen
function repondre_oui_non(?string $phrase = null): ?bool
````