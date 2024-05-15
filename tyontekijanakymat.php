<?php 
//työntekijöille vain
require "includes/header.php";
if (!isset($_SESSION['sposti']) || ($_SESSION['user_role'] !== 'tyontekija' && $_SESSION['user_role'] !== 'toimisto')) {
    header('location: login.php');
    exit;
}
?>


<div id="contact" class="container-fluid bg-light">
    <h2 class="text-center">Vikailmoitukset</h2>
    <div class="row">
        <?php
        include('config.php');
        include('vikahaku.php');
        if ($data->rowCount() > 0) {
            while ($rivi = $data->fetch(PDO::FETCH_ASSOC)) {
                $vari = $rivi["tyontekijan_etunimi"] ? 'bg-success text-light' : '';?>

                <div id="kehys" class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card <?php echo $vari; ?>">
                        <div class="card-body">
                            <p class="card-text"><b>Luotu:</b> <?php echo $rivi["luotu"]; ?></p>
                            <p class="card-text"><b>Status:</b>  <?php echo $rivi["status"] === 'avoin' ? 'Avoin' : 'Työn alla'; ?></p>
                            <p class="card-text"><b>Työntekijä:</b>  <?php echo $rivi["tyontekijan_etunimi"] . ' ' . $rivi["tyontekijan_sukunimi"]; ?></p>
                            <p class="card-text"><b>Prioriteetti:</b>  <?php echo $rivi["prioriteetti"]; ?></p>
                            <p class="card-text"><b>Toimenpide:</b>  <?php echo $rivi["toimenpide"]; ?></p>
                            <p class="card-text"><b>Osoite:</b>  <?php 
                                $osoite = explode(' ', $rivi["katuosoite"]);
                                $asunto = end($osoite);
                                if (is_numeric($asunto)) {
                                    array_pop($osoite);
                                }
                                $osoite_str = implode(' ', $osoite) . ', ' . $rivi["postinumero"] . ', ' . $rivi["paikkakunta"]; 
                                echo $osoite_str; 
                            ?></p>
                            <p class="card-text"><b>Asunto:</b>  <?php 
                                echo $asunto; 
                            ?></p>
                            <p class="card-text"><b>Ilmoittajan yhteystiedot:</b>  <?php echo $rivi["asiakkaan_etunimi"] . ' ' . $rivi["asiakkaan_sukunimi"] . ' ' . $rivi["puhelin"]; ?></p>
                            <p class="card-text"><b>Lisätiedot:</b>  <?php echo $rivi["lisatiedot"]; ?></p>
                            <div class="form-group">
                                <label for="suoritetaan<?php echo $rivi['vikaID']; ?>"><b>Arvioitu valmistumisaika:</b></label>
                                <input type="datetime-local" class="form-control" id="suoritetaan<?php echo $rivi['vikaID']; ?>" name="suoritetaan<?php echo $rivi['vikaID']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tyontekijan_kommentti<?php echo $rivi['vikaID']; ?>"><b>Työntekijän kommentti:</b></label>
                                <textarea class="form-control" id="tyontekijan_kommentti<?php echo $rivi['vikaID']; ?>" name="tyontekijan_kommentti<?php echo $rivi['vikaID']; ?>" rows="10"></textarea>
                            </div>
                          <?php if (!$rivi['tyontekijaID']) { ?>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="hidden" name="vikaID" value="<?php echo $rivi['vikaID']; ?>">
                                <button type="submit" name="valitsesuoritettavaksi" class="btn btn-primary">Valitse suoritettavaksi</button>
                            </form>
                          <?php } ?>
                          <?php if ($rivi['tyontekijaID'] === $_SESSION['tyontekijaID']) { ?>
                              <a href="arkistoon.php?vikaID=<?php echo $rivi['vikaID']; ?>" class="btn btn-warning">Merkitse suoritetuksi</a>
                          <?php } ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='col'><p class='text-center'>Dataa ei löytynyt!</p></div>";
        }
        ?>
    </div>
</div>
<?php require "includes/footer.php"; ?>
