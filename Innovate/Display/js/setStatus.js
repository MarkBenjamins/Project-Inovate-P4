let photo;
let xmlhttp = new XMLHttpRequest();
let teacher = [];
xmlhttp.open("GET", "teacher.json", true);

xmlhttp.onload = function () 
{
    myObj = JSON.parse(xmlhttp.responseText);

    for (x = 0; x <= 1; x++) 
    {
        teacher[x] = { id: myObj[x].id, firstname: myObj[x].voornaam, lastname: myObj[x].achternaam, status: myObj[x].status, foto: myObj[x].foto };

        document.getElementById("demo" + x).innerHTML = myObj[x].voornaam + " " + teacher[x].lastname;
        photo = "../profilePictures/" + teacher[x].foto;
        document.getElementById("photo" + x).src = photo;
    }
}

xmlhttp.send(null);

function sendData(id, status)
{

    let data =id + "=" + status;
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