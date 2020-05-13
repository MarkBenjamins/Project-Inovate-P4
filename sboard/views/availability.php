<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sboard</title>
    <?php include_once('head.php') ?>

</head>
<body>

<?php include_once('navigation.php') ?>

<div class="topMenuSecond">
    <div class="topMenuInner">
        <div class="topMenuTitle">Overzicht / <b>beschikbaarheid</b></div>
    </div>
</div>

<div class="content">
    <div class="contentBlock">
        <div class="contentBlockTitle">Huidige beschikbaarheid</div>
        <div class="description">Aanpassingen worden direct zichtbaar</div>

        <button onclick="updateAV(this,'AU')" <?php if ($data[0]["AMode"]=="AU"): ?>disabled<?php endif; ?> class="button AVButton"><i class="mdi <?php if ($data[0]["AMode"]=="AU"): ?>mdi-check-circle<?php else: ?>mdi-circle<?php endif; ?>"></i> Automatisch</button>
        <button onclick="updateAV(this,'AV')" <?php if ($data[0]["AMode"]=="AV"): ?>disabled<?php endif; ?> class="button AVButton"><i class="mdi <?php if ($data[0]["AMode"]=="AV"): ?>mdi-check-circle<?php else: ?>mdi-circle<?php endif; ?>"></i> Beschikbaar</button>
        <button onclick="updateAV(this,'NA')" <?php if ($data[0]["AMode"]=="NA"): ?>disabled<?php endif; ?> class="button AVButton"><i class="mdi <?php if ($data[0]["AMode"]=="NA"): ?>mdi-check-circle<?php else: ?>mdi-circle<?php endif; ?>"></i> Niet Beschikbaar</button>
    </div>

    <div class="contentBlock">
        <div class="contentBlockTitle">Wijzig automatische beschikbaarheid</div>
        <div class="description">Kies op welke dagen en tijdstippen je beschikbaar bent. Klik op een dag om deze in of uit te schakelen</div>

        <?php foreach ($data as $day) : ?>
    <div class="contentBlock contentBlockSmall">
        <div class="contentBlockTitle"><?=$days[$day["DayOfWeek"]] ?> <i data-enabled="<?=$day["Enabled"] ?>" onclick="updateDay(this,<?=$day["DayOfWeek"] ?>)" class="mdi <?php if ($day["Enabled"]=="1"): ?>mdi-check-circle<?php else: ?>mdi-circle-outline<?php endif; ?> contentButtonRight"></i></div>
        <input onchange="leadingZero(this); updateDAV(this,<?=$day["DayOfWeek"] ?>)" onblur="updateDAV(this,<?=$day["DayOfWeek"] ?>)" class="inputNumber gauge gaugeSmall " type="number" min="0" max="23" value="<?=explode(":",$day["StartTime"])[0]?>"> :
        <input onchange="leadingZero(this); updateDAV(this,<?=$day["DayOfWeek"] ?>)" onblur="updateDAV(this,<?=$day["DayOfWeek"] ?>)" class="inputNumber gauge gaugeSmall " type="number" min="0" max="59" value="<?=explode(":",$day["StartTime"])[1]?>">
-
        <input onchange="leadingZero(this); updateDAV(this,<?=$day["DayOfWeek"] ?>)" onblur="updateDAV(this,<?=$day["DayOfWeek"] ?>)" class="inputNumber gauge gaugeSmall " type="number" min="0" max="23" value="<?=explode(":",$day["EndTime"])[0]?>"> :
        <input onchange="leadingZero(this); updateDAV(this,<?=$day["DayOfWeek"] ?>)" onblur="updateDAV(this,<?=$day["DayOfWeek"] ?>)" class="inputNumber gauge gaugeSmall " type="number" min="0" max="59" value="<?=explode(":",$day["EndTime"])[1]?>">
    </div>
        <?php endforeach; ?>
</div>


</body>
</html>
