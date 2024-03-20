<?php

/**
 * @package         Convert Forms
 * @version         3.1.1 Free
 * 
 * @author          Tassos Marinos <info@tassos.gr>
 * @link            http://www.tassos.gr
 * @copyright       Copyright © 2020 Tassos Marinos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
*/

defined('_JEXEC') or die('Restricted access');

extract($displayData);

?>

<div <?php echo trim($boxattributes) ?> data-id="<?php echo $id ?>">
	<form name="cf<?php echo $id; ?>" id="cf<?php echo $id; ?>" method="post" action="#">
		<?php if ($hascontent) { ?>
		<div class="cf-content-wrap cf-col-16 <?php echo $contentclasses ?>">
			<div class="cf-content cf-col-16">
				<?php if (isset($image)) { ?>
					<div class="cf-content-img cf-col-16 cf-text-center <?php echo $imagecontainerclasses; ?>">
						<img 
							alt="<?php echo $params->get("imagealt"); ?>"
							class="<?php echo implode(" ", $imageclasses) ?>" 
							style="<?php echo implode(";", $imagestyles) ?>"
							src="<?php echo $image ?>"
						/>
					</div>
				<?php } ?>
				<?php if (!$textIsEmpty) { ?>
				<div class="cf-content-text cf-col <?php echo $textcontainerclasses; ?>" >
					<?php echo $params->get("text"); ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<div class="cf-form-wrap cf-col-16 <?php echo implode(" ", $formclasses) ?>" style="<?php echo implode(";", $formstyles) ?>">
			<div class="cf-response"></div>
			
			<?php if (isset($fields_prepare)) { ?>
				<div class="cf-fields">
					<?php echo $fields_prepare; ?>
				</div>
			<?php } ?>

			<?php if (!$footerIsEmpty) { ?>
			<div class="cf-footer">
				<?php echo $params->get("footer"); ?>
			</div>
			<?php } ?>
		</div>

		<input type="hidden" name="cf[form_id]" value="<?php echo $id ?>">

		<?php 
			echo JHtml::_('form.token'); 

			if (JFactory::getApplication()->isClient('site'))
			{
				echo $params->get('customcode', '');
			}
		?>
		
		<?php if ((bool) $params->get('honeypot', true)) { ?>
			<div class="cf-field-hp">
				<?php 
					$hp_id = 'cf-field-' . uniqid();
					$labels = ['Name', 'First Name', 'Last Name', 'Email', 'Phone', 'Website', 'Message'];
					$label = $labels[array_rand($labels)];
				?>
				<label for="<?php echo $hp_id; ?>" class="cf-label"><?php echo $label; ?></label>
				<input type="text" name="cf[hnpt]" id="<?php echo $hp_id; ?>" autocomplete="off" class="cf-input"/>
			</div>
		<?php } ?>
	</form>
	<?php
		if (JFactory::getApplication()->isClient('site'))
		{
			JFactory::getDocument()->addStyleDeclaration($params->get('customcss'));
		} else {
			// Help user style the form in the backend as well. 
			echo '<style>' . $params->get('customcss') . '</style>';
		}
	?>
</div>