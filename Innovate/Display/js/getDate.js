const TODAY = new Date();
/**
 * Functie om de datum van het device op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {date} De huidige datum van het device.
 */
function getCurrentDate()
{
    let year = TODAY.getFullYear();
    let month = TODAY.getMonth();
    let day = TODAY.getDate();
    let date = day +  "-" + month + "-" + year;
    //let date = year + "/" + month + "/" + day;
    let element = document.getElementById('date');
    element.innerHTML = date;
    return date;
}
window.onload = getCurrentDate;