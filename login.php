<?php 
require "config.php"; 
require "includes/header.php";
require "kirjautuminen.php";
?>

<div class="container-fluid text-center bg-light">
<main class="form-signin w-50 m-auto">
    <form method="post" action="">
        <h1 class="h3 mt-5 mb-3 fw-normal text-center">Kirjaudu sisään</h1>
        <?php if ($error) echo htmlspecialchars($error); ?>
        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Sähköpostiosoite</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Salasana</label>
        </div>
        <button class="w-100 btn btn-lg login" type="submit" name="submit">Kirjaudu</button>
        <h6 class="mt-3">Jos sinulla ei ole käyttäjätunnusta <a href="register.php">Luo tunnus</a></h6>
    </form>
</main>
</div>
<?php require "includes/footer.php"; ?>