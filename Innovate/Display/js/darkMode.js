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
 * Constanten om de afbeeldingen aan te roepen.
 */
const docent = "../img/icons-scherm/docent.png";
const docentWit = "../img/icons-scherm/docent_wit.png";
const aanwezigheid = "../img/icons-scherm/aanwezigheid.png";
const aanwezigheidWit = "../img/icons-scherm/aanwezigheid_wit.png";
const addMessage = "../img/icons-scherm/addmessage.png";
const addMessageWit = "../img/icons-scherm/addmessage_wit.png";

/**
 * Functie om de inlog afbeelding te wijzigen
 * @deprecated vervangen door een if statment in een eigebreidere versie de toggle functie.
 * @note Deze apparte functie is nodig voor de niet ingelogde pagina buienrader en newsfeed.
 */
// function toggleBasic() 
// {
//     let DmBt = document.getElementById("DarkModeKnop");
//     switch (DmBt.value) 
//     {
//     case "ONN":
//         swapStyleSheet('../Css/Darkstyle.css')
//         document.getElementById("docentLogoColorChange").src = docentWit;
//         DmBt.value = "OFF";

//         break;
//     case "OFF":
//         swapStyleSheet('../Css/style.css')
//         document.getElementById("docentLogoColorChange").src = docent;
//         DmBt.value = "ONN";
//         break;
//     }
// }

/**
 * Functie van de Dark mode knop.
 * Zorgt er voor dat er gewisseld kan worden tussen:
 * - Darkstyle.css
 * - style.css
 * Zorgt ook dat de afbeeldingen gewisseld worden tussen donker en wit.
 * Waardoor de styling van de pagina verandert wordt.
 * De if statment kijkt of er al een afbeelding staat zo niet dan word dit NIET aangepast.
 */
function toggle() 
{
    let DmBt = document.getElementById("DarkModeKnop");
    switch (DmBt.value) 
    {
    case "ONN":
        // wisseld tussen style sheet.
        swapStyleSheet('../Css/Darkstyle.css');
        // set de kleur van de afbeelding
        document.getElementById("docentLogoColorChange").src = docentWit;
        // als er een afbeelding is verander dan de kleur ook
        if(document.getElementById("aanwezigheidLogoColorChange") != null) 
        {
            document.getElementById("aanwezigheidLogoColorChange").src = aanwezigheidWit;
            document.getElementById("addMessageLogoColorChange").src = addMessageWit;
        }
        DmBt.value = "OFF";
        break;

    case "OFF":
        // wisseld tussen style sheet.
        swapStyleSheet('../Css/style.css');
        // set de kleur van de afbeelding
        document.getElementById("docentLogoColorChange").src = docent;
        // als er een afbeelding is verander dan de kleur ook
        if(document.getElementById("aanwezigheidLogoColorChange") != null) 
        {
            document.getElementById("aanwezigheidLogoColorChange").src = aanwezigheid;
            document.getElementById("addMessageLogoColorChange").src = addMessage;
        }
        DmBt.value = "ONN";
        break;
    }
}