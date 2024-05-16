<?php require "includes/header.php"; 
//toimistolle

if (!isset($_SESSION['sposti']) || $_SESSION['user_role'] !== 'toimisto') {
  header('location: login.php');
  exit;
}

?>
<div id="contact" class="container-fluid bg-light">
  <h2 class="text-center">Suoritetut vikailmoitukset arkisto</h2>
  <div class="row">
    <?php
            
    include('config.php');
    include('arkistohaku.php');

    if ($arkistodata->rowCount() > 0) {
      while ($rivi = $arkistodata->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card">
        <div class="card-body">
          <p class="card-text"><b>Luotu:</b> <?php echo $rivi["luotu"]; ?></p>
          <p class="card-text"><b>Status:</b> <?php echo 'Valmis'; ?></p>
          <p class="card-text"><b>Prioriteetti:</b> <?php echo $rivi["prioriteetti"]; ?></p>
          <p class="card-text"><b>Toimenpide:</b> <?php echo $rivi["toimenpide"]; ?></p>
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
          <p class="card-text"><b>Ilmoittajan puhelinnumero:</b> <?php echo $rivi["etunimi"].' '.$rivi["sukunimi"].' '.$rivi["puhelin"]; ?></p>
          <p class="card-text"><b>Lisätiedot:</b> <?php echo $rivi["lisatiedot"]; ?></p>
        </div>
      </div>
    </div>
    <?php
      }
    } else {
      echo "<div class='col'><p class='text-center'>Dataa ei löytynyt.</p></div>";
    }
    ?>
  </div>
</div>

<?php require "includes/footer.php"; ?>