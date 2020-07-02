/**
 * File upload voor Message.
 * @note php op .jpg, .jpeg, png
 * @link wordt naar de database verzonden.
 */

//Krijgt het bestand uit de fileupload
function getImage()
{
    fileuploadform.addEventListener
    ('submit', (e) =>
    {
        var file = document.getElementById("fileupload").files[0];

        sendToDB(file)
        e.preventDefault();
    }
    );
}

//Verzend via REST het bestand naar de server waar het bestand word opgeslagen
function sendImage(file)
{
    let request = new XMLHttpRequest();
    var formdata = new FormData();
    formdata.append('image', file);

    request.open("POST", "../Display/fileupload.php", true);
    request.send(formdata);
}

//Verzend de link van de opslagplaats van het bestand + het id van de gebruiker die het bestand heeft geüpload naar een php file waar deze in de database word opgeslagen
function sendToDB(file)
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let name = file.name;
    let data = "idDB=" + id + "&tokenDB=" + token + "&nameDB=" + name;

    let request = new XMLHttpRequest();
    request.open("POST", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            alert(request.responseText);
            getID();
            if (request.responseText == "Bericht toegevoegd")
            {
                sendImage(file);
            }
        }
    }
    request.send(data);
}

//Stuurt het geincrypte ID + de token naar de php file waar deze word omgezet naar een leesbaar ID
function getID() 
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let data = `id=${id}&token=${token}`;
    let request = new XMLHttpRequest();

    request.open("GET", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(data);
}