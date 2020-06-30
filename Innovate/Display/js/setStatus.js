/**
 * Function om de data uit de database op te vragen en weg te schrijven in een JSON file.
 */
document.getElementById('test334').setAttribute('class', 'aanwezig');
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
function sendData(status)
{
    if (typeof sessionStorage.id !== 'undefined') 
    {
        let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
        let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);

        let data = "docentID=" + id + "&docentToken=" + token + "&status=" + status;
        let request = new XMLHttpRequest();

        request.open("POST", "../Display/DBFunction.php", true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        request.onreadystatechange = function () 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById("SEND").innerHTML = this.responseText;
                document.getElementById("button1").setAttribute('class', "button1");
                document.getElementById("button2").setAttribute('class', "button2");
                document.getElementById("button3").setAttribute('class', "button3");
                buttonclass = "button" + status  + ' set';
                buttonid = "button" + status;
                document.getElementById(buttonid).setAttribute('class', buttonclass);
            }
        }
        request.send(data);
    }
}