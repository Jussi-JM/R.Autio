<?php require "config.php";?>
<?php require "includes/header.php"; ?>

<div class="container">
    <!-- Johdanto -->
    <div id="references" class="container-fluid mt-5">
    <div class="row">
            <h1 class="h3 fw-normal text-center">REFERENSSIT</h1><br>
            <h4 class="mt-4 fw-normal text-center"> Tervetuloa referenssisivullemme! Olemme alan johtava toimija, joka on erikoistunut tarjoamaan korkealaatuisia kiinteistöhuoltopalveluita. Ylpeänä esittelemme tässä osiossa valikoiman menestyksekkäitä projektejamme, jotka kuvastavat sitoutumistamme erinomaiseen palveluun ja asiakastyytyväisyyteen. Olipa kyseessä sitten asuinrakennusten ylläpito, toimistorakennusten huolto tai teollisuuskiinteistöjen kunnossapito, olemme aina valmiita vastaamaan haasteeseen.</h4>
        </div>
    </div>

    <!-- Kohteiden haku paikkakunnan mukaan -->
    <div id="#" class="container-fluid bg-light mt-5 ">
        <div class="row">
          <form method="POST">
            <h5 class="col h3 fw-normal mt-3">Etsi huoltokohteitamme paikkakunnan perusteella: </h5><br>
            <input name="paikkakunta" type="text" id="paikkakunta" placeholder="Kirjoita paikkakunta tähän" class="form-control mt-5"/>

            <div class="col form-group  mt-3">
                <button name="submit" class="btn btn-outline-secondary pull-right" type="submit">Hae</button>
            </div>
        </div>
</form>
        <div class="row">
        <table class="table table-striped mt-5">
            <tr>
                <th>ASIAKAS</th>
                <th>PAIKKAKUNTA </th>
            </tr>

          <?php

            $stmt = $yhteys->prepare("SELECT taloyhtioID, nimi, paikkakunta FROM taloyhtiot WHERE paikkakunta LIKE :paikkakunta");
            if(isset($_POST['submit']) && !empty($_POST['paikkakunta'])){     //tarkistetaan onko submit -nappia painettu ja onko paikkakunta-kenttä tyhjä
              $paikkakunta = $_POST['paikkakunta']; 
              $stmt->execute(['paikkakunta' => $paikkakunta]);
            } else {
              $stmt->execute(['paikkakunta' => '%']); // Hakee kaikki taloyhtiöt, jos hakukenttä on tyhjä
            }

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>            
                <td><?php echo $row['nimi']; ?></td>
                <td><?php echo $row['paikkakunta']; ?></td>
              </tr>
            <?php
          }

          ?>

       </table>
    </div>
  </div>

</div>

<?php require "includes/footer.php"; ?>