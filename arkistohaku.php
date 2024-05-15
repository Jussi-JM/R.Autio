<?php

    include('config.php');

    $haku = "SELECT arkisto.vikaID, arkisto.luotu,arkisto.lisatiedot, arkisto.status, arkisto.prioriteetti,
            arkisto.toimenpide, arkisto.asunnotID, kayttajat.etunimi, kayttajat.sukunimi, kayttajat.puhelin, kayttajat.katuosoite, kayttajat.postinumero, kayttajat.paikkakunta FROM arkisto
            INNER JOIN kayttajat ON kayttajat.kayttajaID = arkisto.kayttajaID";
    $arkistodata = $yhteys->query($haku);
?>