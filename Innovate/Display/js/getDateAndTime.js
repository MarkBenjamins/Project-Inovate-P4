
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
    month++;
    let day = today.getDate();
    let date = day +  "-" + month + "-" + year;
    //let date = year + "/" + month + "/" + day;
    let element1 = document.getElementById('date');
    element1.innerHTML = date;
    return date;
}

/**
 * Functie om de tijd van het device op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {time} De huidige tijd van het device.
 */
function getTime()
{
    let date = getCurrentDate()
    let today = new Date();
    let hr = today.getHours();
    let min = today.getMinutes();
    //let sec = today.getSeconds();
    //let time = hr + ":" + min + ":" + sec;
    let time = hr + ":" + min;
    let element = document.getElementById('time');
    element.innerHTML = time;
    return time;
}

window.onload = getTime;

