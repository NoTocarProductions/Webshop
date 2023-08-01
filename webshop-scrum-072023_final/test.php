<?php
//test.php
declare(strict_types=1);
spl_autoload_register();

use App\Services\ArtikelService;
use App\Services\CategorieService;
use Services\CategorieService as ServicesCategorieService;

print("dit is de test pagina <br>");
/*
$nummerID = 2;
$categorieShit = new CategorieService();
$categorieLijst = $categorieShit->displayOverviewSubcategorie(20);
print("<pre>");
print_r($categorieLijst);
print("</pre>");
*/

$artikelService = new ArtikelService();
$lijst = $artikelService->displayAllArtikelsFromCategorieId(6);
print("<pre>");
print_r($lijst);
print("</pre>");

include('App/Views/components/navbar.php');