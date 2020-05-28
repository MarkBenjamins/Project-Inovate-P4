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
        MakeDetails()
    }
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
function MakeDetails()
{
    let colour = getColour();
    // voeg de voor en achternaam samen
    let details = JSON[count].voornaam + " "+ JSON[count].achternaam + " " + JSON[count].foto;
    //maak een nieuw element aan
    var elem = document.createElement("LI");
    //maak er tekst voor dat nieuwe element
    var textElem = document.createTextNode(details);
    //koppel de tekst aan het element
    elem.appendChild(textElem);
    //zet de stijl aanhankelijk van de status
    elem.style.color = colour;
    //plak de gemaakte list onder het element van de UL
    document.getElementById("list").appendChild(elem);
    //@todo fotos er in maken
    //een counter voor de array
    count++;
    return details;
}
export { getDetails }; 