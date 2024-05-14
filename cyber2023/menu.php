<?php
/*
$ScriptName = $_SERVER['SCRIPT_NAME'];
$arrMenu = array('最新消息','大會議題','大會組織','會議議程','講者介紹',
    '論文徵稿','線上報名','交通資訊','合作單位','歷年研討會');//'11/19資安競賽DM','回主頁');
$arrURL = array('announce.php','topics.php','organization.php','agenda.php',
    'keynote.php','papers.php','registration.php',
    'transportation.php','sponser.php','years.php');//'dm.php','index.php');
$MainTitle = '';
*/
$ScriptName = $_SERVER['SCRIPT_NAME'];
$arrMenu = array('最新消息','大會議題','大會組織','會議議程',
    '論文徵稿','線上報名','交通資訊','合作單位','歷年研討會');
$arrURL = array('announce.php','topics.php','organization.php','agenda.php',
    'papers.php','registration.php','transportation.php','sponser.php','years.php');
$MainTitle = '';
?>
	<div style="background-color:#061BB0;font-size:20px;font-weight:bold;">
    
	<div style="padding-left:5px;padding-top:10px;padding-bottom:10px">
<?php for ($i=0; $i<count($arrMenu); $i++) {
    $MenuText = $arrMenu[$i];
    $URL = $arrURL[$i];
    $Link = '<div class="menuBox"><a href="' . $URL . '" style="color:white">' . $MenuText . '</a></div>';
//    $Active = '';
    if (strpos($ScriptName,$URL))  {
        $Link = '<div class="menuBox">'
            . '<a href="' . $URL . '" style="color:#ADADAD">' . $MenuText . '</a></div>';
        $MainTitle = $MenuText;
    }
//        $Active = ' style="background-color:#D0FA58;font-size:22px;"';
?>
        <?php echo $Link; ?> 
<?php        
}
?>
	</div>
    </div>    
    <!--<div class="maintitle" style="margin-bottom:10px;">
    <?php //echo $MainTitle; ?>
    </div>-->
