<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sboard</title>
    <?php include_once('head.php') ?>

</head>
<body>

<?php include_once('navigation.php') ?>


<div class="topMenu">
    <div onclick="changeTab(this,'tab-all')" class="topMenuItem topMenuItemSelected"><i class="mdi mdi-circle"></i> Alle items</div>
    <div onclick="changeTab(this,'tab-own')" class="topMenuItem"><i class="mdi mdi-account-circle"></i> Eigen items</div>
</div>

<div class="content">
    <div class="contentBlock">
        <div class="description">Beheer de items die op het dashboard worden weergegeven.</div>
    <button onclick="submissionAdd(this)" class="button" ><i class="mdi mdi-playlist-plus"></i> Item toevoegen</button>

    </div>

    <?php include_once('alert.php') ?>

    <!-- Show all the items-->
    <div class="contentBlock tab tab-all">
        <?php foreach ($data as $submission) : ?>
        <div onclick="window.location='submission/<?=$submission['SubmissionID']?>'" class="contentBlock cursorhand">

            <div style="<?php if($submission["Image"]!=""): ?>  background-image: url('/images/<?=$submission["Image"]?>'); font-size: 0px;  <?php endif; ?>"  class="UserImage"><?=$submission["NameCode"]?></div> 
            
            <div class="userName"><?=$submission["Firstname"]?> <?=$submission["Lastname"]?></div>
            
            <div class="contentBlockTitle"><?=htmlspecialchars($submission["Title"], ENT_QUOTES)?></div>
            
            <div>
                <?php if($_SESSION["UserData"]["Admin"] == "1")
                {
                ?>
                <!-- Sequence number, with up and down buttons -->
                <div class="gauge gaugeSmall" style="background-color:#FFF">
                    
                    <a href="submissions/countDown/?id=<?=$submission['SubmissionID']?>" title="Sequence - 1" data-toggle="tooltip">
                        <i class="mdi mdi-minus"></i>
                    </a>
                        <?php echo $submission['Sequence']; ?>
                    <a href="submissions/countUp/?id=<?=$submission['SubmissionID']?>" title="Sequence + 1" data-toggle="tooltip">
                        <i class="mdi mdi-plus"></i>
                    </a>
                    
                </div>
                <?php
                }
                ?>

                <div class="gauge gaugeSmall"><?=(new DateTime($submission["Date"]))->format('j M Y - H:i')?></div>
                
                <?php if($submission["UserID"] == $_SESSION["UserData"]["UserID"] || $_SESSION["UserData"]["Admin"] == "1"): ?>
                    <a onclick="confirmbox('Weet je zeker dat je \'<?=$submission["Title"]?>\' wilt verwijderen?','submissions/delete/?id=<?=$submission["SubmissionID"]?>',event); event.stopPropagation();">
                        <div class="deleteButton"><i class="mdi mdi-delete "></i></div>
                    </a>
                    <a href="edit/<?=$submission["SubmissionID"]?>">
                        <div class="hideButton"><i class="mdi mdi-pencil "></i></div>                        
                    </a>
                <?php endif; ?>

                <div data-id='<?=$submission["SubmissionID"]?>' data-visible='<?=$submission["Visible"]?>' onclick="updateVisible(this); event.stopPropagation();" class="hideButton <?php if($_SESSION["UserData"]["Admin"] == "0" && $_SESSION["UserData"]["Publish"] == "0"): ?>hideButtonDisabled<?php endif;?>">
                    <?php if ($submission["Visible"]=="1"): ?><i class="mdi mdi-eye "></i><?php else: ?><i class="mdi mdi-eye-off"></i><?php endif; ?>
                </div>

            </div>

        </div>
        <?php endforeach; ?>
    </div>

    <!-- Show only your own items-->
    <div style="display: none; "class="contentBlock tab tab-own">
        <?php foreach ($dataUser as $submission) : ?>
        <div onclick="window.location='submission/<?=$submission["SubmissionID"]?>'" class="contentBlock cursorhand">

            <div style="<?php if($submission["Image"]!=""): ?>  background-image: url('/images/<?=$submission["Image"]?>'); font-size: 0px;  <?php endif; ?>" class="UserImage"><?=$submission["NameCode"]?></div> <div class="userName"><?=$submission["Firstname"]?> <?=$submission["Lastname"]?></div>
            
            <div class="contentBlockTitle"><?=htmlspecialchars($submission["Title"], ENT_QUOTES)?></div>

            <div>
                <div class="gauge gaugeSmall"><?=(new DateTime($submission["Date"]))->format('j M Y - H:i')?></div>
            
                <?php if($submission["UserID"] == $_SESSION["UserData"]["UserID"] || $_SESSION["UserData"]["Admin"] == "1"): ?>
                    <a onclick="confirmbox('Weet je zeker dat je \'<?=$submission["Title"]?>\' wilt verwijderen?','submissions/delete/?id=<?=$submission["SubmissionID"]?>',event); event.stopPropagation();">
                        <div class="deleteButton"><i class="mdi mdi-delete "></i></div>
                    </a>
                    <a href="edit/<?=$submission["SubmissionID"]?>">
                        <div class="hideButton"><i class="mdi mdi-pencil "></i></div>
                    </a>
                <?php endif; ?>
                
                <div data-id='<?=$submission["SubmissionID"]?>' data-visible='<?=$submission["Visible"]?>' onclick="updateVisible(this); event.stopPropagation();" class="hideButton <?php if( $_SESSION["UserData"]["Admin"] == "0" && $_SESSION["UserData"]["Publish"] == "0"): ?>hideButtonDisabled<?php endif;?>">
                    <?php if ($submission["Visible"]=="1"): ?><i class="mdi mdi-eye "></i><?php else: ?><i class="mdi mdi-eye-off"></i><?php endif; ?>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>

</div>


</body>
</html>
