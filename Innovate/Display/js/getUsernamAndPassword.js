// Loop through Array of Objects
var user = 
[
	{ // user @ 0 index
		username: "mark",
		password: "mark"
	},
	{ // user @ 1 index
		username: "storm",
		password: "storm"
	},
	{ // user @ 2 index
		username: "jenny",
		password: "jenny"
	}
]

/**
 * Functie om de user input te valideren met de array.
 * Validate {true} Ingelogd melding, waarna je wordt doorgelinkt naar de ingelogde pagina.
 * Validate {false} Error melding.
 * @param {username} De input die de user invuld.
 * @param {password} De input die de user invuld.
 */
function getInfo() 
{
    // user input naar var 
	var username = document.getElementById('username').value
	var password = document.getElementById('password').value

    for(var i = 0; i < user.length; i++) 
    {
        // Checkt of user input overeenkomt met een waarde die in de objPeople array staat.
        if(username == user[i].username && password == user[i].password) 
        {
			alert(username + " is logged in!!!")
            // stop de functie als je ingelogd bent
            window.location.href = toNewsfeedLogin();
			return
		}
	}
	alert("Incorrect username or password.")
}
