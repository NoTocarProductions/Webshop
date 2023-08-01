<?php
//Services/CategorieService.php

namespace App\Services;
use App\Data\CategorieDAO;

class CategorieService
{

    private $categorieDAO;

    public function __construct()
    {
        $this->categorieDAO = new CategorieDAO();
    }

    public function displayOverviewHoofdcategorie()
    {
        $categorieLijst = $this->categorieDAO->getOverviewHoofdcategorie();
        return $categorieLijst;
    }

    public function displayOverviewSubcategorie($id)
    {
        $categorieLijst = $this->categorieDAO->getOverviewSubcategorie($id);
        return $categorieLijst;
    }
}