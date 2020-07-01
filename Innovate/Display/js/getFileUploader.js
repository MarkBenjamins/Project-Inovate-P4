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
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        }
    }
    request.send(formdata);
}

function sendToDB(file)
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let name = file.name;
    let data = `id=${id}&token=${token}&name=${name}`;

    let request = new XMLHttpRequest();
    request.open("POST", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(request.responseText);
            getID();
        }
    }
    request.send(data);
}

function getID() {
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let data = `id=${id}&token=${token}`;
    let request = new XMLHttpRequest();
    request.open("GET", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            getMessages(request.responseText);
        }
    }
    request.send(data);
}

function getMessages(id)
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
    let table = document.createElement("table");
    //maak een table row aan
    let tr1 = table.insertRow();
    //maak een cell in die tablerow komt
    let td1 = tr1.insertCell();
    //maak de tweede row aan
    let tr2 = table.insertRow();
    //maak 2 cells aan
    let td2 = tr2.insertCell();
    let td3 = tr2.insertCell();
    //plaats de tabel
    document.getElementById("addTable").appendChild(table);
    table.className = "tableFromJS"
    //maak de image en zet hem in de tabel===============================
    //maak een image aan
    let img = document.createElement("img")
    //set de source en de class van de img
    img.src = link;
    img.className = "imgInTableFromJS"
    //plak de img aan de td
    td1.appendChild(img);
    //laat de img 2 colommen breed zijn
    td1.colSpan = 2;
    //maak de knoppen====================================================
    //maak de buttons aan
    let del = document.createElement("button");
    let show = document.createElement("button");
    // maak de onclicks
    del.setAttribute("onclick", "javascript: console.log('you clicked verwijderen');");
    show.setAttribute("onclick", "javascript: console.log('you clicked laat zien');");
    //plaats de tekst in de buttons
    del.textContent = "verwijder";
    show.textContent = "laat zien";
    //plaats de buttons in de tabel
    td2.appendChild(del);
    td3.appendChild(show);
}