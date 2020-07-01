// function ID()
// {
//     let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
//     let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
//     let data = `id=${id}&token=${token}`;
//     let request = new XMLHttpRequest();
//     request.open("POST", "../Display/fileupload.php", true);
//     request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    
//     request.onreadystatechange = function () 
//     {
//         if (this.readyState == 4 && this.status == 200) 
//         {
            
//             let responseID = request.responseText;
//             console.log(responseID);
//             localStorage.setItem("id", responseID);
//             return true;
//         }
//     }
//     request.send(data);
// }

function getMessages()
{
    document.getElementById("addTable").innerHTML = "";
    //localStorage.clear();
    let xmlhttp = new XMLHttpRequest();
    let messages = null;
    xmlhttp.open("GET", "message.json", true);
    console.log("test");
    
    console.log(localStorage.getItem("id"));
    xmlhttp.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200)
        {
            messages = JSON.parse(xmlhttp.responseText);
            //console.log(messages);
            for (let x = 0; x < Object.keys(messages).length; x++) 
            {
                console.log(messages[x].Link);
                console.log(messages[x].UserID);
                //ID();
                //console.log(localStorage.key("id"));
                createTable(messages[x].Link, messages[x].UserID);
            }
        }
    }
    xmlhttp.send(null);
    localStorage.clear();
}

function createTable(link, UserID)
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let data = `id=${id}&token=${token}`;
    let request = new XMLHttpRequest();
    request.open("POST", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    
    request.onreadystatechange = function () 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            
            let responseID = request.responseText;
            console.log(responseID);
            localStorage.setItem("id", responseID);
        }
    }
    request.send(data);
    if(responseID == UserID)
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
}