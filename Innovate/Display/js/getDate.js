/**
 * Functie om de datum van het device op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {date} De huidige datum van het device.
 */
function getCurrentDate()
{
    let today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();
    let day = today.getDate();
    let date = day +  "-" + month + "-" + year;
    //let date = year + "/" + month + "/" + day;
    let element = document.getElementById('date');
    element.innerHTML = date;
    return date;
}
window.onload = getCurrentDate;