<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	if(!empty($view['id'])){
		echo $this->Parser->block((int)$view['id']);
	}else if(!empty($view['block_id'])){
		echo $this->Parser->block($view['block_id']);
	}