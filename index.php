<?php require "includes/header.php"; ?>

<div class="jumbotron text-center bg-light">
  <h1>R.AUTIO OY</h1> 
  <p>KIINTEISTÖHUOLTO</p> 
</div>

<div class="container marketing">
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-7">
      <h2>Tietoa yrityksestämme</h2><br>
      <h4>Tervetuloa R.Aution sivustolle, kiinteistöhuoltoyrityksen, joka on omistautunut tarjoamaan ensiluokkaista palvelua. Autamme ylläpitämään ja parantamaan kiinteistöjen arvoa, sekä lisäämään niiden elinikää.</h4><br>
      <p>R.Autio on perustettu tarjoamaan laadukkaita kiinteistöhuoltopalveluita. Ymmärrämme, että kiinteistöjen kunnossapito on tärkeää niiden arvon säilyttämiseksi ja parantamiseksi. Siksi tarjoamme kattavan valikoiman palveluita kaikille kiinteistöhuollon osa-alueille. Olipa kyseessä sitten pieni asuinrakennus tai suuri taloyhtiö, meillä on tietotaito ja kokemus hoitaa kaikki kiinteistöhuollon tehtävät tehokkaasti ja ammattitaitoisesti, yksilölliset tarpeet huomioiden. R.Aution tiimi koostuu kokeneista ammattilaisista, jotka ovat omistautuneita tarjoamaan erinomaista palvelua. Käytämme uusinta teknologiaa ja parhaita käytäntöjä varmistaaksemme, että kiinteistösi on hyvin hoidettu ja turvallinen.<br><br>Valitsemalla R.Aution kiinteistöhuoltopalvelut voit luottaa siihen, että kiinteistösi on hyvissä käsissä.</p>
    </div>
    <div class="col-5 yritysimg">
      <span><img src="img/logo350.png" alt="logo"></span>
    </div>
  </div>
</div>

<div id="services" class="container-fluid text-center bg-light">
  <h2>PALVELUT</h2>
  <h4>Mitä tarjoamme</h4>
  <br>
  <div class="row">
    <div class="col">
      <span class="fas fa-power-off fa-3x logo-small"></span>
      <h4>TEHOKKUUS</h4>
      <p>R.Autio on tunnettu tehokkuudestaan. Käytämme uusinta teknologiaa ja työkaluja, joiden avulla hoidamme kaikki kiinteistöhuollon tehtävät nopeasti ja tehokkaasti. </p>
    </div>
    <div class="col">
      <span class="fas fa-wrench fa-3x logo-small"></span>
      <h4>TYÖTELIÄISYYS</h4>
      <p>Ymmärrämme, että kiinteistöjen kunnossapito vaatii jatkuvaa huomiota ja ponnisteluja. Tiimimme on valmis tekemään tarvittavan työn varmistaakseen, että kiinteistösi pysyy parhaassa mahdollisessa kunnossa.</p>
    </div>
    <div class="col">
      <span class="fas fa-lock fa-3x logo-small"></span>
      <h4>MÄÄRÄTIETOISUUS</h4>
      <p>Olemme sitoutuneet saavuttamaan tavoitteemme ja täyttämään asiakkaidemme odotukset. Teemme kaikkemme laadukkaan työtuloksen saavuttamiseksi. </p>
    </div>
  </div>
</div>

<div id="portfolio" class="container-fluid text-center">
  <h2>Referenssejä</h2><br>
  <h4>Huoltokohteitamme ovat muun muassa</h4>
  <div class="row">
    <div class="col">
      <div class="card">
        <img src="img/referenssi1.png" alt="Paris" class="card-img-top">
        <div class="card-body">
          <p><strong>As Oy Taloyhtiö 1</strong></p>
          <p>Olemme vastanneet As Oy Taloyhtiö yhden huoltotöistä jo 10 vuotta</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <img src="img/referenssi2.png" alt="New York" class="card-img-top">
        <div class="card-body">
          <p><strong>As Oy Taloyhtiö 2</strong></p>
          <p>Yhteistyömme Taloyhtiö 2:n kanssa on ollut useiden vuosien ajan saumatonta</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <img src="img/referenssi4.png" alt="San Francisco" class="card-img-top">
        <div class="card-body">
          <p><strong>As Oy Taloyhtiö 3</strong></p>
          <p>Olemme tehneet Taloyhtiö 3:n huoltotöitä sen valmistumisesta lähtien</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="contact" class="container-fluid bg-light">
    <div class="text-center">
        <h2>Yhteydenotto</h2>
    </div>
    <div class="row">
        <div class="col-md-5">
            <p>Aukioloajat: MA-PE 8.00 - 17.00</p>
            <p><span class="fas fa-map-marker-alt"></span> Tornio, FI</p>
            <p><span class="fas fa-phone"></span> +1234567</p>
            <p>Päivystysnumero: </p>
            <p><span class="fas fa-phone"></span> +01234567</p>
            <p><span class="fas fa-envelope"></span> toimisto@r.autio.com</p>
        </div>

        <div class="col-md-7">
            <form action="yhteydenotto.php" method="post">
                <div class="row">
                    <div class="col form-group">
                        <input class="form-control" id="name" name="name" placeholder="Nimi" type="text" required>
                    </div>
                    <div class="col form-group">
                        <input class="form-control" id="email" name="email" placeholder="Sähköpostiosoite" type="email" required>
                    </div>
                </div>
                <textarea class="form-control" id="comments" name="comments" placeholder="Viesti" rows="5"></textarea><br>
                <div class="row">
                    <div class="col form-group">
                        <button class="btn btn-outline-secondary pull-right" type="submit">Lähetä</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<img src="img/kartta.png" class="w3-image w3-greyscale-min" style="width:100%">
<?php require "includes/footer.php"; ?>

<script>
$(document).ready(function(){
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
