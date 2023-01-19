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
		<input type="hidden" value="divider" name="Connection[views][<?php echo $n; ?>][type]">
		
		<div class="two fields advanced_conf">
			<div class="field">
				<label><?php el('Name'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][name]">
			</div>
			<div class="field">
				<label><?php el('Category'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][category]">
			</div>
		</div>
		
		<div class="two fields">
			<div class="four field easy_disabled">
				<label><?php el('Tag'); ?></label>
				<input type="text" value="div" name="Connection[views][<?php echo $n; ?>][tag]">
				<small><?php el('The divider element tag.'); ?></small>
			</div>
			
			<div class="twelve wide field">
				<label><?php el('Content'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][text]">
				<small><?php el('Text used in the divider.'); ?></small>
			</div>
		</div>
		
		<div class="equal width fields">
			<div class="field">
				<div class="ui checkbox toggle">
					<input type="hidden" name="Connection[views][<?php echo $n; ?>][hidden]" data-ghost="1" value="">
					<input type="checkbox" class="hidden" name="Connection[views][<?php echo $n; ?>][hidden]" value="1">
					<label><?php el('Hidden'); ?></label>
					<small><?php el('Hide the divider line but keep the space'); ?></small>
				</div>
			</div>
			
			<div class="field">
				<div class="ui checkbox toggle">
					<input type="hidden" name="Connection[views][<?php echo $n; ?>][section]" data-ghost="1" value="">
					<input type="checkbox" class="hidden" name="Connection[views][<?php echo $n; ?>][section]" value="1">
					<label><?php el('Section divider'); ?></label>
					<small><?php el('Increase the margins around the divider'); ?></small>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'views', 'n' => $n]); ?>
	</div>
	
	<button type="button" class="ui button compact red tiny close_config forms_conf forms_conf"><?php el('Close'); ?></button>
</div>