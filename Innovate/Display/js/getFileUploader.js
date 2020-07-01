/**
 * File upload voor Message.
 * @note php op .jpg, .jpeg, png
 * @link wordt naar de database verzonden.
 */
function getImage()
{
    fileuploadform.addEventListener
    ('submit', (e) =>
    {
        var file = document.getElementById("fileupload").files[0];

        sendImage(file);
        sendToDB(file);
        e.preventDefault();
    }
    );
}

function sendImage(file)
{
    let request = new XMLHttpRequest();
    var formdata = new FormData();
    formdata.append('image', file);

    request.open("POST", "../Display/fileupload.php", true);
    request.send(formdata);
}

function sendToDB(file)
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let name = file.name;
    let data = `idDB=${id}&tokenDB=${token}&nameDB=${name}`;

    let request = new XMLHttpRequest();
    request.open("POST", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            alert(request.responseText);
            getID();
        }
    }
    request.send(data);
}

function getID() 
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let data = `id=${id}&token=${token}`;
    let request = new XMLHttpRequest();
    request.open("GET", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //getMessages(request.responseText);
        }
    }
    request.send(data);
}

/*function getMessages(id)
{
    document.getElementById("messageID").innerHTML = "";
    let xmlhttp = new XMLHttpRequest();
    let message = [];
    let messages = null;
    xmlhttp.open("GET", "message.json", true);

    xmlhttp.onload = function () {
        messages = JSON.parse(xmlhttp.responseText);

        for (let x = 0; x < Object.keys(messages).length; x++) {
            if (messages[x].UserID == id) {
                //console.log(messages[x].link);
                message = { link: messages[x].Link };
                createTable(message[x].link)
            }
        }
    }
}



function createTable(link)
{
    //maak de table======================================================
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

    statusSpanElem.appendChild(statusElem);
    //koppel het statuselement aan het list element
    listElem.appendChild(statusSpanElem);
    //koppel het textelement aan het listelement
    listElem.appendChild(textElem);
    //koppel het list element aan het div element
    divElem.appendChild(listElem);

    //zet de stijl en de class van het statuselement aanhankelijk van de status
    statusElem.style.backgroundColor = colour;
    statusElem.setAttribute("class", "TeacherStatus");

    if(count%2 == 0)
    {
        divElem.setAttribute("class", "TeacherBlock1");
    }
    else
    {
        divElem.setAttribute("class", "TeacherBlock2");
    }

    //plak het gemaakte listelement onder het element van de UL
    document.getElementById("list").appendChild(divElem);

    //een counter voor de array
    count++;
    return details;
}*/
