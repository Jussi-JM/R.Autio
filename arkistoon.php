<?php
include('config.php'); 
$arkistoID = $_GET['vikaID'];

$haku = "SELECT * FROM vikailmotukset WHERE vikaID = :vikaID";
$kehote = $yhteys->prepare($haku);
$kehote->bindParam(':vikaID', $arkistoID);
$kehote->execute();
$vikailmoitus = $kehote->fetch(PDO::FETCH_ASSOC);

$paivitatila = "UPDATE tyontekijat SET tila = 'vapaa' WHERE tyontekijaID = :tyontekijaID";
$paivitakasky = $yhteys->prepare($paivitatila);
$paivitakasky->bindParam(':tyontekijaID', $vikailmoitus['tyontekijaID']);
$paivitakasky->execute();

$komento = "INSERT INTO arkisto (vikaID, kayttajaID, prioriteetti, lisatiedot, luotu, toimenpide, tyontekijaID, asunnotID, status, suoritetaan, tyontekijan_kommentti) 
                VALUES (:vikaID, :kayttajaID, :prioriteetti, :lisatiedot, :luotu, :toimenpide, :tyontekijaID, :asunnotID, :status, :suoritetaan, :tyontekijan_kommentti)";
$kehote = $yhteys->prepare($komento);

$kommentti = $vikailmoitus['tyontekijan_kommentti'] ?? '';
$toimenpide = $vikailmoitus['toimenpide'] ?? '';
$asunnot = isset($vikailmoitus['asunnotID']) ? $vikailmoitus['asunnotID'] : null;
$suoritetaan = $vikailmoitus['suoritetaan'] ?? '';

$kehote->bindParam(':vikaID', $vikailmoitus['vikaID']);
$kehote->bindParam(':kayttajaID', $vikailmoitus['kayttajaID']);
$kehote->bindParam(':prioriteetti', $vikailmoitus['prioriteetti']);
$kehote->bindParam(':lisatiedot', $vikailmoitus['lisatiedot']);
$kehote->bindParam(':luotu', $vikailmoitus['luotu']);
$kehote->bindParam(':toimenpide', $toimenpide);
$kehote->bindParam(':tyontekijaID', $vikailmoitus['tyontekijaID']);
$kehote->bindParam(':asunnotID', $asunnot, PDO::PARAM_NULL);
$kehote->bindParam(':status', $vikailmoitus['status']);
$kehote->bindParam(':suoritetaan', $suoritetaan);
$kehote->bindParam(':tyontekijan_kommentti', $kommentti);
$arkistoon = $kehote->execute();

if ($arkistoon) {
    $arkistohaku = "SELECT COUNT(*) AS count FROM arkisto WHERE vikaID = :vikaID";
    $arkistokomento = $yhteys->prepare($arkistohaku);
    $arkistokomento->bindParam(':vikaID', $arkistoID);
    $arkistokomento->execute();
    $arkistossa = $arkistokomento->fetch(PDO::FETCH_ASSOC);

    if ($arkistossa['count'] > 0) {
        $poista = "DELETE FROM vikailmotukset WHERE vikaID = :vikaID";
        $kehote_poista = $yhteys->prepare($poista);
        $kehote_poista->bindParam(':vikaID', $arkistoID);
        $kehote_poista->execute();

        
        header('Location: tyontekijanakymat.php');
    } else {
        echo "Tietoja ei ole arkistossa.";
    }
} else {
    echo "Arkistoon siirto epäonnistui.";
}
?>