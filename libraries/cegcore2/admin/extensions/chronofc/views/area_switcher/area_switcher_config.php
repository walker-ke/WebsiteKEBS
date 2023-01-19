<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui segment tab views-tab active" data-tab="view-<?php echo $n; ?>">
	
	<div class="ui top attached tabular menu small G2-tabs">
		<a class="item active" data-tab="view-<?php echo $n; ?>-general"><?php el('General'); ?></a>
		<a class="item" data-tab="view-<?php echo $n; ?>-permissions"><?php el('Permissions'); ?></a>
	</div>
	
	<div class="ui bottom attached tab segment active" data-tab="view-<?php echo $n; ?>-general">
		<input type="hidden" value="area_switcher" name="Connection[views][<?php echo $n; ?>][type]">
		
		<div class="two fields advanced_conf">
			<div class="field">
				<label><?php el('Name'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][name]" class="view_name">
			</div>
			<div class="field">
				<label><?php el('Category'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][category]">
			</div>
		</div>
		
		<div class="field">
			<label><?php el('Data provider'); ?></label>
			<input type="text" value="" name="Connection[views][<?php echo $n; ?>][data_provider]">
			<small><?php el('The source data to use for switching, can be a data command for example, {data:field_name}'); ?></small>
		</div>
		
		<div class="field">
			<label><?php el('Values list'); ?></label>
			<textarea name="Connection[views][<?php echo $n; ?>][sections]" class="sections_list"><?php echo "0\n1"; ?></textarea>
		</div>
		<!--
		<button type="button" class="ui button small" onclick="area_partitions_add_columns(this, <?php echo $n; ?>);"><?php el('Update partitions'); ?></button>
		-->
		<button type="button" class="ui button small refresh_dragged" data-block="view" data-url="<?php echo r2('index.php?ext=chronoforms&cont=connections&act=refresh_element&tvout=view'); ?>"><?php el('Update areas'); ?></button>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'views', 'n' => $n]); ?>
	</div>
	
	<button type="button" class="ui button compact red tiny close_config forms_conf"><?php el('Close'); ?></button>
</div>