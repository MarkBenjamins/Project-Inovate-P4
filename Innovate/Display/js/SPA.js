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
    locateElement("paginaInhoud", '');
    locateElement("toNewsfeed", '');
    locateElement("loginScreen", '');
    locateElement("logOFF", '');
    locateElement("aanwezigheidCheck", '');
    locateElement("showTheMessage", '');
}
/**
 * Functie die de inhoud van de buienradar pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showBuienradar()
{
    clearAllData()
    locateElement("koptekst", 'Buienradar');
    locateElement("toNewsfeed", '<button type="button" onclick="showNewsfeed()">Back to newsfeed</button>');
    locateElement("paginaInhoud", 
    '<iframe src="https://gadgets.buienradar.nl/gadget/zoommap/?lat=52.77917&lng=6.90694&overname=2&zoom=8&naam=Emmen&size=3&voor=1" scrolling=no width=550 height=512 frameborder=no>'+
    '</iframe>'+
    '<IFRAME class="weerInfo" SRC="https://gadgets.buienradar.nl/gadget/radarfivedays" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=256 HEIGHT=406></IFRAME>');
}

/**
 * Functie die de inhoud van de news-feed pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showNewsfeed()
{
    clearAllData()
    locateElement("koptekst",'Newsfeed');
    locateElement("paginaInhoud",
    '<div class="rss-box">'+
        '<div class="tweakersRSS">'+
            '<marquee behavior="scroll" direction="left"><p id="titleTweakers"></p>'+
                '<p id="descriptionTweakers"></p>'+
            '</marquee>'+
        '</div>'+
        fetch("./tweakers.json").then(function(resp) {return resp.json();})
            .then(function(data)
            {
                console.log(data);
                document.getElementById("titleTweakers").innerHTML = data[0].title;
                document.getElementById("descriptionTweakers").innerHTML = data[0].description;
            })+
        '<div class="nuRSS">'+
        '<marquee behavior="scroll" direction="left"><p id="titleNu"></p>'+
        '<p id="descriptionNu"></p>'+
        '</marquee></div>'+
        fetch("./Nu.json").then(function(resp) {return resp.json();})
            .then(function(data) 
            {
                console.log(data);
                document.getElementById("titleNu").innerHTML = data[0].title;
                document.getElementById("descriptionNu").innerHTML = data[0].description;
            })+
    '</div>'
    );
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
    clearAllData()
    locateElement("loginScreen",
    '<h1>Login</h1><br>'+
    '<div id="error"></div>'+
    '<form id="form" method="GET">'+
        '<div class="loginForm">'+
            '<label for="name">Name</label><br>'+
            '<input id="name" name="name" type="text" placeholder="Username">'+
        '</div>'+
        '<div class="loginForm">'+
            '<label for="password">Password</label><br>'+
            '<input id="password" name="password" type="password" placeholder="Password">'+
        '</div>'+
        '<div>'+
            '<button onclick="tussenLogin()" type="submit">Login</button>'+
        '</div><br>'+
        '<p><a href="mailto:someone@example.com">Forgot your password?</a></p>'+
    '</form>'+
    '<hr class="loginHr">'+
    '<button type="button" onclick="showNewsfeed()">Back to newsfeed</button>'
    )
}

/**
 * Functie die de inhoud van de logoff pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showLogoffPage()
{
    clearAllData()
    locateElement("logOFF",
    '<h1>Logout</h1>'+
    '<form>'+
        '<p> Do you want to logout?</p>'+
        '<button type="button" onclick="loguitkill()">Logout</button>'+
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
        '<button onclick="changePassword()" type="submit">ChangePassword</button>'+
        '<br>'+
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
    clearAllData()
    locateElement("aanwezigheidCheck",
    '<div class="row">'+
    '   <div style="text-align:center;margin:0 auto">'+
            '<h1>Wijzig Beschikbaarheid</h1>'+
        '</div>'+
    '</div>'+
    '<div class="row">'+
    '   <div style="text-align:center;margin:0 auto">'+
            'Klik op een knop om je status te wijzigen:'+
        '</div>'+
    '</div>'+
    '<div id="row">'+  
        '<div style="text-align:center;margin:0 auto">'+
            '<button class="mijnbutton beschikbaar" style="margin: 20px;" id="1" onclick="sendData(1, 1)">Beschikbaar</button>'+
            '<button class="mijnbutton aanwezig" style="margin: 20px;" id="2" onclick="sendData(1, 2)">Aanwezig</button>'+
            '<button class="mijnbutton afwezig" style="margin: 20px;" id="3" onclick="sendData(1, 3)">Afwezig</button>'+
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
    clearAllData()
    locateElement("showTheMessage",
    '<h1>Message</h1><br>'+
    '<p>Upload your file here with the following extension : .jpg, .jpeg, png.</p>'+

    '<form id="form" enctype="multipart/form-data" method="POST">'+
        '<div class="form-group">'+
            '<input type="file" name="fileUpload" accept=".jpg, .jpeg, .png" class="form-control" id="image" onchange="validate_fileupload(this.value);">'+
        '</div>'+
        '<div class="form-group">'+
            '<button type="submit"> Uploaden </button>'+
        '</div>'+
    '</form><br>'+

    '<button onclick="remove()"> Remove all picture s </button><br>'+
    '<div id="result" class="result">'+
    '<style>div.result>img{height: 250px;border-radius: 10px;}</style>');
}

/**
 * Functie om je uit te loggen en alle data te wissen
 * @note Het verwijderd ook de afbeeldingen die je in de fileuploader hbet staan.
 */
function loguitkill()
{
    clearAllData()
    disableAllButtons()
    showNewsfeed()
    document.getElementById('docentLogoColorChange').setAttribute ("onClick", "showLogonPage()");
}

/**
 * Functie om de button voor login om te zetten naar loguit
 */
function tussenLogin()
{
    showNewsfeed()
    window.localStorage.setItem('user','user')

    if (window.localStorage.length > 0)
    {
        enabelAllButtons()
        document.getElementById('docentLogoColorChange').setAttribute ("onClick", "showLogoffPage()");
    }
}

/**
 * Functie om alle buttens WEL weer te geven.
 */
function enabelAllButtons()
{
    if (window.localStorage.length > 0)
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
    window.localStorage.clear()
    locateElement("aanwezigheidLogo",'');
    locateElement("addMessageLogo",'');
    locateElement("newsfeedLogo",'');
}