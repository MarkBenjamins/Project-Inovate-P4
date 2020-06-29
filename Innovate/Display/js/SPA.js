/**
 * Functie om een stuk code te plaatsen op een specefieke locatie
 * @param {*} locatie De locatie waar de code moet komen op bassis van id
 * @param {*} waarde De code die geplaatst moet worden
 */
function locateElement(locatie, waarde)
{
    document.getElementById(locatie).innerHTML = waarde;
}

/**
 * Verwijderd alle inhoudelijke data op de pagina.
 */
function clearAllData()
{
    locateElement("koptekst", '');
    locateElement("buienradarScreen", '');
    locateElement("toNewsfeed", '');
    locateElement("loginScreen", '');
    locateElement("logOFF", '');
    locateElement("aanwezigheidCheck", '');
    locateElement("showTheMessage", '');
    locateElement("rssBox", '')
}

/**
 * Functie die de inhoud van de buienradar pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showBuienradar()
{
    clearAllData();
    locateElement("koptekst", 'Buienradar');
    locateElement("toNewsfeed", '<button type="button" onclick="showNewsfeed()">Back to newsfeed</button>');
    locateElement("buienradarScreen", 
    '<iframe src="https://gadgets.buienradar.nl/gadget/zoommap/?lat=52.77917&lng=6.90694&overname=2&zoom=8&naam=Emmen&size=3&voor=1" scrolling=no width=550 height=512 frameborder=no></iframe>'+
    '<iframe class="weerInfo" SRC="https://gadgets.buienradar.nl/gadget/radarfivedays" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=256 HEIGHT=406></iframe>');
}

/**
 * Functie die de inhoud van de news-feed pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showNewsfeed()
{
    clearAllData();
    locateElement("koptekst",'Newsfeed');
    locateElement("rssBox",
    '<div class="bericht-box">'+
        '<img name="slide" width="100%" height="350"></img>'+
    '</div>'+
    '<div class="rss-box">'+
        '<div class="tweakersRSS">'+
            '<h4>Tweakers.net</h4>'+
            '<marquee behavior="scroll" direction="left">'+
                '<p id="titleTweakers"></p>'+
                '<p id="descriptionTweakers"></p>'+
            '</marquee>'+
        '</div>'+

        '<div class="nuRSS">'+
            '<h4>Nu.nl</h4>'+
            '<marquee behavior="scroll" direction="left">'+
                '<p id="titleNu"></p>'+
                '<p id="descriptionNu"></p>'+
            '</marquee>'+
        '</div>'+
    '</div>'
    );

    var i = 0;
    var images = [];
    var time = 3000;

    //image list
    images[0] = '../../img/berichten/1.png';
    images[1] = '../../img/berichten/2.png';

    //change image
    function getBerichten()
    {
        document.slide.src = images[i];

        if(i < images.length - 1)
        {
            i++;
        }
        else
        {
            i = 0;
        }

        setTimeout("getBerichten()", time);
    }
    window.onload = getBerichten;

    fetch("./tweakers.json")
        .then(function(resp) {return resp.json();})
        .then(function(data)
        {
            document.getElementById("titleTweakers").innerHTML = data[0].title;
            document.getElementById("descriptionTweakers").innerHTML = data[0].description;
        });

    fetch("./Nu.json")
        .then(function(resp) {return resp.json();})
        .then(function(data) 
        {
            document.getElementById("titleNu").innerHTML = data[0].title;
            document.getElementById("descriptionNu").innerHTML = data[0].description;
        });
}

/**
 * Functie die de inhoud van de login pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 * @bug form is al gedefineerd 
 * @todo fix de bug
 */
function showLogonPage()
{
    clearAllData();
    locateElement("loginScreen",
    '<h1>Login</h1><br>'+
    '<div id="error"></div>'+
    '<form id="form" method="POST">'+
        '<div class="loginForm">'+
            '<label for="name">Name</label><br>'+
            '<input id="name" name="name" type="text" placeholder="Username">'+
        '</div>'+

        '<div class="loginForm">'+
            '<label for="password">Password</label><br>'+
            '<input id="password" name="password" type="password" placeholder="Password">'+
        '</div>'+

        '<div>'+
            '<button type="submit" onclick=checkUsernameAndPassword()>Login</button>'+
        '</div><br>'+

        '<p><a href="mailto:someone@example.com">Forgot your password?</a></p>'+
    '</form>'+
    '<hr class="loginHr">'+
    '<button type="button" onclick="showNewsfeed()">Back to newsfeed</button>'
    );
}

/**
 * Functie die de inhoud van de logoff pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showLogoffPage()
{
    clearAllData();
    locateElement("logOFF",
    '<h1>Logout</h1>'+
    '<form>'+
        '<p> Do you want to logout?</p>'+
        '<button type="button" onclick="logout(); loguitkill();">Logout</button>'+
        '<br>'+
        '<hr class="logoffHr">'+
    '</form>'+

    '<h1>Change password</h1>'+
    '<div id="error"></div>'+
    '<form id="formChange" class="formPassword">'+
        '<label>Username</label><br>'+
        '<input type="text" id="name" name="name" placeholder="Username"><br>'+

        '<label>Old password</label><br>'+
        '<input type="password" id="password" name="password" placeholder="Current password"><br>'+

        '<label>New password</label><br>'+
        '<input type="text" id="newPassword" name="newPassword" placeholder="New password"><br>'+

        '<button onclick="changePassword()" type="submit">ChangePassword</button><br>'+
        '<hr class="logoffHr">'+
    '</form>'
    );
}

/**
 * Functie die de inhoud van de beschikbaarheid pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showWijzigBeschikbaarheid()
{
    clearAllData();
    locateElement("aanwezigheidCheck",
    '<div class="row">' +
        '<div class="beschikbaarheid">' +
            '<h1>Wijzig Beschikbaarheid</h1>' +
        '</div>' +
    '</div>' +

    '<div class="row">' +
        '<div class="beschikbaarheid">' +
            'Klik op een knop om je status te wijzigen:' +
        '</div>' +
    '</div>' +

    '<div id="row">' +
        '<div class="beschikbaarheid">' +
            '<button class="mijnbutton beschikbaar" style="margin: 20px;" id="1" onclick="sendData(1);">Beschikbaar</button>'+
            '<button class="mijnbutton aanwezig" style="margin: 20px;" id="2" onclick="sendData(2);">Aanwezig</button>'+
            '<button class="mijnbutton afwezig" style="margin: 20px;" id="3" onclick="sendData(3);">Afwezig</button>'+
        '</div> '+
    '</div>'+

    '<br />'+
    '<br />'+
    '<p id="SEND"></p>'+
    '<br />'+
    '<p id="text"></p>'
    );
}

/**
 * Functie die de inhoud van de message pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showMessage()
{
    clearAllData();
    locateElement("showTheMessage",
    '<h1>Message</h1><br>'+
    '<p>Upload your file here with the following extension : .jpg, .jpeg, png.</p>'+

    '<form id="fileuploadf" enctype="multipart/form-data" method="POST">'+
        '<div class="form-group">'+
            '<input id="fileupload" type="file" name="image" accept="image/*" class="form-control" id="image">'+
        '</div>'+
        '<div class="form-group">'+
            '<button type="submit" id="uploadfile" onclick="validate_fileupload()">Upload</button>'+
        '</div>'+
    '</form><br>'+

    '<button onclick="remove()"> Remove all picture s </button><br>'+
    '<div id="result" class="result">'
    );
}

/**
 * Functie om je uit te loggen en alle data te wissen
 * @note Het verwijderd ook de afbeeldingen die je in de fileuploader hbet staan.
 */
function loguitkill()
{
    disableAllButtons();
    showNewsfeed();
    document.getElementById('docentLogoColorChange').setAttribute ("onClick", "showLogonPage()");
}

/**
 * Functie om de button voor login om te zetten naar loguit
 */
function tussenLogin()
{
    showNewsfeed();

    if(typeof sessionStorage.id !== 'undefined')
    {
        enabelAllButtons();
        document.getElementById('docentLogoColorChange').setAttribute ("onClick", "showLogoffPage()");
    }
}

/**
 * Functie om alle buttens WEL weer te geven.
 */
function enabelAllButtons()
{
    if (typeof sessionStorage.id !== 'undefined')
    {
        let aanwezigheid = "../img/icons-scherm/aanwezigheid.png";
        let message = "../img/icons-scherm/addmessage.png";
        let DmBt = document.getElementById("DarkModeKnop");
        if (DmBt.value == "OFF")
        {
            aanwezigheid = "../img/icons-scherm/aanwezigheid_wit.png";
            message = "../img/icons-scherm/addmessage_wit.png";
        }

        locateElement("aanwezigheidLogo",
        '<img onclick="showWijzigBeschikbaarheid()" id="aanwezigheidLogoColorChange" src="' + aanwezigheid + '" alt="Aanwezigheid" class="image"></img>');

        locateElement("addMessageLogo",
        '<img onclick="showMessage()" id="addMessageLogoColorChange" src="' + message + '" alt="Add Message" class="image"></img>');

        locateElement("newsfeedLogo",
        '<img onclick="showNewsfeed()" src="../img/icons-scherm/logo.png" alt="Logo" class="image"></img>');
    }
}

/**
 * Functie om alle buttens NIET weet te geven.
 */
function disableAllButtons()
{
    window.localStorage.clear();
    locateElement("aanwezigheidLogo",'');
    locateElement("addMessageLogo",'');
    locateElement("newsfeedLogo",'');
}

function logout() 
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let data = "logout=true&logoutid=" + id + "&logouttoken=" + token;

    let request = new XMLHttpRequest();

    sessionStorage.removeItem("id");
    request.open("POST", "../Display/DBFunction.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // @Avijn doet dit iets?
    request.onreadystatechange = function ()
    {
    }
    request.send(data);
}