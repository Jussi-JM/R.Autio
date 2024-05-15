<?php require "config.php";?>
<?php require "includes/header.php"; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comments'])) {
        $nimi = $_POST['name'];
        $email = $_POST['email'];
        $viesti = $_POST['comments'];

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=r.autio;charset=utf8", $tunnus, $salasana);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO yhteydenotto (nimi, email, viesti, luotu) VALUES (?, ?, ?, NOW())";
            
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$nimi, $email, $viesti]);

            echo "<div class='text-center mt-5'><p class='h2'>Kiitos! Yhteydenottosi on vastaanotettu.</p></div>";

            $_POST['name'] = '';
            $_POST['email'] = '';
            $_POST['comments'] = '';

        } catch(PDOException $e) {
            echo "Tietokantaan tallentaminen epäonnistui: " . $e->getMessage();
        }
    } else {
        echo "Kaikki lomakkeen tiedot ovat pakollisia.";
    }
} else {
    header("Location: index.php");
}
?>

<div class="text-center mt-5">
    <a href="index.php" class="btn btn-outline-secondary btn-lg">Palaa etusivulle</a>
</div>
<?php require "includes/footer.php"; ?>