<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	if(!empty($function['id'])){
		echo $this->Parser->block((int)$function['id']);
	}else if(!empty($function['block_id'])){
		echo $this->Parser->block($function['block_id']);
	}