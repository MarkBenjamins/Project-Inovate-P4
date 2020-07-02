/**
 * Functie om de tijd te krijgen.
 */
function getTime() 
{
    var time = new Date();
    //haal het element van de klok op en set de tijd daarin
    document.getElementById("clock").innerHTML = time.toLocaleTimeString();
}
// timer die elke seconden de functie aanroept.
setInterval(getTime, 1000);

export { getTime }; 