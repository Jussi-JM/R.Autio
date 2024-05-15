<?php 
require "config.php"; 
require "includes/header.php"; 

if (!isset($_SESSION['sposti']) || $_SESSION['user_role'] !== 'isannoitsija') {
    header('location: login.php');
    exit;
}

$notification = "";

if(isset($_POST['submit'])) {
    if(empty($_POST['details']) || empty($_POST['priority'])) {
        echo "Tietoja puuttuu!";
    } else {
        $details = $_POST['details'];
        $priority = $_POST['priority'];

        $kayttajaID = $_SESSION['userID'];
        $tyontekijaID = 1;
        $asunnotID = 1;
        $status = 'avoin';
        $suoritetaan = date('Y-m-d H:i:s');
        $toimenpide = 'Review pending';
        $tyontekijan_kommentti = '';

        $lisaa = $yhteys->prepare("INSERT INTO vikailmotukset (lisatiedot, prioriteetti, kayttajaID, asunnotID, toimenpide) VALUES (:lisatiedot, :prioriteetti, :kayttajaID, :asunnotID, :toimenpide)");
        $lisaa->execute([
            ':lisatiedot' => $details,
            ':prioriteetti' => $priority,
            ':kayttajaID' => $kayttajaID,
            ':asunnotID' => $asunnotID,
            ':toimenpide' => $toimenpide,
        ]);
        $notification = "Vikailmoitus lähetetty onnistuneesti.";
    }
}
?>

<div class="container marketing">
<div id="contact" class="container-fluid bg-light">

<main class="form-signin w-50 m-auto">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h1 class="h3 mt-5 fw-normal text-center">Lähetä vikailmoitus</h1><br>
    
    <div class="form-outline mb-3">
        <textarea name="details" class="form-control" id="details" placeholder="Kuvaile vikaa" required></textarea>
        <label class="form-label" for="details">Vian kuvaus</label>
    </div>
    
    <div class="form-outline mb-3">
        <select name="priority" class="form-control" id="priority" required>
            <option value="">Valitse prioriteetti</option>
            <option value="normaali">Normaali</option>
            <option value="kiireellinen">Kiireellinen</option>
            <option value="kriittinen">Kriittinen</option>
        </select>
        <label class="form-label" for="priority">Prioriteetti</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Lähetä</button>

  </form>

  <script>
    <?php if (!empty($notification)): ?>
      alert("<?php echo $notification; ?>");
    <?php endif; ?>
  </script>

</main>

</div>
</div>

<?php require "includes/footer.php"; ?>

