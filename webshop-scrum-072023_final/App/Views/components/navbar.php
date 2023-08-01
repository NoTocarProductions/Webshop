<!--App/Views/components/navbar.php-->
<!DOCTYPE html>

<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="public/css/navbar.css">
<link rel="stylesheet" type="text/css" href="public/css/main.css">
<link rel="stylesheet" type="text/css" href= "public/css/footer.css">
<link rel="icon" type="image/x-icon" href="public/img/Home.png">
<title>Webshop</title>

<header>
    <img src="public/img/logo_prularia_wit.png" alt="logo prularia wit">
</header>

<body>
<nav>
    <div class="navbar">

        <div class="home">
            <a href="homeController.php"><img class="homeImg" src="public/img/Home.png" alt="startpagina" title="Startpagina"></a>
        </div>

        <div class="search">
            <!-- <div class="zoekOpNaam"> -->
            <form action="zoekController.php" method="post" class="zoekOpNaam" name="zoekArtikel">
                <input class="inputNavSearch" type="text" name="zoekNaam" placeholder="Artikel zoeken op naam" required />
                <button class="buttonNavSend" type="submit" name="submit" value="submit"> Zoeken </button>
            </form>
            <!-- </div> -->

            <form method="post" class="zoekOpCategorie" name="zoekCategorie">
                <select class="inputNavSearch" name="zoekNaam" required>
                    <option value="" selected>-- Zoek op categorie --</option>
                    <?php
                    foreach ($hoofdCatLijst as $hoofdCat) {
                    ?>
                        <option value="<?php echo $hoofdCat["categorieId"]; ?>"><?php echo $hoofdCat["naam"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <!-- <input class="inputNavSearch" type="text" name="zoekNaam" placeholder="Zoek op categorie" required /> -->
                <button class="buttonNavSend" type="submit" name="submit" value="submit"> Zoeken </button>
            </form>
        </div>

        <div class="pic">
            <a href=""><img class="wens" src="public/img/Wishlist.png" alt="wenslijst" title="Wenslijst"></a>
            <a href=""><img class="winkel" src="public/img/Winkelkar.png" alt="winkelwagen" title="Winkelwagen"></a>
            <a href=""><img class="profiel" src="public/img/Gebruiker.png" alt="profiel" title="Profiel"></a>
        </div>
    </div>
</nav>