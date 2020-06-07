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
    locateElement("paginaInhoud", 
    '<iframe src="https://gadgets.buienradar.nl/gadget/zoommap/?lat=52.77917&lng=6.90694&overname=2&zoom=8&naam=Emmen&size=3&voor=1" scrolling=no width=550 height=512 frameborder=no>'+
    '</iframe>'+
    '<IFRAME SRC="//gadgets.buienradar.nl/gadget/forecastandstation/6260" NORESIZE SCROLLING=NO HSPACE=0 VSPACE=0 FRAMEBORDER=0 MARGINHEIGHT=0 MARGINWIDTH=0 WIDTH=300 HEIGHT=190></IFRAME>');
    locateElement("toNewsfeed", '<button type="button" onclick="showNewsfeed()">Back to newsfeed</button>');
}

/**
 * Functie die de inhoud van de news-feed pagina laat zien.
 * @note Om dit te doen moet de pagina eerst leeg gemaakt worden door de clearAllData() functie.
 * @note Daarna word er gekeken of er is ingelogd, zodat de extra optie knoppen er bij komen.
 */
function showNewsfeed()
{
    clearAllData()
    locateElement("koptekst",'NEWSFEED');
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
            '<button onclick="/*!!!!!!!!!!!!!!!!!!!Hier is een bug*/tussenLogin()" type="submit">Login</button>'+
        '</div><br><br>'+
        '<p><a href="mailto:someone@example.com">Forgot your password?</a></p>'+
    '</form>'+
    '<br>'+
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
    '<h1>Logoff</h1>'+
    '<form>'+
        '<p> Do you want to logout?</p>'+
        '<button type="button" onclick="loguitkill()">logoff</button>'+
        '<br>'+
        '<br>'+
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
        '<br>'+
    '</form>'+

    '<h1>Change user Avatar</h1><br>'+
    '<form action="#">'+
        '<div>'+
            '<input type="hidden" id="user_id" value="75" />'+
            '<input type="file" id="avatar_img" accept="image/x-png" multiple />'+
        '</div>'+
        '<div class="changeAvatarButton">'+
            '<button id="btnSubmit" onclick="">Upload Avatar</button>'+
        '</div>'+
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
    '<h1>Wijzig Beschikbaarheid</h1>'+
    'Klik op een knop om je status te wijzigen:'+
    '<br><br>'+
    '<butten style="background-color: red;">Maak het rood</butten>'+
    '<br><br>'+
    '<butten style="background-color: yellow;"> Maak het geel</butten>'+
    '<br><br>'+
    '<butten style="background-color: green;">Maak het green</butten>');
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
        locateElement("aanwezigheidLogo",
        '<img onclick="showWijzigBeschikbaarheid()" id="aanwezigheidLogoColorChange" src="../img/icons-scherm/aanwezigheid.png" alt="Aanwezigheid" class="image"></img>');

        locateElement("addMessageLogo",
        '<img onclick="showMessage()" id="addMessageLogoColorChange" src="../img/icons-scherm/addmessage.png" alt="Add Message" class="image"></img>');

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