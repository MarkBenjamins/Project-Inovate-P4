let username = document.getElementById('name')
const password = document.getElementById('password')
const formLogin = document.getElementById('form')


formLogin.addEventListener
	('submit', (e) =>
		{
		console.log(username + password);

		e.preventDefault()

		let getLogin = "getlogin";

		let loginArray = "{ username=" + username + " } & { password" + password + " }";

			console.log(typeof loginArray.password);

		}
	)
