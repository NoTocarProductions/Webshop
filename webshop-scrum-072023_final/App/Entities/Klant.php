<?php
//Entities/Klant.php
declare(strict_types=1);

namespace Entities;

class Klant
{
    private ?int $klantId;
    private ?int $facturatieAdresId;
    private ?int $leveringsAdresId;

    public function __construct(?int $klantId, ?int $facturatieAdresId, ?int $leveringsAdresId) {
        $this->klantId = $klantId;
        $this->facturatieAdresId = $facturatieAdresId;
        $this->leveringsAdresId = $leveringsAdresId;
    }

    public function getKlantId() : int {
        return $this->klantId;
    }

    public function getFacturatieAdresId() : int {
        return $this->facturatieAdresId;
    }

    public function getLeveringsAdresId() : int {
        return $this->leveringsAdresId;
    }

}
