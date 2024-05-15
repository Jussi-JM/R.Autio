<?php require "includes/header.php"; ?>
<?php 
if (isset($_SESSION['viesti'])) {
    echo "<script type='text/javascript'>alert('" . $_SESSION['viesti'] . "');</script>";
    unset($_SESSION['viesti']);
}
?>
<?php require "config.php";?>

<?php 
if (!isset($_SESSION['sposti'])) {
    header('location: index.php');
}
    $email = $_SESSION['sposti'];
    $haeTili = $yhteys->prepare("SELECT * FROM kayttajat WHERE sposti = :sposti");
    $haeTili->execute([':sposti' => $email]);
    $rivi = $haeTili->fetch(PDO::FETCH_ASSOC);
    $lomakeOk = true; // Muuttuja, joka määrittää, pitäisikö lomake lähettää vai ei

    if(isset($_POST['submit'])){     //tarkistetaan onko submit -nappia painettu
        if($_POST['etunimi']== '' OR $_POST['sukunimi']== '' OR $_POST['katuosoite']== '' OR $_POST['postinumero']== '' OR $_POST['paikkakunta']== '' OR $_POST['email']== '' OR  $_POST['puhelin']== ''){
            echo "<script type='text/javascript'>alert('Tietoja puuttuu!');</script>";
            $lomakeOk = false; // Älä lähetä lomaketta, jos kaikki tiedot eivät ole täytetty
        }
        if($_POST['email'] != $email){
            //Tarkista onko email jo olemassa
                $tarkistaEmail = $yhteys->prepare("SELECT * FROM kayttajat WHERE sposti = :sposti");
                $tarkistaEmail->execute([':sposti' => $_POST['email']]);

                if ($tarkistaEmail->rowCount() > 0) {
                echo "<script type='text/javascript'>alert('Antamallasi sähköpostiosoitteella on jo luotu käyttäjätili!');</script>";    
                $lomakeOk = false; // Älä lähetä lomaketta, jos sähköpostiosoite on jo olemassa
                }
            }
            if ($lomakeOk) {
                $params = [
                    ':etunimi' => $_POST['etunimi'],
                    ':sukunimi' => $_POST['sukunimi'],
                    ':katuosoite' => $_POST['katuosoite'],
                    ':postinumero' => $_POST['postinumero'],
                    ':paikkakunta' => $_POST['paikkakunta'],
                    ':puhelin' => $_POST['puhelin'],
                    ':sposti' => $_POST['email'],
                    ':vanhasposti' => $email
                ];
            
                $sql = "UPDATE kayttajat SET etunimi = :etunimi, sukunimi = :sukunimi, katuosoite =:katuosoite, postinumero =:postinumero, paikkakunta =:paikkakunta, puhelin =:puhelin, sposti =:sposti";

                if (!empty($_POST['password']) && $_POST['password'] == $_POST['confirmPassword']) {
                    $sql .= ", salasana =:salasana";
                    $params[':salasana'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                }
            
                $sql .= " WHERE sposti = :vanhasposti";
                $_SESSION['sposti'] =  $_POST['email'];
                $lisaa = $yhteys->prepare($sql);
                if ($lisaa->execute($params)) {
                    header('location: tilimuokkaus.php');
                }
            }
    }
       
?>

<main class="form-signin w-50 m-auto">
    <form method="post">
        <div class="row mb-4 mt-5">
        <div class="col">
            <div data-mdb-input-init class="form-outline">
            <input name="etunimi" type="text" id="etunimi" class="form-control" value="<?php if(isset($rivi)) echo $rivi['etunimi'];?>" required />
            <label class="form-label" for="firstname">Etunimi</label>
            </div>
        </div>
        <div class="col">
            <div data-mdb-input-init class="form-outline">
            <input name="sukunimi" type="text" id="sukunimi" class="form-control" value="<?php if(isset($rivi)) echo $rivi['sukunimi'];?>" required />
            <label class="form-label" for="lastname">Sukunimi</label>
            </div>
        </div>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
        <input name="katuosoite" type="text" id="katuosoite" class="form-control" value="<?php if(isset($rivi)) echo $rivi['katuosoite'];?>" required />
        <label class="form-label" for="address">Katuosoite</label>
        </div>

        <div class="row mb-4">
        <div class="col-4">
            <div data-mdb-input-init class="form-outline">
            <input name="postinumero" type="zip" id="postinumero" class="form-control" value="<?php if(isset($rivi)) echo $rivi['postinumero'];?>" required />
            <label class="form-label" for="zip">Postinumero</label>
            </div>
        </div>
        <div class="col-8">
            <div data-mdb-input-init class="form-outline">
            <input name="paikkakunta" type="text" id="paikkakunta" class="form-control" value="<?php if(isset($rivi)) echo $rivi['paikkakunta'];?>" required />
            <label class="form-label" for="city">Postitoimipaikka</label>
            </div>
        </div>
        
        <div data-mdb-input-init class="form-outline mb-4">
        <input name="puhelin" type="tel" id="puhelin" class="form-control" value="<?php if(isset($rivi)) echo $rivi['puhelin'];?>" required />
        <label class="form-label" for="phone">Puhelinnumero</label>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
        <input name="email" type="email" class="form-control" id="email" value="<?php if(isset($rivi)) echo $rivi['sposti'];?>" required />
        <label class="form-label" for="email">Sähköpostiosoite</label>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
        <input name="password" type="password" id="password" class="form-control"></input>
        <label class="form-label" for="password">Uusi salasana (pituus vähintään 8 merkkiä)</label>
        </div>
        <div data-mdb-input-init class="form-outline mb-4">
        <input name="confirmPassword" type="password" id="confirmPassword" class="form-control" ></input>
        <label class="form-label" for="confirmPassword">Vahvista salasana</label>
        </div>
        <button onclick="muokkaus()" name="submit" class="btn login" type="submit">Tallenna muutokset</button>
    </form>

</main>

<?php require "includes/footer.php"; ?>
