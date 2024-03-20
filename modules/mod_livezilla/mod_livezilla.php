<!-- Web-expert.gr LiveZilla AJAX Refresh Free Version -->
<?php
# Web-Expert.gr "LiveZilla Ajax Status" Module for Joomla! 1.5.x - Version 1.1 (free version)
# License: http://www.gnu.org/copyleft/gpl.html
# Copyright (c) 2006-2010 Web-Expert.gr
# More info at http://www.Web-Expert.gr
# Developers: Stergios Zgouletas

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
//GET Configuration
$moduleclass_sfx = $params->get( 'moduleclass_sfx','');
$folder = $params->get('folder', 'livezila');$width=$params->get('width', '600');
$height=$params->get('height', '550');$imageset= $params->get('imageset', '01');
$image_w= $params->get('imagew', '180');$image_h= $params->get('imageh', '45');
$tracking= $params->get('tracking', '1');$rs= (int)$params->get('rads', 50);
$site = JURI::root();$livezilla_path=$site.$folder."/";
$status=$site.$folder."/image.php?id=".$imageset;
?>
<script type="text/javascript">
function openChat() {URL ='<?php echo $livezilla_path."livezilla.php";?>';day = new Date();id = day.getTime();eval("livechatfree" + id + " = window.open(URL, '" + id + "', 'width=<?php echo $width;?>,height=<?php echo $height;?>,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes');");}</script>
<div id="status" class="livezilla_free<?php echo $moduleclass_sfx; ?>"><a alt="Click and Get Quick live support" href="javascript:openChat()"><img src="<?php echo $status;?>" width="<?php echo $image_w;?>" height="<?php echo $image_h;?>" border="0" alt="LiveChat Help" id="livechatbutton" /></a><?php if($rs*1000>30*1000) $sec=$rs*1000; else $sec=301000;?>
<script type="text/javascript">function reloadimage() {var myDate = new Date();img.src = '<?php echo $status;?>'+'&' + myDate.getTime();}if (document.getElementById) {var img = document.getElementById('livechatbutton');window.setInterval('reloadimage()',<?php echo $sec;?>);}</script><noscript>Javascript is disabled by your Browser. Enable and refresh, web-expert.gr</noscript></div><div style="font-size:9px;" align="center"><a target="_blank" href="http://web-expert.gr/" style="text-decoration: none">Developed by Web-expert.gr</a>
</div>
<?php if ($tracking==1){ ?>
<!-- Tracking Code -->
<div id="livezilla_tracking" style="display:none;"></div>
<script type="text/javascript">var script = document.createElement("script");script.type="text/javascript";var src = "<?php echo $livezilla_path;?>server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)",1);</script>
<!-- Tracking Code -->
<?php } ?>
<!-- Web-expert.gr LiveZilla AJAX Refresh Free Version -->