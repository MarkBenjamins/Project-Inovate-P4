<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="Css/bootstrap-grid.css" type="text/css">
        <link rel="stylesheet" href="Css/style.css" type="text/css">
        <meta charset="UTF-8">
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
        <?php
        /*  Huidige tijd, datum en weeknummer.
            Wordt alleen geupdate wanneer de pagina gerefreshed wordt.*/
        $time = date("H:i");
        $date = date("l, j F Y");
        $week = date("W");
        ?>
        <div class="row header">
            <div class="col-2 white">
                <h2><?php echo $time; ?></h2>
            </div>
            <div class="col-1 white">
                <h2>zon</h2>
            </div>
            <div class="col-6 white">
                <h2><?php echo $date . " weeknr ". $week; ?></h2>
            </div>
            <div class="col-1">
                <button class="darkmode"><img src="" alt=""></button>
            </div>
        </div>

