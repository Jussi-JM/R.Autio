<?php require "config.php";?>
<?php require "includes/header.php"; ?>

<div class="container marketing">
<div id="contact" class="container-fluid text-center">
    <h3>Ota yhteyttä, palaamme asiaan 24 tunnin kuluessa.</h3>
</div>
</div>

<div class="container marketing">
<div id="contact" class="container-fluid bg-light">

    <div class="row">
    <div class="col-md-5">
        <h2>Yhteystiedot</h2>
    </div>

    <div class="col-md-7">
        <h2>Yhteydenotto</h2>
    </div>

    <div class="row">
        <div class="col-md-5">
            <p>Aukioloajat: MA-PE 8.00 - 17.00</p>
            <p><span class="fas fa-map-marker-alt"></span> Tornio, FI</p>
            <p><span class="fas fa-phone"></span> +1234567</p>
            <p><span class="fas fa-envelope"></span> toimisto@r.autio.com</p>
            <p>Päivystysnumero kiireellisissä tapauksissa: </p>
            <p><span class="fas fa-phone"></span> +01234567</p>
        </div>

        <div class="col-md-7">
            <form action="yhteydenotto.php" method="post">
                <div class="row">
                    <div class="col form-group">
                        <input class="form-control" id="name" name="name" placeholder="Nimi" type="text" required>
                    </div>
                    <div class="col form-group">
                        <input class="form-control" id="email" name="email" placeholder="Sähköpostiosoite" type="email" required>
                    </div>
                </div>
                <textarea class="form-control" id="comments" name="comments" placeholder="Viesti" rows="5"></textarea><br>
                <div class="row">
                    <div class="col form-group">
                        <button class="btn btn-outline-secondary pull-right" type="submit">Lähetä</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="container marketing">
    <div id="contact" class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <h4>Toimistotyöntekijät</h4>
                <ul>
                <?php
                    // Haetaan toimistotyöntekijöiden tiedot tietokannasta
                    $query = "SELECT etunimi, sukunimi, puhelin FROM kayttajat WHERE rooli = 'toimisto'";
                    $stmt = $yhteys->query($query);

                    // Tulostetaan toimistotyöntekijöiden tiedot
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>" . $row['etunimi'] . " " . $row['sukunimi'] . " - " . $row['puhelin'] . "</li>";
                    }
                ?>
                </ul>
            </div>

            <div class="col-md-7">
                <h4>Huoltohenkilöt</h4>
                <ul>
                <?php
                    // Haetaan huoltohenkilöiden tiedot tietokannasta
                    $query = "SELECT etunimi, sukunimi, puhelin FROM kayttajat WHERE rooli = 'tyontekija'";
                    $stmt = $yhteys->query($query);

                    // Tulostetaan huoltohenkilöiden tiedot
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li>" . $row['etunimi'] . " " . $row['sukunimi'] . " - " . $row['puhelin'] . "</li>";
                    }
                ?>
                </ul>
            </div>
        </div>

    </div>
</div>

<img src="img/kartta.png" class="w3-image w3-greyscale-min" style="width:100%">

<?php require "includes/footer.php"; ?>
