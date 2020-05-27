function login(password){
    var rootdir = ""; // deze aanpassen als je beveiligde map in een subdirectory staat
    var testfile = "password.txt"; // deze aanpassen als je testfile anders heet.
    if(!password){
        alert('Vul iets in bij wachtwoord');
        return false;
    }
    var url = rootdir + password + "/" + testfile;
    if (document.getElementById) var request = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();

// var request = new XMLHttpRequest();
    request.open("GET", url, false);
    request.send(null);

    if(request.status == 200)
    {
        // het bestand bestaat > redirect > met timeout werkt het ook in FF
        setTimeout('location.href = "' + rootdir + password + '/"',5);
    }
    else
    {
        // eventueel zou deze foutmelding nog mooier kunnen
        alert("Het wachtwoord is onjuist");
    }
}



