<?php
//Services/ArtikelService.php

namespace App\Services;

use App\Data\ArtikelDAO;
use App\Exceptions\ArtikelNotFoundException;
use App\Entities\Artikel;

class ArtikelService
{

    private $artikelDAO;

    public function __construct() {
        $this->artikelDAO = new ArtikelDAO();
    }

    public function displayAllArtikels() {
        $artikels = $this->artikelDAO->getOverviewArtikel();
        return $artikels;
    }

    public function displayArtikelFromArtikelId(string $id) : Artikel {
        $artikel = $this->artikelDAO->getOverviewArtikelbyArtikelId($id);
        return $artikel;
    }

    public function displayAllArtikelsFromCategorieId($id) {
        $artikels = $this->artikelDAO->getOverviewArtikelFromCategorieId($id);
        return $artikels;
    }

    public function displayArtikelsByName($naam) {
        $artikels = $this->artikelDAO->searchArtikelsByName($naam);
        if (!$artikels) {
            throw new ArtikelNotFoundException("Dit product bestaat niet.");
        } else {
            return $artikels;
        }
    }


}
