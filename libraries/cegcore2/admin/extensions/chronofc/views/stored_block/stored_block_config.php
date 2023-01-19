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
		<input type="hidden" value="stored_block" name="Connection[views][<?php echo $n; ?>][type]">
		
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
		
		<?php if(!empty($view['id'])): ?>
		<div class="field">
			<label><?php el('Block title'); ?></label>
			<select name="Connection[views][<?php echo $n; ?>][id]" class="ui fluid dropdown">
				<option value="">===</option>
				<?php foreach($this->get('blocks') as $block): ?>
					<?php if($block['Block']['type'] == 'views'): ?>
					<option value="<?php echo $block['Block']['id']; ?>"><?php echo $block['Block']['title']; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php else: ?>
		<div class="field">
			<label><?php el('Block title'); ?></label>
			<select name="Connection[views][<?php echo $n; ?>][block_id]" class="ui fluid dropdown">
				<option value="">===</option>
				<?php foreach($this->get('blocks') as $block): ?>
					<?php if(!empty($block['Block']['block_id']) AND $block['Block']['type'] == 'views'): ?>
					<option value="<?php echo $block['Block']['block_id']; ?>"><?php echo $block['Block']['title']; ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php endif; ?>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'views', 'n' => $n]); ?>
	</div>
	
	<button type="button" class="ui button compact red tiny close_config forms_conf forms_conf"><?php el('Close'); ?></button>
</div>