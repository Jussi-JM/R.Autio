<footer class="container-fluid text-center">
    <a href="" title="To Top">
        <span class="fa fa-chevron-up logo-small"></span>
    </a>
    <p>Kiinteistöhuolto R.Autio Oy, 1234567-8</p>
</footer>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var form = document.querySelector('form');
      if (form) {
          form.addEventListener('submit', function(event) {
              var form = event.target;
              var isValid = true;
              var element = document.getElementById('kehys');

              // Tarkista kaikki vaaditut kentät
              var requiredFields = form.querySelectorAll('input[required]');
              requiredFields.forEach(function(field) {
                  if (!field.value) {
                      isValid = false;
                      field.classList.add('is-invalid'); // Lisää Bootstrapin 'is-invalid' -luokka näyttääksesi virheen
                      field.classList.remove('is-valid'); // Poista 'is-valid' -luokka, jos kenttä ei ole täytetty
                      console.log(field.name + ' on invalidi'); // Tulosta konsoliin
                  } else {
                      field.classList.remove('is-invalid'); // Poista 'is-invalid' -luokka, jos kenttä on täytetty
                      field.classList.add('is-valid'); // Lisää Bootstrapin 'is-valid' -luokka näyttääksesi, että kenttä on täytetty oikein
                      console.log(field.name + ' on validi'); // Tulosta konsoliin
                  }
              });

              // Jos lomake ei ole validi, estä sen lähettäminen
              if (!isValid) {
                  event.preventDefault();
              }
          });
      }
  });

</script>
<script src="js/kurssitehtava.js"></script>
</body>
