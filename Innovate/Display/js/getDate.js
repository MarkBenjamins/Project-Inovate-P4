function getCurrentDate(){
    let today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();
    let day = today.getDate();
    let date = year + "/" + month + "/" + day;
    return date;
}