/**
 * File upload voor Message. 
 * @note html valideerd op .jpg, .jpeg, png 
 * @note js valideert op .jpg, .jpeg, png 
 * @todo send to database.
 *//*
var form = document.getElementById('submitfile');
var parentDiv = document.getElementById('result');

function validate_fileupload(fileName) 
{
    console.log(fileName);
    // input waardes die toegestaan zijn.
    var allowed_extensions = new Array("jpg", "jpeg", "png");

    // split function split op de(.)
    // pop function geeft het laatste element en geeft hierdoor de extentie
    // toLower functie maak de waarde naar kleine letters voor de validatie


*//**
 * Functie om de files weer te geven
 * @note het is een loop, en er kunnen meerdere foto's in gezet worden.
 *//*
function showImage() 
{
    // bug met uploaden 
    // als je de remove functie drukt ziet hij geen gebruiker meer
    for (let i = 0; i < window.localStorage.length; i++) 
    {
        let res = window.localStorage.getItem(window.localStorage.key(i));
        var image = new Image();
        image.src = res;
        parentDiv.appendChild(image);
    }
}
showImage();

*//**
 * Functie om alle files te verwijderen.
 * Verwijderd alle locale data.
 * @note Verwijderd dus ook ander data die bewaard wordt.
 *//*
function remove() 
{
    window.localStorage.clear();
    parentDiv.innerHTML = '';
}*/




// Upload file
function validate_fileupload(){

    var files = document.getElementById("fileupload").files;

    if (files.length > 0) {

        var formData = new FormData();
        formData.append("file", files[0]);

        var request = new XMLHttpRequest();

        // Set POST method and ajax file path
        request.open("POST", "./fileupload.php", true);

        // call on request changes state
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (request.responseText == 1) {
                    alert("Upload successfully.");
                } else {
                    alert("File not uploaded.");
                }
            }
        };

    } else {
        alert("Please select a file");
    }

}