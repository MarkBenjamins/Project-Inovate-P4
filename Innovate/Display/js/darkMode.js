/**
 * Functie om van CSS style file te wisselen.
 * Wordt gebruikt voor de darkmode van de pagina.
 * @param {*} sheet De file waar je de huidige stijle mee wil verwisselen.
 * @see {toggle()} De functie die wisselen tussen de dark style en light style mogelijk maakt.
 */
function swapStyleSheet(sheet)
{
    document.getElementById('pagestyle').setAttribute('href', sheet);
}

/**
 * Functie van de Dark mode knop.
 * Zorgt er voor dat er gewisseld kan worden tussen:
 * - Darkstyle.css
 * - Lightstyle.css
 * Waardoor de styling van de pagina verandert wordt.
 * @param {*} button De knop waar op gedrukt wordt om te wisselen van css file.
 */
function toggle(button) 
{
        switch (button.value) {
            case "ONN":
                swapStyleSheet('../Css/Darkstyle.css')
                document.getElementById("docentLogoColorChange").src = "../img/icons-scherm/docent_wit.png";
                document.getElementById("aanwezigheidLogoColorChange").src = "../img/icons-scherm/aanwezigheid_wit.png";
                document.getElementById("addMessageLogoColorChange").src = "../img/icons-scherm/addmessage_wit.png";
                button.value = "OFF";

                break;
            case "OFF":
                swapStyleSheet('../Css/lightstyle.css')
                document.getElementById("docentLogoColorChange").src = "../img/icons-scherm/docent.png";
                document.getElementById("aanwezigheidLogoColorChange").src = "../img/icons-scherm/aanwezigheid.png";
                document.getElementById("addMessageLogoColorChange").src = "../img/icons-scherm/addmessage.png";
                button.value = "ONN";
                break;
    }
}

function toggleBasic(button) 
{
        switch (button.value) {
            case "ONN":
                swapStyleSheet('../Css/Darkstyle.css')
                document.getElementById("docentLogoColorChange").src = "../img/icons-scherm/docent_wit.png";
                button.value = "OFF";

                break;
            case "OFF":
                swapStyleSheet('../Css/lightstyle.css')
                document.getElementById("docentLogoColorChange").src = "../img/icons-scherm/docent.png";
                button.value = "ONN";
                break;
    }
}


// function iconsDark()
// {
//     document.getElementById("imgClickAndChange").src = "../img/icons-scherm/docent_wit.png";
// }

// function iconsLight()
// {
//     document.getElementById("imgClickAndChange").src = "../img/icons-scherm/docent.png";
// }

/**
 * @Bug Neemt darkmode niet mee naar volgende pagina, 
 * misschien kun je de set pagestyle die in de main style.css link staat overschrijven door de gewenste.
 */