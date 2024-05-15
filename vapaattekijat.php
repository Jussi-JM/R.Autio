<?php
include('config.php');


$tyontekijathaku = "SELECT * FROM tyontekijat 
                    INNER JOIN kayttajat ON tyontekijat.kayttajaID = kayttajat.kayttajaID 
                    WHERE tyontekijat.tila = 'vapaa' 
                    AND kayttajat.rooli";
$tyontekijatdata = $yhteys->query($tyontekijathaku); 

$vikailmotuksethaku = "SELECT vikailmotukset.vikaID, vikailmotukset.luotu, vikailmotukset.lisatiedot, vikailmotukset.status, vikailmotukset.prioriteetti,
            vikailmotukset.toimenpide, vikailmotukset.asunnotID, kayttajat.puhelin, kayttajat.katuosoite, kayttajat.postinumero, kayttajat.paikkakunta,
            kayttajat.etunimi AS asiakkaan_etunimi, kayttajat.sukunimi AS asiakkaan_sukunimi, 
            tyontekijat.etunimi AS tyontekijan_etunimi, tyontekijat.sukunimi AS tyontekijan_sukunimi
            FROM vikailmotukset
            INNER JOIN kayttajat ON kayttajat.kayttajaID = vikailmotukset.kayttajaID
            LEFT JOIN tyontekijat ON tyontekijat.tyontekijaID = vikailmotukset.tyontekijaID
            WHERE vikailmotukset.status != 'tyon alla'";
$vikailmotuksetdata = $yhteys->query($vikailmotuksethaku); 

if(isset($_POST['valitsehomma'])) {
    $valittuhomma = $_POST['valitsehomma'];
    $valittutekija = $_POST['valitsetekija'];


    $paivita = "UPDATE vikailmotukset SET tyontekijaID = :tyontekijaID WHERE vikaID = :vikaID";
    $kasky = $yhteys->prepare($paivita);
    $kasky->bindParam(':tyontekijaID', $valittutekija);
    $kasky->bindParam(':vikaID', $valittuhomma);
    $kasky->execute();

    $paivitatyontekija = "UPDATE tyontekijat SET tila = 'varattu' WHERE tyontekijaID = :tyontekijaID";
    $kasky = $yhteys->prepare($paivitatyontekija); 
    $kasky->bindParam(':tyontekijaID', $valittutekija);
    $kasky->execute();

    $paivitastatus = "UPDATE vikailmotukset SET status = 'tyon alla' WHERE vikaID = :vikaID";
    $kasky = $yhteys->prepare($paivitastatus);
    $kasky->bindParam(':vikaID', $valittuhomma);
    $kasky->execute();
}
?>