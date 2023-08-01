<?php
// index.php
declare(strict_types=1);
?>

<!-- START MAIN-->
<main>
    <section class="productInfo">
        <table class="artikelLijst">
            <?php foreach ($artikelLijst as $artikel) { ?>
                <tr>
                    <td colspan="2"><a href="artikelController.php?artikelId=<?php echo $artikel->getArtikelId(); ?>"><?php echo $artikel->getNaam(); ?>: </a>:</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;&nbsp;<?php echo $artikel->getBeschrijving(); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;<?php echo $artikel->getPrijsInEuro(); ?></td>
                    <td>
                        <form action="" method="post">
                            <input class="inputMainAmount" type="number" name="aantal" min="1" max="999" step="1" value="1" required>

                            <?php if ($artikel->getVoorraad() <= 0) : ?>
                                <button type="submit" name="add" value=<?php print($artikel->getArtikelId()); ?> disabled>
                                    <img src="public/img/Winkelkar.png" alt="Bestel" class="bestelBtn">
                                </button>
                                <span class="voorraadMelding">Uitverkocht</span>
                            <?php else : ?>
                                <button type="submit" name="add" value=<?php print($artikel->getArtikelId()); ?>>
                                    <img src="public/img/Winkelkar.png" alt="Bestel" class="bestelBtn">
                                </button>
                            <?php endif; ?>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            <?php } ?>
        </table>
    </section>



    <div id="cart-container">
        <div class="cart-content">
            <table>
                <caption class="cart-container-caption">Winkelkar</caption>
                <tbody>
                    <tr>
                        <th class="cart-table-header">
                            Artikel
                        </th>

                        <th class="cart-table-header">
                            Aantal
                        </th>

                        <th class="cart-table-header">
                            Prijs
                        </th>

                        <form method="post" action="">
            
                             <?php  if (isset($_SESSION["gekozenArtikels"])) {
                                foreach ($_SESSION["gekozenArtikels"] as $cart) { ?> 

                    <tr>
                        <td>
                            <?php print($cart['name']);
                            ?>
                        </td>

                        <td>

                        </td>

                        <td>
                            &euro; <?php print($cart['prijs']);
                                    ?>
                        </td>

                        <td>
                            <button value=<?php  print($cart['id']); ?> name='delete' style="font-size: small;"><img src="images/delete.jpg" alt="clickpng" border="0"></button>
                        </td>
                    </tr>
            <?php  }
                            } ?>
            </form>
                </tbody>
            </table>


            <div class="totaal">
                <?php if (isset($_SESSION["totaalPrijs"])) { ?>
                    <span class="cart-total-name">Totaal:</span>

                    <span class="cart-total-price"> &euro; <?php print($_SESSION["totaalPrijs"]); ?> </span>
                <?php } ?>
            </div>

            <form method="POST" action="register.php">
                <button name='bestel'>Checkout </button>
            </form>
        </div>
    </div>

    <!--END MAIN-->
</main>