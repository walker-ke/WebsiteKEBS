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
		<input type="hidden" value="switch_events" name="Connection[functions][<?php echo $n; ?>][type]">
		
		<div class="two fields advanced_conf">
			<div class="field">
				<label><?php el('Name'); ?></label>
				<input type="text" value="" name="Connection[functions][<?php echo $n; ?>][name]" class="function_name">
			</div>
		</div>
		
		
		<div class="ui segment active" data-tab="function-<?php echo $n; ?>">
			
			<div class="two fields">
				<div class="field required">
					<label><?php el('Data provider'); ?></label>
					<input type="text" value="" name="Connection[functions][<?php echo $n; ?>][data_provider]">
					<small><?php el('The source data to use for switching, can be a data command for example, {data:field_name}'); ?></small>
				</div>
			</div>
			
			<div class="field">
				<label><?php el('Events'); ?></label>
				<!--<input type="text" value="A,B" name="Connection[functions][<?php echo $n; ?>][events]" class="events_list">-->
				<textarea name="Connection[functions][<?php echo $n; ?>][events]" rows="5" class="events_list"><?php echo "A\nB"; ?></textarea>
				<small><?php el('multi line list of expected values from the data source above, each value will run a different event, values can be passed as regular expressions, e.g: event_name:/[a-z]+/, * matches any value.'); ?></small>
			</div>
			
			<button type="button" class="ui button small refresh_dragged" data-block="function" data-url="<?php echo r2('index.php?ext=chronoforms&cont=connections&act=refresh_element&tvout=view'); ?>"><?php el('Update events'); ?></button>
			<input type="hidden" name="Connection[functions][<?php echo $n; ?>][_version]" value="2" />
		</div>
		
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="function-<?php echo $n; ?>-permissions">
		<?php $this->view('views.config_permissions', ['type' => 'functions', 'n' => $n]); ?>
	</div>
	
</div>