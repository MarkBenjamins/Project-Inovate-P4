/**
 * @source https://www.tutorialrepublic.com/javascript-tutorial/javascript-timers.php
 */
function getTime() 
{
    var time = new Date();
    document.getElementById("clock").innerHTML = time.toLocaleTimeString();
}
// timer die elke seconden de functie aanroept.
setInterval(getTime, 1000);

export { getTime }; 