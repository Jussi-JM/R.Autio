function tarkista(){
    let virhe = false

    let etunimi = document.getElementById("firstname").value
    let sukunimi = document.getElementById("lastname").value
    let salasana = document.getElementById("password").value
    let vahvistus = document.getElementById("confirmPassword").value
    let puhelin = document.getElementById("phone").value

    if (isFinite(etunimi)) {
        alert("Anna kelvollinen etunimi")
        document.getElementById("firstname").value = ""
        document.getElementById("firstname").focus()
        virhe = true
        return
    }
    if (isFinite(sukunimi)) {
        alert("Anna kelvollinen sukunimi")
        document.getElementById("lastname").value = ""
        document.getElementById("lastname").focus()
        virhe = true
        return
    }
    if (isNaN(puhelin)) {
        alert("Anna kelvollinen puhelinnumero")
        document.getElementById("phone").value = ""
        document.getElementById("phone").focus()
        virhe = true
        return
    }
    if (salasana.length < 8) {
        document.getElementById("password").value = ""
        alert("Salasanassa on oltava vähintään 8 merkkiä!")
        document.getElementById("password").focus()
        virhe = true;
        return
    }
    if (salasana !== vahvistus){
        document.getElementById("confirmPassword").value = ""
        alert("Salasanan vahvistuksessa eri salasana!")
        document.getElementById("confirmPassword").focus()
        virhe = true;
        return
    }

}
function palauta() {
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == '') {
            alert('Tietoja puuttuu!');
            inputs[i].focus();
            return false;
        }
    }
    return true;
}

function muokkaus(){
    let virhe = false

    let etunimi = document.getElementById("etunimi").value
    let sukunimi = document.getElementById("sukunimi").value
    let salasana = document.getElementById("password").value
    let vahvistus = document.getElementById("confirmPassword").value
    let puhelin = document.getElementById("puhelin").value

    if (etunimi.trim() === "" || !/^[a-zA-ZäöåÄÖÅ]+$/.test(etunimi)) {
        alert("Anna kelvollinen etunimi")
        document.getElementById("etunimi").value = ""
        document.getElementById("etunimi").focus()
        virhe = true
        return false
    }
    if (sukunimi.trim() === "" || !/^[a-zA-ZäöåÄÖÅ]+$/.test(sukunimi)) {
        alert("Anna kelvollinen sukunimi")
        document.getElementById("sukunimi").value = ""
        document.getElementById("sukunimi").focus()
        virhe = true
        return false
    }
    if (isNaN(puhelin)) {
        alert("Anna kelvollinen puhelinnumero")
        document.getElementById("puhelin").value = ""
        document.getElementById("puhelin").focus()
        virhe = true
        return false
    }

    if (salasana.length < 8 && salasana.length != 0) {
        document.getElementById("password").value = ""
        alert("Salasanassa on oltava vähintään 8 merkkiä!")
        document.getElementById("password").focus()
        virhe = true;
        return false
    }
    if (salasana !== vahvistus){
        document.getElementById("confirmPassword").value = ""
        alert("Salasanan vahvistuksessa eri salasana!")
        document.getElementById("confirmPassword").focus()
        virhe = true;
        return false
    }
    return true
}


function resetointi() {
    var nappi = document.getElementsByName('valitsetekija');
    for (var i = 0; i < nappi.length; i++) {
        nappi[i].checked = false;
    }
    nappi = document.getElementsByName('valitsehomma');
    for (var i = 0; i < nappi.length; i++) {
        nappi[i].checked = false;
    }
}

function varmistus() {
    var tekija = document.querySelector('input[name="valitsetekija"]:checked');
    if (!tekija) {
        alert("Valitse tekijä ennen lähettämistä.");
        return false;
    }
    return true;
}