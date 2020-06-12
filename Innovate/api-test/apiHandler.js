function apiHandler(name, password)
{
    let Login = {
        username = name,
        password = password
    };

    $.ajax({
        type: POST,
        url: "./restHandler.php",
        data: Login,
        success: function (res) {
            let jsonData = JSON.parse(res);

            if (jsonData.success === false) {
                console.log("ERROR");

            }
            else
            {
                console.log("gelukt");
            }
        }
    })

}