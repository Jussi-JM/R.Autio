<?php 
require "config.php"; 
require "includes/header.php"; 

// Ohjataan käyttäjä kirjautumissivulle, jos hän ei ole kirjautunut sisään tai ei ole toimistohenkilöstöä
if (!isset($_SESSION['sposti']) || $_SESSION['user_role'] !== 'toimisto') {
    header('Location: login.php');
    exit;
}

echo "<h1>Tervetuloa, " . $_SESSION['user_role'] . "</h1>";
echo "<p>Toimistohenkilöstön hallintapaneeli ja toiminnot.</p>";

// Esimerkki mahdollisista toiminnoista

require "includes/footer.php"; 
?>

