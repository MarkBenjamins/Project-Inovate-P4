/**
 * Function om de data uit de database op te vragen en weg te schrijven in een JSON file.
 */
let photo;
let xmlhttp = new XMLHttpRequest();
let teacher = [];
xmlhttp.open("GET", "teacher.json", true);

xmlhttp.onload = function () 
{
    myObj = JSON.parse(xmlhttp.responseText);

    for (x = 0; x <= 1; x++) 
    {
        teacher[x] = 
        { 
            id: myObj[x].id,
            firstname: myObj[x].voornaam,
            lastname: myObj[x].achternaam,
            status: myObj[x].status,
            foto: myObj[x].foto
        };
    }
}
xmlhttp.send(null);

/**
 * Functie om de status aan te passen in de database.
 * @param {id} id Het id nummer van de gebuiker die ingelogd is.
 * @param {status} status De status van de persoon die is ingelogd.
 */
function sendData(id, status)
{
    let data = "docentID="+ id + "&status=" + status;
    let request = new XMLHttpRequest();
    
    request.open("POST", "DBFunction.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function ()
    {
        if (this.readyState == 4 && this.status == 200)
        {
        document.getElementById("SEND").innerHTML = this.responseText;
        }
    }
    request.send(data);
}