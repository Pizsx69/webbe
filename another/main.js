
// Kliens oldali ellenőrzés
function ellenoriz() {

    var rendben = true;
    var fokusz = null;

    // Email (kötelező + email formátum)
    var email = document.getElementById("email");
    if (email) {
        var checkPattern = /^([A-Za-z0-9_\-\.])+@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!checkPattern.test(email.value)) {
            rendben = false;
            email.style.background = '#f99';
            fokusz = email;
        } else {
            email.style.background = '#9f9';
        }
    }

    // Név (kötelező, min 5, max 30)
    var nev = document.getElementById("name");
    if (nev) {
        if (nev.value.length < 5 || nev.value.length > 30) {
            rendben = false;
            nev.style.background = '#f99';
            fokusz = nev;
        } else {
            nev.style.background = '#9f9';
        }
    }

    // Jelszó (kötelező, min 6, max 12)
    var jelszo = document.getElementById("pw");
    if (jelszo) {
        if (jelszo.value.length < 6 || jelszo.value.length > 12) {
            rendben = false;
            jelszo.style.background = '#f99';
            fokusz = jelszo;
        } else {
            jelszo.style.background = '#9f9';
        }
    }

    // Kor (kötelező, szám, 18–100)
    var kor = document.getElementById("age");
    if (kor) {
        var ertek = parseInt(kor.value);
        if (isNaN(ertek) || ertek < 18 || ertek > 100) {
            rendben = false;
            kor.style.background = '#f99';
            fokusz = kor;
        } else {
            kor.style.background = '#9f9';
        }
    }

    // Nem (kötelező)
    var genderWoman = document.getElementById("woman").checked;
    var genderMan = document.getElementById("man").checked;

    if (!genderWoman && !genderMan) {
        rendben = false;
        alert("A nem kiválasztása kötelező!");
    }

    // Fókusz beállítása, ha volt hiba
    if (fokusz)
        fokusz.focus();

    // Küldés gomb engedélyezése / tiltása
    var kuld = document.getElementById("kuld");
    if (kuld)
        kuld.disabled = !rendben;

    return rendben;
}
