<?php

$palvelin   = "localhost";
$tietokanta = "r.autio";
$tunnus     = "testiuser";
$salasana   = "salasana12";

$yhteys = new PDO("mysql:host=$palvelin;dbname=$tietokanta;charset=utf8","$tunnus","$salasana");
if($yhteys == true){
    //echo "Toimii hyvin";
}else{
    echo "Ei toimi";
}
?>
