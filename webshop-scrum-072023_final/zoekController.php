<?php
// zoekController.php
declare(strict_types=1);

session_start();
spl_autoload_register();

use App\Services\ArtikelService;
use App\Services\CategorieService;
$artikelService = new ArtikelService();
$categorieService = new CategorieService();

if(isset($_POST["submit"])){
    $artikelLijst = $artikelService->displayArtikelsByName($_POST["zoekNaam"]);
    $hoofdCatLijst = $categorieService->displayOverviewHoofdcategorie();
    include_once 'App/Views/components/navbar.php'; 
    include_once 'App/Views/home/main.php';
    include_once 'App/Views/components/footer.php'; 
} else {
    echo "hier wordt nog hard gewerkt";
}