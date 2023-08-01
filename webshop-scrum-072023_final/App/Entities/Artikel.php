<?php
//Entities/Artikel.php
declare(strict_types=1);

namespace App\Entities;

class Artikel
{
    private int $artikelId;
    private string $ean;
    private string $naam;
    private string $beschrijving;
    private float $prijs;
    private int $gewichtInGram;
    private int $voorraad;
    private int $levertijd;
    private ?string $naamHoofdcategorie;
    private ?string $naamSubcategorie;

    public function __construct(int $artikelId, string $ean, string $naam, string $beschrijving, float $prijs, int $gewichtInGram, int $voorraad, int $levertijd, string $naamHoofdcategorie, string $naamSubcategorie)
    {

        $this->artikelId = $artikelId;
        $this->ean = $ean;
        $this->naam = $naam;
        $this->beschrijving = $beschrijving;
        $this->prijs = $prijs;
        $this->gewichtInGram = $gewichtInGram;
        $this->voorraad = $voorraad;
        $this->levertijd = $levertijd;
        $this->naamHoofdcategorie = $naamHoofdcategorie;
        $this->naamSubcategorie = $naamSubcategorie;
    }

    public function getArtikelId(): int
    {
        return $this->artikelId;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getBeschrijving(): string
    {
        return $this->beschrijving;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }

    public function getPrijsEuro(): string
    {
        return "€ " . round($this->prijs, 2);
    }

    public function getPrijsInEuro(): string
    {
        $prijsInEuro = sprintf("€ %01.2f", $this->prijs);
        return $prijsInEuro;
    }

    public function getGewichtInGram(): int
    {
        return $this->gewichtInGram;
    }

    public function getVoorraad(): int
    {
        return $this->voorraad;
    }

    public function getLevertijd(): int
    {
        return $this->levertijd;
    }

    public function getNaamHoofdcategorie(): ?string
    {
        return $this->naamHoofdcategorie;
    }

    public function getNaamSubcategorie(): ?string
    {
        return $this->naamSubcategorie;
    }

    public function setEan(string $ean)
    {
        $this->ean = $ean;
    }

    public function setNaam(string $naam)
    {
        $this->naam = $naam;
    }

    public function setBeschrijving(string $beschrijving)
    {
        $this->beschrijving = $beschrijving;
    }

    public function setPrijs(float $prijs)
    {
        $this->prijs = $prijs;
    }

    public function setGewichtInGram(int $gewichtInGram)
    {
        $this->gewichtInGram = $gewichtInGram;
    }

    public function setVoorraad(int $voorraad)
    {
        $this->voorraad = $voorraad;
    }

    public function setLevertijd(int $levertijd)
    {
        $this->levertijd = $levertijd;
    }

    public function setNaamHoofdcategorie(?string $naamHoofdcategorie)
    {
        $this->naamHoofdcategorie = $naamHoofdcategorie;
    }

    public function setNaamSubcategorie(?string $naamSubcategorie)
    {
        $this->naamSubcategorie = $naamSubcategorie;
    }
}
