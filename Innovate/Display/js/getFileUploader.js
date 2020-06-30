/**
 * File upload voor Message.
 * @note php op .jpg, .jpeg, png
 * @link wordt naar de database verzonden.
 */
function sendimage()
{
    fileuploadform.addEventListener
    ('submit', (e) =>
    {
        var file = document.getElementById("fileupload").files[0];
        let request = new XMLHttpRequest();
        var formdata = new FormData();
        formdata.append('image', file);

        request.open("POST", "../Display/fileupload.php", true);
        request.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                alert(request.responseText);
            }
        }
        request.send(formdata);
        e.preventDefault();
    }
    );
}