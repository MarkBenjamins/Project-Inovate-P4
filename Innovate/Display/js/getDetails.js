//een simpele json file die ik verwacht te krijgen
const JSON = [{
    voornaam:"Gerjan",
    achternaam:"Van Oenen",
    status:2,
    foto:"foto."},
    {
    voornaam:"Rob",
    achternaam:"Smit",
    status:1,
    foto:"foto."}]
//alles hieronder moet geloopt worden aan de hand van de json file
let count = 0;
for (let index = 1; index < JSON.length; index++) 
{
    this.getDetails()
}
//een functie om aan de hand van de status de kleur te returnen
function getColour()
{
    
    let colour;
    switch(JSON[count].status)
    {
        case 0:
            colour = "green"    //aanwezig en beschikbaar
            break;
        case 1:
            colour = "red"      //afwezig
            break;
        case 2:
            colour = "#ffe066"  //geel, aanwezig maar niet beschikbaar
            break;
        default:
            colour = "grey"     //default als het onbekend is
    }
    return colour;
}
//functie om de naam en foto path op te halen
function getDetails()
{
    let colour = getColour();
    // voeg de voor en achternaam samen
    let details = JSON[count].voornaam + " "+ JSON[count].achternaam + " " + JSON[count].foto;
    //maak een nieuw element aan
    var elem = document.createElement("LI");
    //maak er tekst voor
    var textElem = document.createTextNode(details);
    elem.appendChild(textElem);
    elem.style.color = colour;
    document.getElementById("list").appendChild(elem);
    console.log(details);
    count++;
    return details;
}
window.onload = getDetails;