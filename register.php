<?php require "config.php";?>
<?php require "includes/header.php"; ?>

<?php 
  if(isset($_SESSION['sposti'])){
    header('location: index.php');
    exit;
  }
?>

<?php 
$lomakeOk = true;

if(isset($_POST['submit'])){ 
  if($_POST['firstname']== '' OR $_POST['lastname']== '' OR $_POST['address']== '' OR $_POST['zip']== '' OR $_POST['city']== '' OR $_POST['email']== '' OR  $_POST['phone']== '' OR $_POST ['password'] == '' OR $_POST['confirmPassword']== ''){
    echo "<script type='text/javascript'>alert('Tietoja puuttuu!');</script>";
    $lomakeOk = false; 
  }else{
    $etunimi = $_POST['firstname'];
    $sukunimi = $_POST['lastname'];
    $katuosoite = $_POST['address'];
    $huoneisto = isset($_POST['apartment']) ? $_POST['apartment'] : '';
    $katuosoiteJaHuoneisto = $katuosoite . ' ' . $huoneisto;
    $postinumero = $_POST['zip'];
    $paikkakunta = $_POST['city'];
    $puhelin = $_POST['phone'];
    $user = $_POST['email'];
    $salasana = $_POST['password'];
    $taloyhtio = $_POST['taloyhtio']; 

    $tarkistaEmail = $yhteys->prepare("SELECT * FROM kayttajat WHERE sposti = :sposti");
    $tarkistaEmail->execute([':sposti' => $user]);

    if ($tarkistaEmail->rowCount() > 0) {
      echo "<script type='text/javascript'>alert('Antamallasi sähköpostiosoitteella on jo luotu käyttäjätili!');</script>";    
      $lomakeOk = false; 
    } 


    if ($lomakeOk) {
  if ($lomakeOk) {
    $user_role = 'asukas';
    $lisaa = $yhteys->prepare("INSERT INTO kayttajat (etunimi, sukunimi, katuosoite, postinumero, paikkakunta, puhelin, sposti, salasana, rooli) VALUES (:etunimi, :sukunimi, :katuosoite, :postinumero, :paikkakunta, :puhelin, :sposti, :salasana, :rooli)");            
    $lisaa->execute([
      ':etunimi' => $etunimi,
      ':sukunimi' => $sukunimi,
      ':katuosoite' => $katuosoiteJaHuoneisto, 
      ':postinumero' => $postinumero,
      ':paikkakunta' => $paikkakunta,
      ':puhelin' => $puhelin,
      ':sposti' => $user,
      ':salasana' => password_hash($salasana, PASSWORD_DEFAULT),
      ':rooli' => $user_role,
    ]);
      
      $_SESSION['kayttajaID'] = $yhteys->lastInsertId();
  
      $_SESSION['user_role'] = $user_role; 
      $_SESSION['sposti'] = $user;
      $_SESSION['userID'] = $_SESSION['kayttajaID'];

      switch ($user_role) {
        case 'asukas':
            header('Location: asukas.php');
            break;

      $tarkistaTaloyhtio = $yhteys->prepare("SELECT * FROM taloyhtiot WHERE nimi = :nimi");
      $tarkistaTaloyhtio->execute([':nimi' => $taloyhtio]);
      if ($tarkistaTaloyhtio->rowCount() < 1) {
        $lisaa = $yhteys->prepare("INSERT INTO taloyhtiot (katuosoite, postinumero, paikkakunta, nimi) VALUES (:katuosoite, :postinumero, :paikkakunta, :nimi)");
        $lisaa->execute([
          ':katuosoite' => $katuosoite, 
          ':postinumero' => $postinumero,
          ':paikkakunta' => $paikkakunta,
          ':nimi' => $taloyhtio
        ]);
      }
    }
      
      header('Location: asukas.php');
    }    
  }  
  }
}
?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php" onsubmit="return palauta()">
   
    <h1 class="h3 mt-5 fw-normal text-center">Luo tunnukset</h1><br>

  <!-- lomake -->
  <div class="row mb-4">
    <div class="col">
      <div data-mdb-input-init class="form-outline">
        <input name="firstname" type="text" id="firstname" class="form-control" required />
        <label class="form-label" for="firstname">Etunimi</label>
      </div>
    </div>
    <div class="col">
      <div data-mdb-input-init class="form-outline">
        <input name="lastname" type="text" id="lastname" class="form-control" required />
        <label class="form-label" for="lastname">Sukunimi</label>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-8">
      <div data-mdb-input-init class="form-outline mb-4">
        <input name="address" type="text" id="address" class="form-control" required />
        <label class="form-label" for="address">Katuosoite</label>
      </div>
    </div>
    <div class="col-4">
      <div data-mdb-input-init class="form-outline">
        <input name="apartment" type="text" id="apartment" class="form-control" />
        <label class="form-label" for="apartment">Huoneisto</label>
      </div>
    </div>
  </div>
  
  <div class="row mb-4">
    <div class="col-4">
      <div data-mdb-input-init class="form-outline">
        <input name="zip" type="zip" id="zip" class="form-control" required />
        <label class="form-label" for="zip">Postinumero</label>
      </div>
    </div>
    <div class="col-8">
      <div data-mdb-input-init class="form-outline">
        <input name="city" type="text" id="city" class="form-control" required />
        <label class="form-label" for="city">Postitoimipaikka</label>
      </div>
    </div>
  </div>
  
  <div data-mdb-input-init class="form-outline mb-4">
    <input name="taloyhtio" type="text" id="taloyhtio" class="form-control"/>
    <label class="form-label" for="company">Taloyhtiön nimi</label>
  </div>
  
  <div data-mdb-input-init class="form-outline mb-4">
    <input name="phone" type="tel" id="phone" class="form-control" required />
    <label class="form-label" for="phone">Puhelinnumero</label>
  </div>

  <div data-mdb-input-init class="form-outline mb-4">
    <input name="email" type="email" id="email" class="form-control" required />
    <label class="form-label" for="email">Sähköpostiosoite</label>
  </div>

  <div data-mdb-input-init class="form-outline mb-4">
    <input name="password" type="password" id="password" class="form-control" required />
    <label class="form-label" for="password">Salasana (pituus vähintään 8 merkkiä)</label>
  </div>
    <div data-mdb-input-init class="form-outline mb-4">
    <input name="confirmPassword" type="password" id="confirmPassword" class="form-control" required />
    <label class="form-label" for="confirmPassword">Vahvista salasana</label>
  </div>

  <!-- Checkbox -->
  <div class="form-check d-flex justify-content-center mb-4">
    <input 
      class="form-check-input me-2"
      type="checkbox"
      required 
      id="conditions"
      checked
      />
    <label class="form-check-label" for="conditions"> Hyväksyn käyttöehdot </label>
  </div>

  <!-- Submit -painike -->
    <button onclick="tarkista()" name="submit" class="w-100 btn btn-lg login" type="submit">Rekisteröidy</button>
    <h6 class="mt-3">Jos sinulla on jo käyttäjätunnus  <a href="login.php">Kirjaudu sisään</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
