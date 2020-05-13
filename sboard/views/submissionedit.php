<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sboard - <?=htmlspecialchars($data["Title"], ENT_QUOTES)?></title>
    <?php include_once('head.php') ?>

</head>
<body onload="submissionLoaded()">

<?php include_once('navigation.php') ?>

<div class="topMenu">
    <div onclick="changeTab(this,'tab-edit')" class="topMenuItem topMenuItemSelected"><i class="mdi mdi-pencil"></i> Bewerken</div>
    <div onclick="changeTab(this,'tab-preview')" class="topMenuItem"><i class="mdi mdi-eye"></i> Voorbeeld</div>
</div>

<div class="content">
    <?php include_once('alert.php') ?>
    <div class="contentBlock tab tab-edit">
        <div class="inputs">
            <input onkeyup="submissionChanged(this)" maxlength="64" class="contentInput" value="<?=htmlspecialchars($data["Title"], ENT_QUOTES)?>" type="text">
            <div class="description">
                <button onclick="insertTable()" class="button-small" ><i class="mdi mdi-table"></i></button>
                <button onclick="insertAtCursor('<b>','</b>')" class="button-small" ><i class="mdi mdi-format-bold"></i></button>
                <button onclick="insertAtCursor('<i>','</i>')" class="button-small" ><i class="mdi mdi-format-italic"></i></button>
                <button onclick="insertAtCursor('<u>','</u>')" class="button-small" ><i class="mdi mdi-format-underline"></i></button>
                <button onclick="insertAtCursor('<mark>','</mark>')" class="button-small" ><i class="mdi mdi-marker"></i></button>
            </div>
            <textarea style="white-space: pre-wrap;" onkeyup="submissionChanged(this)" maxlength="5000" rows=20 class="contentInput"><?=$data["Body"]?></textarea>
        </div>

        <button onclick="window.location='/submissions'" class="button" ><i class="mdi mdi-arrow-left"></i> Terug</button>
        <button data-submissionid="<?=$data["SubmissionID"]?>" disabled onclick="submissionSave(this)" class="button buttonSave" ><i class="mdi mdi-check"></i> Opgeslagen</button>

        <button style="float: right" onclick="document.getElementById('file').click()" class="button" ><i class="mdi mdi-upload"></i> Foto uploaden</button>
        <input style="display: none;" id="file" type="file" data-id="<?=$data["SubmissionID"]?>" onchange="uploadFile(this)"/>
        <div style="display: none;" class="editImageTemplate">
                <button onclick="insertImage(this)" class="buttonRight button" ><i class="mdi mdi-plus"></i> </button>
                <button onclick="deleteFile(this)" class="buttonRightSmall button" ><i class="mdi mdi-delete"></i></button>
        </div>


        <div>
            <div class="editImages">
                <?php foreach ($attach as $file) : ?>
                    <div class="editImage">
                        <button data-url="/images/<?=$file["SubmissionID"]?>-<?=$file["Filename"]?>" onclick="insertImage(this)" class="buttonRight button" ><i class="mdi mdi-plus"></i> <?=$file["Filename"]?></button>
                        <button data-submissionid="<?=$file["SubmissionID"]?>" data-filename="<?=$file["Filename"]?>" onclick="deleteFile(this)" class="buttonRightSmall button" ><i class="mdi mdi-delete"></i></button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        </div>

    <div class="contentBlock tab tab-preview" style="display: none">
        <div class="contentBlockTitle previewTitle">Nieuw item</div>
        <div style="white-space: pre-wrap;" class="contentBlockDescription previewDesc"></div>
    </div>

</div>


</body>
</html>
