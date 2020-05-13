<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sboard - <?=htmlspecialchars($data["Title"], ENT_QUOTES)?></title>
    <?php include_once('head.php') ?>

</head>
<body>

<?php include_once('navigation.php') ?>

<div class="topMenuSecond">
    <div class="topMenuInner">
        <div class="topMenuTitle">Voorbeeld / <b><?=$data["Title"]?></b></div>
    </div>
</div>

<div class="content">

    <div class="contentBlock">
        <div class="contentBlockTitle previewTitle"><?=htmlspecialchars($data["Title"], ENT_QUOTES)?></div>
        <div style="white-space: pre-wrap;" class="contentBlockDescription previewDesc"><?=$data["Body"]?></div><br>
        <div class="gauge gaugeSmall"><i class="mdi mdi-calendar"></i> <?=(new DateTime($data["Date"]))->format('j M Y H:i')?></div>
    </div>

    <div class="contentBlock">
        <div style="<?php if($data["Image"]!=""): ?>  background-image: url('/images/<?=$data["Image"]?>'); font-size: 0px;  <?php endif; ?>" class="UserImage"><?=$data["NameCode"]?></div> <div class="userName"><?=$data["Firstname"]?> <?=$data["Lastname"]?></div>

    </div>

</div>


</body>
</html>
