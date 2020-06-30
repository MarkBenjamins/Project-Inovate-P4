/**
 * File upload voor Message.
 * @note php op .jpg, .jpeg, png
 * @link wordt naar de database verzonden.
 */
function getImage()
{
    fileuploadform.addEventListener
    ('submit', (e) =>
    {
        var file = document.getElementById("fileupload").files[0];

        sendImage(file);
        sendToDB(file);
        e.preventDefault();
    }
    );
}

function sendImage(file)
{
    let request = new XMLHttpRequest();
    var formdata = new FormData();
    formdata.append('image', file);

    request.open("POST", "../Display/fileupload.php", true);
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        }
    }
    request.send(formdata);
}

function sendToDB(file)
{
    let id = sessionStorage.id.slice(0, sessionStorage.id.search("&"));
    let token = sessionStorage.id.slice(sessionStorage.id.search("&") + 1, sessionStorage.id.length);
    let name = file.name;
    let data = `id=${id}&token=${token}&name=${name}`;

    let request = new XMLHttpRequest();
    request.open("POST", "../Display/fileupload.php", true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(request.responseText);
        }
    }
    request.send(data);
}

function getJson()
{

}