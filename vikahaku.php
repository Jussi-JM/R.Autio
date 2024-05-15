<?php
require('config.php');

if (!isset($_SESSION['sposti'])) {
    exit;
}

$sposti = $_SESSION['userID'];

if (!isset($_SESSION['tyontekijaID']) && isset($_SESSION['userID'])) {
    $kayttaja = $_SESSION['userID'];
    $haku = "SELECT tyontekijat.tyontekijaID FROM tyontekijat WHERE tyontekijat.kayttajaID = :kayttajaID";
    $haku = $yhteys->prepare($haku);
    $haku->execute(array(':kayttajaID' => $kayttaja));
    $tulos = $haku->fetch(PDO::FETCH_ASSOC);

    if ($tulos) {
        $_SESSION['tyontekijaID'] = $tulos['tyontekijaID'];
    } else {
        header("Location: index.php");
        exit;
    }
}

function suoritetaan($vikaID) {
    return isset($_POST['suoritetaan' . $vikaID]);
}

function kommentti($vikaID) {
    return isset($_POST['tyontekijan_kommentti' . $vikaID]) ? $_POST['tyontekijan_kommentti' . $vikaID] : '';
}

function tyontekijantila($tyontekijaID, $yhteys) {
    $haku = "UPDATE tyontekijat SET tila = 'varattu' WHERE tyontekijaID = :tyontekijaID";
    $data = $yhteys->prepare($haku);
    $data->execute(array(':tyontekijaID' => $tyontekijaID));
}

function tyontekijaID($vikaID, $tyontekijaID, $valmistumisaika, $kommentti, $yhteys) {
    $haku = "UPDATE vikailmotukset SET tyontekijaID = :tyontekijaID, suoritetaan = :suoritetaan, tyontekijan_kommentti = :tyontekijan_kommentti WHERE vikaID = :vikaID";
    $data = $yhteys->prepare($haku);
    $data->execute(array(':tyontekijaID' => $tyontekijaID, ':suoritetaan' => $valmistumisaika, ':tyontekijan_kommentti' => $kommentti, ':vikaID' => $vikaID));
}

function status($vikaID, $yhteys) {
    $haku = "UPDATE vikailmotukset SET status = 'tyon alla' WHERE vikaID = :vikaID";
    $data = $yhteys->prepare($haku);
    $data->execute(array(':vikaID' => $vikaID));
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['valitsesuoritettavaksi'])) {
    $vikaID = $_POST['vikaID'];
    $kayttajaID = $_SESSION['userID'];
    $haku = "SELECT tyontekijat.tyontekijaID FROM tyontekijat WHERE tyontekijat.kayttajaID = :kayttajaID";
    $haku = $yhteys->prepare($haku);
    $haku->execute(array(':kayttajaID' => $kayttajaID));
    $tulos = $haku->fetch(PDO::FETCH_ASSOC);
    
    $valmistumisaika = suoritetaan($vikaID) ? $_POST['suoritetaan' . $vikaID] : '';
    $kommentti = kommentti($vikaID);

    tyontekijantila($tulos['tyontekijaID'], $yhteys);

    status($vikaID, $yhteys);
    tyontekijaID($vikaID, $tulos['tyontekijaID'], $valmistumisaika, $kommentti, $yhteys);

    header("Location: tyontekijanakymat.php"); 
    exit;
}

$haku = "SELECT vikailmotukset.vikaID, vikailmotukset.luotu, vikailmotukset.lisatiedot, vikailmotukset.status, vikailmotukset.prioriteetti,
            vikailmotukset.toimenpide, vikailmotukset.asunnotID, kayttajat.puhelin, kayttajat.katuosoite, kayttajat.postinumero, kayttajat.paikkakunta,
            kayttajat.etunimi AS asiakkaan_etunimi, kayttajat.sukunimi AS asiakkaan_sukunimi, 
            tyontekijat.etunimi AS tyontekijan_etunimi, tyontekijat.sukunimi AS tyontekijan_sukunimi, tyontekijat.tyontekijaID
            FROM vikailmotukset
            INNER JOIN kayttajat ON kayttajat.kayttajaID = vikailmotukset.kayttajaID
            LEFT JOIN tyontekijat ON tyontekijat.tyontekijaID = vikailmotukset.tyontekijaID";
$data = $yhteys->query($haku);
?>