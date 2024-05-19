<?php
$ScriptName = $_SERVER['SCRIPT_NAME'];
$arrMenu = array('最新消息','大會議題','大會組織','會議議程',
    '論文徵稿','線上報名','交通資訊');
$arrURL = array('announce.php','topics.php','organization.php','agenda.php',
    'papers.php','registration.php','transportation.php');
$MainTitle = '';
?>
	<div style="background-color:#061BB0;font-size:20px;font-weight:bold;">
    
	<div style="padding-left:5px;padding-top:10px;padding-bottom:10px">
<?php for ($i=0; $i<count($arrMenu); $i++) {
    $MenuText = $arrMenu[$i];
    $URL = $arrURL[$i];
    $Link = '<div class="menuBox"><a href="' . $URL . '" style="color:white">' . $MenuText . '</a></div>';
    if (strpos($ScriptName,$URL))  {
        $Link = '<div class="menuBox">'
            . '<a href="' . $URL . '" style="color:#ADADAD">' . $MenuText . '</a></div>';
        $MainTitle = $MenuText;
    }
?>
        <?php echo $Link; ?> 
<?php        
}
?>
	</div>
    </div>    

