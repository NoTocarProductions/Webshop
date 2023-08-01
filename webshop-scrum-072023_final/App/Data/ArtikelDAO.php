<?php
//Data/ArtikelDAO.php
declare(strict_types=1);

namespace App\Data;

use \PDO;
use PDOException;
use App\Exceptions\DatabaseErrorException;
use App\Data\DBConfig;
use App\Entities\Artikel;

class ArtikelDAO
{

    // Function to make connection to DB
    private $dbh;
    public function __construct()
    {
        try {
            $this->dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new DatabaseErrorException("Er is een probleem met de database connectie.");
        }
    }

    // ** CREATE **

    // ** READ **
    public function getOverviewArtikel(): array
    {
        $sql = 'SELECT a.*, c1.naam AS categorie_naam, c2.naam AS hoofdCategorie_naam
        FROM artikelen a
        INNER JOIN artikelcategorieen ac ON a.artikelId = ac.artikelId
        LEFT JOIN categorieen c1 ON ac.categorieId = c1.categorieId
        LEFT JOIN categorieen c2 ON c1.hoofdcategorieId = c2.categorieId
        ';

        $resultSet = $this->dbh->query($sql);

        $lijst = array();

        foreach ($resultSet as $rij) {
            $artikel = new Artikel((int)$rij['artikelId'], (string)$rij['ean'], (string)$rij['naam'], (string)$rij['beschrijving'], (float)$rij['prijs'], (int)$rij['gewichtInGram'], (int)$rij['voorraad'], (int) $rij['levertijd'], (string)$rij['hoofdCategorie_naam'], (string)$rij['categorie_naam']);
            array_push($lijst, $artikel);
        }
        $this->dbh = null;
        return $lijst;
    }

    public function getOverviewArtikelbyArtikelId(string $artikelId)
    {
        // $sql = 'SELECT a.*, c1.naam AS categorie_naam, c2.naam AS hoofdCategorie_naam
        // FROM artikelen a
        // INNER JOIN artikelcategorieen ac ON a.artikelId = ac.artikelId
        // LEFT JOIN categorieen c1 ON ac.categorieId = c1.categorieId
        // LEFT JOIN categorieen c2 ON c1.hoofdcategorieId = c2.categorieId
        // WHERE a.artikelId = :artikelId';
        $dbh = new PDO (
            DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = 'SELECT DISTINCT a.*, MAX(c1.naam) AS categorie_naam, MAX(c2.naam) AS hoofdCategorie_naam 
        FROM artikelen a 
        INNER JOIN artikelcategorieen ac ON a.artikelId = ac.artikelId 
        LEFT JOIN categorieen c1 ON ac.categorieId = c1.categorieId 
        LEFT JOIN categorieen c2 ON c1.hoofdcategorieId = c2.categorieId 
        WHERE a.artikelId = :artikelId 
        GROUP BY a.artikelId, a.ean, a.naam, a.beschrijving, a.prijs, a.gewichtInGram, a.bestelpeil, a.voorraad, a.minimumVoorraad, a.maximumVoorraad, a.levertijd, a.aantalBesteldLeverancier, a.maxAantalInMagazijnPLaats, a.leveranciersId';

        $stmt = $dbh->prepare($sql);

        // $stmt->execute(array(
        //     ':artikelId' => $artikelId
        // ));

        $stmt->bindParam("artikelId", $artikelId, PDO::PARAM_STR);
        $stmt->execute();
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);


        $artikel = new Artikel((int)$rij['artikelId'], (string)$rij['ean'], (string)$rij['naam'], (string)$rij['beschrijving'], (float)$rij['prijs'], (int)$rij['gewichtInGram'], (int)$rij['voorraad'], (int) $rij['levertijd'], (string)$rij['hoofdCategorie_naam'], (string)$rij['categorie_naam']);
        
            
        $dbh = null;
        return $artikel;
    }

    // Get artikel based on categorieID AND also give corresponding 'hoofdcategorie naam'
    public function getOverviewArtikelFromCategorieId(int $categorieId): array
    {

        $sql = 'SELECT a.*, c1.naam AS categorie_naam, c2.naam AS hoofdCategorie_naam
        FROM artikelen a
        INNER JOIN artikelcategorieen ac ON a.artikelId = ac.artikelId
        LEFT JOIN categorieen c1 ON ac.categorieId = c1.categorieId
        LEFT JOIN categorieen c2 ON c1.hoofdcategorieId = c2.categorieId
        WHERE c1.categorieId = :categorieId';

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(array(
            ':categorieId' => $categorieId
        ));

        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();

        foreach ($resultSet as $rij) {
            $artikel = new Artikel((int)$rij['artikelId'], (string)$rij['ean'], (string)$rij['naam'], (string)$rij['beschrijving'], (float)$rij['prijs'], (int)$rij['gewichtInGram'], (int)$rij['voorraad'], (int) $rij['levertijd'], (string)$rij['hoofdCategorie_naam'], (string)$rij['categorie_naam']);
            array_push($lijst, $artikel);
        }

        $this->dbh = null;
        return $lijst;
    }


    public function searchArtikelsByName($naam): ?array
    {

        $sql = "SELECT DISTINCT a.*, MAX(c1.naam) AS categorie_naam, MAX(c2.naam) AS hoofdCategorie_naam
        FROM artikelen a
        INNER JOIN artikelcategorieen ac ON a.artikelId = ac.artikelId
        LEFT JOIN categorieen c1 ON ac.categorieId = c1.categorieId
        LEFT JOIN categorieen c2 ON c1.hoofdcategorieId = c2.categorieId
        WHERE a.naam LIKE CONCAT('%', :naam, '%')
        GROUP BY a.artikelId, a.ean, a.naam, a.beschrijving, a.prijs, a.gewichtInGram, a.bestelpeil, a.voorraad,
         a.minimumVoorraad, a.maximumVoorraad, a.levertijd, a.aantalBesteldLeverancier,
         a.maxAantalInMagazijnPLaats, a.leveranciersId";

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute(array(
            ':naam' => $naam
        ));

        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();

        foreach ($resultSet as $rij) {
            $artikel = new Artikel((int)$rij['artikelId'], (string)$rij['ean'], (string)$rij['naam'], (string)$rij['beschrijving'], (float)$rij['prijs'], (int)$rij['gewichtInGram'], (int)$rij['voorraad'], (int) $rij['levertijd'], (string)$rij['hoofdCategorie_naam'], (string)$rij['categorie_naam']);
            array_push($lijst, $artikel);
        }

        $this->dbh = null;
        return $lijst;
    }

    // ** UPDATE **

    // ** DELETE **

}
