<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui segment tab views-tab active" data-tab="view-<?php echo $n; ?>">
	
	<div class="ui top attached tabular menu small G2-tabs">
		<a class="item active" data-tab="view-<?php echo $n; ?>-general"><?php el('General'); ?></a>
		<a class="item" data-tab="view-<?php echo $n; ?>-advanced"><?php el('Advanced'); ?></a>
		<a class="item" data-tab="view-<?php echo $n; ?>-events"><?php el('Events'); ?></a>
		<a class="item" data-tab="view-<?php echo $n; ?>-permissions"><?php el('Permissions'); ?></a>
	</div>
	
	<div class="ui bottom attached tab segment active" data-tab="view-<?php echo $n; ?>-general">
		<input type="hidden" value="field_link" name="Connection[views][<?php echo $n; ?>][type]">
		
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
		
		<div class="field">
			<label><?php el('Content'); ?></label>
			<input type="text" value="Click here" name="Connection[views][<?php echo $n; ?>][content]">
			<small><?php el('The link text or content'); ?></small>
		</div>

		<div class="two fields">
			<div class="eight wide field">
				<label><?php el('Class'); ?></label>
				<input type="text" value="ui button" name="Connection[views][<?php echo $n; ?>][class]">
			</div>
			<div class="four wide field">
				<label><?php el('Color'); ?></label>
				<input type="text" value="green" name="Connection[views][<?php echo $n; ?>][color]">
			</div>
			<div class="four wide field">
				<label><?php el('ID'); ?></label>
				<input type="text" value="link<?php echo $n; ?>" name="Connection[views][<?php echo $n; ?>][params][id]">
			</div>
		</div>
		
		<div class="field">
			<label><?php el('Event'); ?></label>
			<input type="text" value="" name="Connection[views][<?php echo $n; ?>][event]">
			<small><?php el('A form event name to link to'); ?></small>
		</div>
		
		<div class="field">
			<label><?php el('URL and/or URL parameters'); ?></label>
			<input type="text" value="" name="Connection[views][<?php echo $n; ?>][params][href]">
			<small><?php el('A fully qualified url or key=val pairs to include in the link url.'); ?></small>
		</div>
		
		<div class="field">
			<label><?php el('Target'); ?></label>
			<select name="Connection[views][<?php echo $n; ?>][target]" class="ui fluid dropdown">
				<option value=""><?php el('Parent'); ?></option>
				<option value="_blank"><?php el('New page'); ?></option>
			</select>
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-advanced">
		
		<div class="field">
			<label><?php el('Extra attributes'); ?></label>
			<textarea name="Connection[views][<?php echo $n; ?>][attrs]" rows="3"></textarea>
		</div>
		
		<div class="two fields">
			<div class="field">
				<label><?php el('Container class'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][container][class]">
			</div>
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-events">
		
		<div class="field">
			<label><?php el('On Click'); ?></label>
			<select name="Connection[views][<?php echo $n; ?>][actions][type]" class="ui fluid dropdown">
				<option value=""><?php el('Default behavior'); ?></option>
				<option value="dynamic-load"><?php el('Load new content'); ?></option>
				<option value="static-remove"><?php el('Remove closest matching element'); ?></option>
			</select>
		</div>
		
		<div class="ui header dividing"><?php el('New content settings'); ?></div>
		
		<div class="three fields">
			<div class="field">
				<label><?php el('Event'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][actions][dynamic-load][event]">
			</div>
			
			<div class="field">
				<label><?php el('Result'); ?></label>
				<input type="text" value="before/self" name="Connection[views][<?php echo $n; ?>][actions][dynamic-load][result]">
			</div>
			
			<div class="field">
				<label><?php el('Counter provider'); ?></label>
				<input type="text" value="" name="Connection[views][<?php echo $n; ?>][actions][dynamic-load][counter]">
			</div>
		</div>
		
		<div class="ui header dividing"><?php el('Remove content settings'); ?></div>
		
		<div class="two fields">
			<div class="field">
				<label><?php el('Target element'); ?></label>
				<input type="text" value="closest:div.ui.form" name="Connection[views][<?php echo $n; ?>][actions][static-remove][task]">
			</div>
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="view-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'views', 'n' => $n]); ?>
	</div>
	
	<button type="button" class="ui button compact red tiny close_config forms_conf"><?php el('Close'); ?></button>
</div>