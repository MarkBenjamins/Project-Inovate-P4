function getTime(){
    let today = new Date();
    let hr = today.getHours();
    let min = today.getMinutes();
    //let sec = today.getSeconds();
    let time = hr + ":" + min ;
    return time;
}