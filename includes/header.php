<?php 
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>R.Autio Oy | Kiinteistöhuolto</title>
        <link
            rel="icon"
            href="img/pikkulogo.png"
            type="image/x-icon"
        />

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/"> 

    <meta name="theme-color" content="#712cf9">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="includes/style.css">

  </head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <div class="d-flex justify-content-between w-100">
      <div>
        <a href="index.php"><img src="img/pikkulogo.png"></a>
      </div>
      <div class="collapse navbar-collapse justify-content-center" id="myNavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="index.php">ETUSIVULLE</a></li>
          <li class="nav-item"><a class="nav-link" href="yhteystiedot.php">YHTEYSTIEDOT</a></li>
          <li class="nav-item"><a class="nav-link" href="referenssit.php">REFERENSSIT</a></li> 
          <?php if(!isset($_SESSION['sposti'])):?>      
          <li class="nav-item"><a class="nav-link" href="login.php">KIRJAUTUMINEN</a></li>
          <?php else: ?>
            <li class="nav-item navbar-nav dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                KÄYTTÄJÄTILI
              </a>
              <ul class="nav-item dropdown-menu">

                <li class="nav-item"><a class= "nav-link dropdown-item logout" href="tilimuokkaus.php">MUOKKAA TIETOJA</a></li>
                <li class="nav-item"><a class= "nav-link dropdown-item logout" href="logout.php">KIRJAUDU ULOS</a></li>             
              </ul>
            </li>
            <?php if(isset($_SESSION['sposti']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'isannoitsija'): ?>
            <li class="nav-item">
            <a class="nav-link" href="isannoitsija.php">VIKAILMOITUS</a>
          </li>
          <?php endif; ?> 
          <?php if(isset($_SESSION['sposti']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'tyontekija'): ?>
            <li class="nav-item">
            <a class="nav-link" href="tyontekijanakymat.php">AVOIMET VIKAILMOITUKSET</a>
            </li>
          <?php endif; ?> 
          <?php if(isset($_SESSION['sposti']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'toimisto'): ?>
            <li class="nav-item">
            <a class="nav-link" href="vapaattekijatnakyma.php">TYÖNTEKIJÄT</a>
            </li>
          <?php endif; ?> 
          <?php if(isset($_SESSION['sposti']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'toimisto'): ?>
            <li class="nav-item">
            <a class="nav-link" href="arkisto.php">ARKISTO</a>
            </li>
          <?php endif; ?> 
          <?php if(isset($_SESSION['sposti']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'asukas'): ?>
            <li class="nav-item">
            <a class="nav-link" href="vikailmoitus.php">VIKAILMOITUS</a>
            </li>
          <?php endif; ?> 
          <?php endif; ?>      
        </ul>
      </div>
    </div>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#myNavbar" id="navbar-toggler-button">
      <span class="navbar-toggler-icon"></span>                     
    </button>
  </div>
</nav>
</body>
</html>