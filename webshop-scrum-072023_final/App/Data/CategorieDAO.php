<?php
//Data/CategorieDAO.php
declare(strict_types=1);

namespace App\Data;

use \PDO;
use PDOException;
use App\Data\DBConfig;
use App\Exceptions\DatabaseErrorException;

class CategorieDAO
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
    // Get overview of 'hoofdcategorie naam'
    public function getOverviewHoofdcategorie(): array
    {
        $sql = 'SELECT categorieId, naam
        FROM categorieen
        WHERE categorieId = 1 OR categorieId = 3 OR categorieId = 20 OR categorieId = 30
        order by categorieId asc';

        $resultSet = $this->dbh->query($sql);

        $lijst = array();

        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $this->dbh = null;
        return $lijst;
    }

    // Get overview of 'subcategorie naam'
    public function getOverviewSubcategorie($id): array
    {
        $sql = 'SELECT categorieId, naam
        FROM categorieen
        WHERE hoofdCategorieId = :hoofdCategorieId
        order by categorieId asc';

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array(
            ':hoofdCategorieId' => $id
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();

        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $this->dbh = null;
        return $lijst;
    }

    // ** UPDATE **

    // ** DELETE **

}
