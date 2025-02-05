<?php

namespace App\Service;

class JsonService
{
    public function lire(string $fichier): array
    {
        $contenu = file_get_contents($fichier);
        return json_decode($contenu, true);
    }
}
