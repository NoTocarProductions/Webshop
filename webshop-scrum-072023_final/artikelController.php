<?php
// artikelController.php
declare(strict_types=1);

session_start();
spl_autoload_register();

use App\Services\ArtikelService;
use App\Services\CategorieService;
$artikelService = new ArtikelService();
$categorieService = new CategorieService();

$artikelOverview = $artikelService->displayArtikelFromArtikelId($_GET["artikelId"]);
$hoofdCatLijst = $categorieService->displayOverviewHoofdcategorie();


include_once 'App/Views/components/navbar.php';
include_once 'App/Views/home/artikelpagina.php';
include_once 'App/Views/components/footer.php';
