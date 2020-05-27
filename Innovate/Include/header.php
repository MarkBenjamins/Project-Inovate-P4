<!DOCTYPE html>
<?php
    include "../display/weerbericht.php";
?>

<html lang="en">
    <head>
        <link rel="stylesheet" href="../Css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../Css/style.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="../img/logo.ico" /> 
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="30">
        <meta name="description" content="Project innovate INF1C">
        <meta name="author" content=
            "Tessa Ramaker,
            Mark Benjamins,
            Koen Somsen,
            Jenny van Engelenburg,
            Arjan Vijn,
            Niels Exel,
            Daniël Roosken,
            Storm Visser"
        >
        <title></title>
    </head>

    <body>
        
        <div class="row header">
            <div class="col-2 white">
                <h2>10:00</h2>
            </div>
            <div class="col-1 white">	
                <p class="weather-icon">
					<img src="<?php echo "../img/iconen-weerlive/" . $current->image . ".png";?>">
                </p>
                <p><?php echo $temperatuur;?> °C</p>
            </div>
            <div class="col-6 white">
                <h2>Maandag 25 juni, weeknr. 23</h2>
            </div>
            <div class="col-1">
                <button class="darkmode"><img src="" alt=""></button>
            </div>
        </div>