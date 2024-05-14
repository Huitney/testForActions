<?php
require_once('header.php');
require_once('bodytop.php');
$arrSponsers_2023 = array(
'國家科學及技術委員會科技辦公室'=>'bost.png;180;https://www.nstc.gov.tw/',
'臺北市政府資訊局'=>'doit.png;300;https://doit.gov.taipei',
'中央研究院資訊科技創新研究中心'=>'citi.png;140;https://www.citi.sinica.edu.tw/',
'資訊工業策進會資安科技研究所'=>'csti.png;300;https://www.iii.org.tw/About/Department.aspx?fm_sqno=36&dp_sqno=7',
'財團法人國家實驗研究院<br>國家高速網路與計算中心'=>'nchc.png;160;https://www.nchc.org.tw',
'元盾資安股份有限公司'=>'mss2.png;200;https://www.mss.com.tw/',
'捕夢網數位科技有限公司'=>'pumo.png;220;https://www.pumo.com.tw/www/',
'Fortinet'=>'fortinet.jpg;180;https://www.fortinet.com/tw',
'藍新資訊股份有限公司'=>'neweb.png;300;http://www.newebinfo.com.tw/index_tw.php',
'台灣微軟股份有限公司'=>'microsoft.png;260;https://www.microsoft.com/zh-tw/abouttaiwan',
'國興資訊股份有限公司'=>'ks.png;260;https://www.ksi.com.tw/',
'桓基科技股份有限公司'=>'HGiga.png;260;https://www.hgiga.com/',
'創泓科技股份有限公司'=>'uniforce2.png;260;https://www.uniforce.com.tw/',
'Palo Alto Networks'=>'zeroone1.png;300;https://www.paloaltonetworks.tw/',
'國立臺北科技大學'=>'ntut.jpg;260;https://www.ntut.edu.tw/',
'安華聯網科技股份有限公司'=>'onward.jpg;200;https://secpaas.org.tw/onwardsecurity/',
'凌群電腦股份有限公司'=>'syscom.jpg;260;https://www.syscom.com.tw',
'中華資安國際股份有限公司'=>'CHTS.png;260;https://www.chtsecurity.com/',
'台灣智慧光網股份有限公司'=>'taifo2.png;220;https://www.taifo.com.tw',
'TWNIC財團法人台灣網路資訊中心'=>'twnic.png;300;https://www.twnic.tw/',
'趨勢科技股份有限公司'=>'trendmicro2.png;260;https://www.trendmicro.com/zh_tw/business.html',
'中華電信網路技術分公司'=>'cht.jpg;260;https://www.cht.com.tw/zh-tw/home/cht/about-cht/business-group/organization/network-technology-group',
'永豐盈國際有限公司'=>'fwgc2.jpg;220;https://www.foreverwealth.com.tw/',
'全景軟體股份有限公司'=>'changingtec.png;260;https://www.changingtec.com/',
'Noname Security'=>'Noname.png;260;https://nonamesecurity.com/',
'財團法人台灣科技管理教育基金會'=>'Sponser.png',
'威劼科技有限公司'=>'wetrix.jpg;260;https://www.wetrix.com.tw/',
'宏碁資訊服務股份有限公司'=>'aceraeb.png;260;https://www.aceraeb.com/mainssl/modules/MySpace/index.php?=&sn=acer&pg=ZC91362',
'高田科技有限公司'=>'kao_logo2.png;260;https://www.kaoten.com/',
);
?>
<div style="font-size:18px;margin:6px auto;text-align:center;">
<?php 
foreach ($arrSponsers_2023 AS $Sponser=>$Links) {
    $temp = explode(';',$Links);
    $Link = 'sponser.php';
    $imgWidth=180;
    $Img = $temp[0];
    $HasLink = FALSE;
    if (count($temp)>=2) $imgWidth = $temp[1];
    if (count($temp)==3) { $Link = $temp[2]; $HasLink = TRUE; }
?>
<div style="display:inline-block;height:180px;">
    <div style="width:350px">
      <img src="sponser_logo/<?php echo $Img; ?>" style="width:<?php echo $imgWidth; ?>px;"><br>
<?php if ($HasLink) { ?>      
      <a href="<?php echo $Link; ?>" target="Sponser"><?php echo $Sponser; ?></a>
<?php } else { echo $Sponser; } ?>
    </div>
</div>
<?php } ?>
</div>

<?php
require_once('footer.php');
?>
