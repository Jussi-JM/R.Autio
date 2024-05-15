<?php 
require "config.php"; 

if (isset($_SESSION['sposti'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if (isset($_POST['submit'])) {
    $sposti = trim($_POST['email']);
    $salasana = trim($_POST['password']);


    if (empty($sposti) || empty($salasana)) {
        $error = 'Tunnukset unohtuivat!';
    } else {
        $stmt = $yhteys->prepare("SELECT kayttajaID, sposti, salasana, rooli FROM kayttajat WHERE sposti = :sposti");
        $stmt->execute(['sposti' => $sposti]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $stmt->rowCount() > 0) {
            if (password_verify($salasana, $user['salasana'])) {
                $_SESSION['sposti'] = $user['sposti'];
                $_SESSION['userID'] = $user['kayttajaID'];
                $_SESSION['user_role'] = $user['rooli'];

                switch ($user['rooli']) {
                    case 'asukas':
                        header('Location: asukas.php');
                        break;
                    case 'isannoitsija':
                    case 'tyontekija':
                    case 'toimisto':
                        header('Location: tyontekijanakymat.php');
                        break;
                    default:
                        echo "Unhandled role: {$user['rooli']}"; 
                        exit;
                }
                exit();
            } else {
                $error = 'Virheellinen salasana!';
            }
        } else {
            $error = 'Käyttäjää ei löytynyt!';
        }
    }
}
?>