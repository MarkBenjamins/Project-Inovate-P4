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
                button.value = "OFF";
                break;
            case "OFF":
                swapStyleSheet('../Css/lightstyle.css')
                button.value = "ONN";
                break;
    }
}