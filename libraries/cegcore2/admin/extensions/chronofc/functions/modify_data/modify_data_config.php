<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui segment tab functions-tab active" data-tab="function-<?php echo $n; ?>">

	<div class="ui top attached tabular menu small G2-tabs">
		<a class="item active" data-tab="function-<?php echo $n; ?>-general"><?php el('General'); ?></a>
		<a class="item" data-tab="function-<?php echo $n; ?>-permissions"><?php el('Permissions'); ?></a>
	</div>
	
	<div class="ui bottom attached tab segment active" data-tab="function-<?php echo $n; ?>-general">
		<input type="hidden" value="modify_data" name="Connection[functions][<?php echo $n; ?>][type]">
		
		<div class="two fields">
			<div class="field">
				<label><?php el('Name'); ?></label>
				<input type="text" value="" name="Connection[functions][<?php echo $n; ?>][name]">
			</div>
		</div>
		
		<div class="ui segment active" data-tab="function-<?php echo $n; ?>">
			
			<div class="field">
				<label><?php el('Data provider'); ?></label>
				<input type="text" value="" name="Connection[functions][<?php echo $n; ?>][data_provider]">
				<small><?php el('The source data set provider, can be left empty to start with an empty set.'); ?></small>
			</div>
			
			<div class="two fields">
				<div class="field">
					<label><?php el('Var type'); ?></label>
					<select name="Connection[functions][<?php echo $n; ?>][var_type]" class="ui fluid dropdown">
						<option value="var"><?php el('Variable'); ?></option>
						<option value="data"><?php el('Data'); ?></option>
						<option value="session"><?php el('Session'); ?></option>
					</select>
					<small><?php el('The new data set will be available under var, data or session ?'); ?></small>
				</div>
				
				<div class="field">
					<label><?php el('Var name'); ?></label>
					<input type="text" value="" name="Connection[functions][<?php echo $n; ?>][var_name]">
					<small><?php el('Under which name the new data set will be available ?'); ?></small>
				</div>
			</div>
			
			<div class="field required">
				<label><?php el('Data override'); ?></label>
				<textarea placeholder="<?php el('Multiline list of array fields'); ?>" name="Connection[functions][<?php echo $n; ?>][data_override]" rows="15"></textarea>
				<small><?php el('Multi line list of key:value pairs (or values only) to be included in the final set.'); ?></small>
			</div>
			
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="function-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'functions', 'n' => $n]); ?>
	</div>
	
</div>