//een simpele json file die ik verwacht te krijgen
const JSON = [
    {
    voornaam:"Albert",
    achternaam:"De Jonge",
    status:0,
    foto:"foto."
    },
    {
    voornaam:"Gerjan",
    achternaam:"Van Oenen",
    status:2,
    foto:"foto."
    },
    {
    voornaam:"Elleke",
    achternaam:"Jagersma",
    status:0,
    foto:"foto."
    },
    {
    voornaam:"Rob",
    achternaam:"Smit",
    status:1,
    foto:"foto."
    },
    {
    voornaam:"Jan",
    achternaam:"Doornbos",
    status:0,
    foto:"foto."
    }
]
//alles hieronder moet geloopt worden aan de hand van de json file
let count = 0;
function getDetails()
{
    for (let index = 0; index < JSON.length; index++) 
    {
        makeDetails()
    }
}
//een functie om aan de hand van de status de kleur te returnen
function getColour()
{
    let colour;
    switch(JSON[count].status)
    {
        case 0:
            colour = "green"    //groen, aanwezig en beschikbaar
            break;
        case 1:
            colour = "red"      //rood, afwezig
            break;
        case 2:
            colour = "#ffe066"  //geel, aanwezig maar niet beschikbaar
            break;
        default:
            colour = "grey"     //grijs, default als het onbekend is
    }
    return colour;
}
//functie om de naam en foto path op te halen
function makeDetails()
{
    let colour = getColour();
    // voeg de voor en achternaam samen
    let details = JSON[count].voornaam + " "+ JSON[count].achternaam + " " + JSON[count].foto;
    //maak een nieuw list element aan
    let elem = document.createElement("li");
    //maak een nieuw span element aan
    let statusElem = document.createElement("span");
    //maak er tekst voor dat nieuwe list element
    let textElem = document.createTextNode(details);
    //maak iets(nu tekst) voor dat nieuwe span element
    let blockElem = document.createTextNode("o ")
    //koppel het block element met iets(nu tekst) aan het statuselement
    statusElem.appendChild(blockElem);
    //koppel het statuselement aan het list element
    elem.appendChild(statusElem);
    //koppel het textelement aan het listelement
    elem.appendChild(textElem);
    //zet de stijl van het statuselement aanhankelijk van de status
    statusElem.style.color = colour;
    //plak het gemaakte listelement onder het element van de UL
    document.getElementById("list").appendChild(elem);
    //een counter voor de array
    count++;
    return details;
}
export { getDetails }; 