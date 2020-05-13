<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sboard - Systeem</title>
    <?php include_once('head.php') ?>

</head>
<body>

<?php include_once('navigation.php') ?>


<div class="topMenuSecond">
    <div class="topMenuInner">
        <div class="topMenuTitle">Instellingen / <b>Systeem</b></div>
    </div>
</div>

<div class="content">

    <div class="contentBlock">

        <form id="form">
        <div class="inputs">
        <div class="description">Aantal seconden tussen dashboard items</div> <input required onkeyup="systemChanged(this)" class="contentInput" type="number" value="<?=$settings["DashboardSeconds"] ?>">

            <div class="description">Opties<br>
            <i onclick="toggleCheck(this)" data-enabled="<?=$settings["DashboardEnabled"] ?>" class="togglePermission mdi <?php if ($settings["DashboardEnabled"]=="1"): ?>mdi-check-circle<?php else: ?>mdi-circle-outline<?php endif; ?>"></i> Dashboard ingeschakeld</div>

        </div>
        </form>
        <button disabled onclick="systemSave(this)" class="button buttonSave" ><i class="mdi mdi-check"></i> Opgeslagen</button>

    </div>

</div>


</body>
</html>
