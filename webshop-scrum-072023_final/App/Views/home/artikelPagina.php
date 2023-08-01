<?php
// index.php
declare(strict_types=1);
?>

<!-- START MAIN artikel detail-->
<main>
    <section class=artikelInfo>
        <table class="artikelDetail">
            <tr>
                <td colspan="2"><?php echo $artikelOverview->getNaam(); ?></td>
            </tr>
            <tr>
                <td rowspan="3"><img class="afbeelding" src="public/img/Afbeelding.png" alt="afbeelding" title="Afbeelding" width="184" height="276"></td>
                <td><?php echo $artikelOverview->getPrijsInEuro(); ?></td>
            </tr>
            <tr>
                <td>aantal + bestelknop</td>
            </tr>
            <tr>
                <td colspan="2">out of stock + levertermijn als van toepassing</td>
            </tr>
            <tr>
                <td colspan="2">Omschrijving</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $artikelOverview->getBeschrijving(); ?></td>
            </tr>
            <tr>
                <td colspan="2">Artikelspecificaties</td>
            </tr>
            <tr>
                <td>Ean: </td>
                <td><?php echo $artikelOverview->getEan(); ?></td>
            </tr>
            <tr>
                <td>Gewicht (in gram): </td>
                <td><?php echo $artikelOverview->getGewichtInGram(); ?></td>
            </tr>
            <tr>
                <td colspan="2">Reviews</td>
            </tr>

        </table>
    </section>
    <!--END MAIN artikel detail-->
</main>