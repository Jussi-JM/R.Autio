<?php
//toimistolle vain
require "includes/header.php";
if (!isset($_SESSION['kayttajaID'])) {
}

if (!isset($_SESSION['sposti']) || $_SESSION['user_role'] !== 'toimisto') {
    header('location: login.php');
    exit;
}

?>


<div id="contact" class="container-fluid bg-light">
    <h2 class="text-center">Vapaat työntekijät</h2>
    <div class="row">
        <div class="col">
            <div class="col">
                <div class="row">
                    <div class="table-responsive">
                        <form method="post" action="" onsubmit="return varmistus()">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Työntekijä ID</th>
                                        <th scope="col">Etunimi</th>
                                        <th scope="col">Sukunimi</th>
                                        <th scope="col">Rooli</th>
                                        <th scope="col">Valitse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('config.php');
                                    include('vapaattekijat.php');

                                    if ($tyontekijatdata->rowCount() > 0) {
                                        while ($rivi = $tyontekijatdata->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $rivi["tyontekijaID"]; ?></td>
                                                <td><?php echo $rivi["etunimi"]; ?></td>
                                                <td><?php echo $rivi["sukunimi"]; ?></td>
                                                <td><?php echo ($rivi["rooli"] === 'toimisto') ? 'toimisto/työnjohto' : 'työntekijä'; ?></td>
                                                <td><input type="radio" name="valitsetekija" value="<?php echo $rivi['tyontekijaID']; ?>"></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>Dataa ei löytynyt!</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-light">
    <h2 class="text-center">Avoimet vikailmoitukset</h2>
    <div class="row">
        <div class="col">
            <div class="col">
                <div class="row">
                    <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Luotu</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Prioriteetti</th>
                                        <th scope="col">Toimenpide</th>
                                        <th scope="col">Osoite</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col">Ilmoittajan yhteystiedot</th>
                                        <th scope="col">Lisätiedot</th>
                                        <th scope="col">Valitse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('config.php');
                                    include('vapaattekijat.php');

                                    if ($vikailmotuksetdata->rowCount() > 0) {
                                        while ($rivi = $vikailmotuksetdata->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $rivi["luotu"]; ?></td>
                                                <td><?php echo $rivi["status"] === 'avoin' ? 'Avoin' : 'Työn alla'; ?></td>
                                                <td><?php echo $rivi["prioriteetti"]; ?></td>
                                                <td><?php echo $rivi["toimenpide"]; ?></td>
                                                <td><?php echo $rivi["katuosoite"].', '.$rivi["postinumero"].', '.$rivi["paikkakunta"]; ?></td>
                                                <td><?php echo $rivi["asunnotID"]; ?></td>
                                                <td><?php echo $rivi["asiakkaan_etunimi"].' '.$rivi["asiakkaan_sukunimi"].' '.$rivi["puhelin"]; ?></td>
                                                <td><?php echo $rivi["lisatiedot"]; ?></td>
                                                <td><input type="radio" name="valitsehomma" value="<?php echo $rivi['vikaID']; ?>"></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Dataa ei löytynyt!</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" name="vahvista">Vahvista valinnat</button>
                            <button type="button" class="btn btn-danger" onclick="resetointi()">Poista valinnat</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 900px) {
    .table-striped tbody tr td {
        display: block;
        width: 100%;
    }
    .thead-dark th {
        display: none;
    }
}
</style>

<?php require "includes/footer.php"; ?>
