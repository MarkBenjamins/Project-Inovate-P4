/**
 * Functie om het weeknummer op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {pastWeeks} het aantal weken die dit jaar om zijn + 1 omdat we in die week zitten
 */
function getWeek()
{
    const today = new Date();
    //haal de eerste dag van het jaar op
    let firstDayOfYear = new Date(today.getFullYear(), 0, 1);
    /**
     *haal de dagen sinds de eerste dag op, 86400000 is een dag in ms(miliseconden).
     *je pakt het aantal ms sinds 1 jan 1970, en haalt daar het aantal ms sinds 1 jan 1970 van de eerste dag van het jaar vanaf
     *dan hou je het aantal ms in dit jaar over, als je dat deelt door 86400000 krijg je het aantal dagen die zijn geweest
     */
    let pastDaysOfYear = (today - firstDayOfYear) / 86400000;
    //als je het aantal dagen van dit jaar hebt, moet je een toevoegen om de eerste dag (1 januari) mee te rekenen
    let pastWeeks = Math.ceil((pastDaysOfYear + 1) / 7);
    return pastWeeks;
}
/**
 * Functie om de datum van het device op te halen.
 * Note: Dit gebreurd bij elke refresh.
 * @return {date} De huidige datum van het device.
 */
function getCurrentDate()
{
    const today = new Date();
    //let year = today.getFullYear();
    let week = getWeek();
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
    let date = weekDay + " " + day +  " " + month + " WeekNr. " + week;
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
    getCurrentDate();
    const today = new Date();
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

