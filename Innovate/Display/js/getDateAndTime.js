
/**
 * Functie om de datum van het device op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {date} De huidige datum van het device.
 */
function getCurrentDate()
{
    let today = new Date();
    let year = today.getFullYear();
    let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    let month = months[today.getMonth()];
    let day = today.getDate();
    let weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    let weekDay = weekDays[today.getDay()]
    if(month < 10)
    {
        month = "0" + month;
    }
    if(day < 10)
    {
       day = "0" + day;
    }
    let date = weekDay + " " + day +  "-" + month + "-" + year;
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
    if(hr < 10)
    {
        hr = "0" + hr;
    }
    if(min < 10)
    {
        min = "0" + min;
    }
    //let sec = today.getSeconds();
    //let time = hr + ":" + min + ":" + sec;
    let time = hr + ":" + min;
    let element = document.getElementById('time');
    element.innerHTML = time;
    return time;
}

window.onload = getTime;

