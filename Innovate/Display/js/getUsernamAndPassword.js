/**
 * Constanten voor de {checkUsernameAndPassword()} functie.
 */
const username = document.getElementById('name')
const password = document.getElementById('password')
const formLogin = document.getElementById('form')
const errorElement = document.getElementById('error')

/**
 * Functie om de user input voor username en password te valideren.
 * Na de validate met de array user wordt de gebruiker doorgestuurd en stopt de code. 
 * 
 * Validatie lijst:
 * - Alle input velden moeten ingelvuld zijn.
 * - Alle input moet meer dan 3 karakters bevatten.
 * - Alle input moet minder dan 20 karakters bevatten.
 * - Wachtwoorden mogen niet wachtwoord of password zijn.
 * - Username cannot be te password.
 * - Check of username en password bij elkaar horen.
 */
function checkUsernameAndPassword()
{
	formLogin.addEventListener
	('submit', (e) => 
		{
			// array voor de error meldingen.
			let messages = []

			// if input username is leeg error.
			if (username.value === '' || username.value == null || username.value === ' ') 
			{
				messages.push('Username is required')
			}

			// if input password is leeg error.
			else if (password.value === '' || password.value == null || password.value === ' ') 
			{
				messages.push('Password is required')
			}

			// if password bestaat uit minder dan 3 karakters error.
			else if (username.value.length < 3) 
			{
				messages.push('Password must be longer than 3 characters')
			}

			// if password bestaat uit meer dan 19 karakters error.
			else if (username.value.length >= 20) 
			{
				messages.push('Password must be less than 20 characters')
			}

			// if password bestaat uit minder dan 3 karakters error.
			else if (password.value.length < 3) 
			{
				messages.push('Password must be longer than 3 characters')
			}

			// if password beaat uit meer dan 19 karakters error.
			else if (password.value.length >= 20) 
			{
				messages.push('Password must be less than 20 characters')
			}

			// if password is wachtwoord of password error.
			else if(password.value === 'password' || password.value === 'wachtwoord' || password.value === 'Password'|| password.value === 'Wachtwoord') 
			{
				messages.push('Password cannot be password or wachtwoord')
			}

			// if username is password error.
			else if(username.value === password.value)
			{
				messages.push('The username cannot be used as password')
			}

			// if input username en input password gelijk zijn aan username en password uit array user.
			// ga naar de volgende pagina, anders geef een errror. 
			else
			{
				var inputUsername = username.value
				var inputPassword = password.value

				e.preventDefault()
				login(inputUsername, inputPassword);
				return
			}

			// Als de input niet voldoet stuur dan de error naar het scherm
			if(messages.length > 0) 
			{
				e.preventDefault()
				errorElement.innerText = messages.join(', ')
			}
		}
	)
}

function login(username, password)
{
	let data = "username="+ username + "& password="+ password;
	let request = new XMLHttpRequest();

	request.open("POST", "../Display/testdatabase.php", true);
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	request.onreadystatechange = function ()
    {
		if (this.readyState == 4 && this.status == 200)
		{
			if (request.responseText.search("&") !== -1) {
				sessionStorage.id = request.responseText;

				document.getElementById("login").onclick = logout;
				document.getElementById("login").value = "logout";
				document.getElementById("form").reset();
			}
			else {
				document.getElementById("error").innerText = request.responseText;
			}
        }
    }
	request.send(data);
	setInterval(sessionCheck, 2000);
	
}

function sessionCheck()
{
	if (typeof sessionStorage.id !== 'undefined')
	{
		let response = "";
		let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
		let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
		let data = "id=" + id + "&token=" + token;
		let request = new XMLHttpRequest();

		request.open("POST", "../Display/testdatabase.php", true);
		request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		request.onreadystatechange = function ()
		{
			if (this.readyState == 4 && this.status == 200) {
				response = request.responseText;

				if (response == false)
				{
					storage.removeItem("id");
                }
			}
		}
		request.send(data);
	}
}

function logout()
{
	let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
	let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
	let data = "logout=true&logoutid=" + id + "&logouttoken=" + token;

	let request = new XMLHttpRequest();

	sessionStorage.removeItem("id");
	request.open("POST", "../Display/testdatabase.php", true);
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	request.onreadystatechange = function () {
	}
	request.send(data);
}