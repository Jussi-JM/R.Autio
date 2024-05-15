<?php 
require "config.php"; 
require "includes/header.php"; 

if (!isset($_SESSION['sposti']) || $_SESSION['user_role'] !== 'asukas') {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asukas Portaali</title>
    <link rel="stylesheet" href="includes/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="jumbotron text-center">
    <h1>R.AUTIO OY</h1>
    <p>KIINTEISTÖHUOLTO</p>
</div>

<div class="container text-center">
    <h2>Tervetuloa Asukas!</h2>
    <p>Olemme iloisia, että käytät palveluamme. Tämä portaali tarjoaa sinulle mahdollisuuden hallinnoida asumiseen liittyviä asioita helposti ja kätevästi.</p>
    <p>Voit tehdä vikailmoituksia suoraan tästä järjestelmästä. Klikkaa yläpalkissa olevaa "Vikailmoitus" -nappia tehdäksesi uuden ilmoituksen.</p>
</div>

<?php require "includes/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>