<?php
// homeController.php
declare(strict_types=1);

session_start();
spl_autoload_register();

use App\Services\ArtikelService;
use App\Services\CategorieService;
$artikelService = new ArtikelService();
$categorieService = new CategorieService();

if (isset($_GET["action"]) && $_GET["action"] === "getProduct") {
    $categorieId = $_POST["id"];
    $product = $artikelService->displayAllArtikelsFromCategorieId((int)$categorieId);
    $_SESSION["product"] = $product;
} else {
    $artikelLijst = $artikelService->displayAllArtikels();
    $hoofdCatLijst = $categorieService->displayOverviewHoofdcategorie();
}


if (isset($_POST["add"])) {
    if (!isset($_SESSION["gekozenArtikels"])) {
        $_SESSION["gekozenArtikels"] = array();
        $_SESSION["totaalPrijs"] = 0;
    }
    $id = $_POST["add"];
    $getArtikel = $artikelService->displayArtikelFromArtikelId($id);
    $artikelId = $getArtikel->getArtikelId();
    $artikelNaam = $getArtikel->getNaam();
    // $aantal = $_POST["artikelAantal"];
    $artikelPrijs = $getArtikel->getPrijs();
    
    $selectedArtikels = array(
        'id'=> $artikelId,
        'name' => $artikelNaam,
        // 'amount' => $aantal,
        'prijs' =>$artikelPrijs
    );

    foreach ($_SESSION["gekozenArtikels"] as &$item) {
        if ($item['id'] == $artikelId) {
            // $item['aantal'] += 1;
            $_SESSION["totaalPrijs"] += $artikelPrijs;
        
        $found = true;
        break;
        }
    }

    if (!$found) {
        $_SESSION["gekozenArtikels"][] = $selectedArtikels;
        $_SESSION["totaalPrijs"] += $artikelPrijs;
    }
}

if (isset($_SESSION["gekozenArtikels"]) && count($_SESSION["gekozenArtikels"]) > 0) {
    if (isset($_POST["delete"])) {
        for ($i=0; $i<=count($_SESSION["gekozenArtikels"]); $i++) {
            if ($_SESSION["gekozenArtikels"][$i]['id'] == $_POST["delete"]) {
                $_SESSION["totaalPrijs"] -= $_SESSION["gekozenArtikels"][$i]['prijs'];

                array_splice($_SESSION["gekozenArtikels"], $i, 1);
                break;
            }
        }
    }
}



include_once 'App/Views/components/navbar.php'; 
include_once 'App/Views/home/main.php';
include_once 'App/Views/components/footer.php'; 
