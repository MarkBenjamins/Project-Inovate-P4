let count = 0;
/**
 * Functie om door de waardes van de JSON file heen te loopen.
 * @note Het aantal loops is afhankelijk van de grote van de JSON File
 */
function getDetails()
{
    localStorage.clear();
    let xmlhttp = new XMLHttpRequest();
    let teacher = [];
    let myObj = null;
    xmlhttp.open("GET", "teacher.json", true);

    xmlhttp.onload = function () {
        myObj = JSON.parse(xmlhttp.responseText);

        for (let x = 0; x < Object.keys(myObj).length; x++) {
            teacher[x] = { fname: myObj[x].voornaam, lname: myObj[x].achternaam, status: myObj[x].status };
            makeDetails(teacher[x].fname, teacher[x].lname, teacher[x].status);
        }
    }
    xmlhttp.send(null);
}
/**
 * Functie om de status van de JSON file uit te lezen en aan de hand daarvan de kleur te bepalen.
 * @return {colour} De kleur die gelijk staat aan de status.
 */
function getColour(status)
{
    let colour;
    switch(status)
    {
        case 1:
            colour = "green"    //groen, aanwezig en beschikbaar
            break;
        case 2:
            colour = "yellow"  //geel, aanwezig maar niet beschikbaar
            break;
        case 3:
            colour = "red"      //rood, afwezig
            break;
        default:
            colour = "#737373"  //grijs, default als het onbekend is
    }
    return colour;
}

/**
 * Functie om de gegevens van de docent op te halen.
 * @return {details} Bevat de status kleur, fotolocatie, voornaam en achternaam van de gebruiker.
 */
function makeDetails(Fname, Lname, Status)
{
    //haal de kleur op
    let colour = getColour(Status);

    // voeg de voor en achternaam samen
    let details = Fname + " "+ Lname;

    //maak een div aan waar de list elementen in kunnen
    let divElem = document.createElement("div");
    //maak een nieuw list element aan
    let listElem = document.createElement("li");
    //maak een nieuw div element aan
    let statusElem = document.createElement("div");
    //maak een span aan om de div in te zetten
    let statusSpanElem = document.createElement("span");

    //maak er tekst voor dat nieuwe list element
    let textElem = document.createTextNode(details);

    statusSpanElem.appendChild(statusElem)
    //koppel het statuselement aan het list element
    listElem.appendChild(statusSpanElem);
    //koppel het textelement aan het listelement
    listElem.appendChild(textElem);
    //koppel het list element aan het div element
    divElem.appendChild(listElem);

    //zet de stijl en de class van het statuselement aanhankelijk van de status
    statusElem.style.backgroundColor = colour;
    statusElem.setAttribute("class", "TeacherStatus");
    // statusElem.style.width = "5px";
    // statusElem.style.height = "30px";
    // statusElem.style.float = "left"
    // statusElem.style.marginRight = "5px"
    // statusElem.style.marginTop = "-5px"
    //set de class van het divElement
    if(count%2 == 0)
    {
        divElem.setAttribute("class", "TeacherBlock1");
    }
    else
    {
        divElem.setAttribute("class", "TeacherBlock2");
    }

    // divElem.style.height = "40px";
    // divElem.style.width = "110%";
    // divElem.style.marginBottom = "10px";
    // divElem.style.paddingTop = "10px";
    // divElem.style.paddingLeft = "10px";
    // divElem.style.backgroundColor = "white";
    // divElem.style.color = "black";

    //plak het gemaakte listelement onder het element van de UL
    document.getElementById("list").appendChild(divElem);

    //een counter voor de array
    count++;
    return details;
}
//roep elke 10 seconden de functie aan

export { getDetails };