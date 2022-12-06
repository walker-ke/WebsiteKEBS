<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument(); ?>

<script type="text/javascript">
	var artDataSearch = "<?php echo $this->state->get('art_data_search'); ?>";
</script>
<div class="art-data-body">

	<?php
	$input = JFactory::getApplication()->input;
	//if a notification is needed
	if ($input->getString('action')) {
		echo ArtDataHelper::getArtDataNotification($input->getString('action'));
	} ?>


	<ul class="uk-tab" data-uk-tab>
	    <li class="uk-active" id="art-data-templates-table-tab"><a href="javascript:void(0);" onclick="toggleTableTab()"><i class="uk-icon-table"></i> Table Templates</a></li>
	    <li id="art-data-templates-chart-tab"><a href="javascript:void(0);" onclick="toggleChartTab()"><i class="uk-icon-pie-chart"></i> Chart Templates</a></li>
	</ul>

	<div id="art-data-templates-table-content">
		
		<table class="uk-table uk-table-striped uk-table-hover">
			<thead>
				<tr>
					<th>
						<?php echo JText::_( 'Name' ); ?>
					</th> 													  																								
		            <th>
		            	<?php echo JText::_( 'Type' ); ?>
		            </th>
		            <th>
		            	<?php echo JText::_( 'Palette' ); ?>
		            </th>
		            <th class="uk-text-center"></th>					            					            			            
		            <th class="uk-text-center"></th>							            	            
				</tr>
			</thead>
			<tbody id="art-data-sortable">
			<?php

			if (count($this->table_items) > 0) {

				foreach ($this->table_items as $i => $item) { ?>

					<tr>
						<td>
							<a href="index.php?option=com_artdata&amp;view=templates&amp;layout=default_edit_table&amp;id=<?php echo $item->id; ?>">
								<?php echo $item->name; ?>
							</a>
						</td>							
						<td>
							<?php echo ($item->type == 'chart') ? '<i class="uk-icon-pie-chart"></i>' : '<i class="uk-icon-table"></i>' ; ?>
							<?php echo ucwords($item->type); ?>
						</td>		
						<td>
							<?php echo ArtDataHelper::getTableTemplateMainColorPalette($item->content); ?>
						</td>	
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="makeDuplicate(<?php echo $item->id; ?>)" data-uk-tooltip title="Make a copy"><i class="uk-icon-clone"></i></a>
						</td>																					
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="removeTemplate(<?php echo $item->id; ?>)" data-uk-tooltip title="Remove"><i class="uk-icon-close"></i></a>
						</td>																																					
					</tr>	
					
				<?php } ?>
			<?php } else { ?>

					<tr>
						<td colspan="10" style="text-align:center;">	
							<div style="padding-bottom:75px;padding-top:75px;">
								<h3>Create <a href="index.php?option=com_artdata&amp;view=templates&amp;layout=default_new_table">new table template</a> to get started.</h3>
								<p>Templates are used to 'style' a table. Create a template for a custom feel for your table. Using Art Data you can visualize data any way you want.</p>
							</div>
						</td>
					</tr>
		
			<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="10" style="text-align:center;">					
							
						<!--<div class="uk-float-left">
							<select style="width:100px;">
								<option value="0">All</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>
						</div>-->

						<!--<ul class="uk-pagination">
	                        <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
	                        <li class="uk-active"><span>1</span></li>
	                        <li><a href="#">2</a></li>
	                        <li><a href="#">3</a></li>
	                        <li><a href="#">4</a></li>
	                        <li><span>...</span></li>
	                        <li><a href="#">20</a></li>
	                        <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
	                    </ul>-->
								
					</td>
				</tr>
			</tfoot>	
		</table>
			  
	</div>

	<div id="art-data-templates-chart-content" style="display:none;">

		<table class="uk-table uk-table-striped uk-table-hover">
			<thead>
				<tr>
					<th>
						<?php echo JText::_( 'Name' ); ?>
					</th> 													  																								
		            <th>
		            	<?php echo JText::_( 'Type' ); ?>
		            </th>
		            <th>
		            	<?php echo JText::_( 'Palette' ); ?>
		            </th>	
		            <th class="uk-text-center"></th>				            					            			            
		            <th class="uk-text-center"></th>							            	            
				</tr>
			</thead>
			<tbody id="art-data-sortable">
			<?php

			if (count($this->chart_items) > 0) {

				foreach ($this->chart_items as $i => $item) { ?>

					<tr>
						<td>
							<a href="index.php?option=com_artdata&amp;view=templates&amp;layout=default_edit_chart&amp;id=<?php echo $item->id; ?>">
								<?php echo $item->name; ?>
							</a>
						</td>							
						<td>
							<?php echo ($item->type == 'chart') ? '<i class="uk-icon-pie-chart"></i>' : '<i class="uk-icon-table"></i>' ; ?>
							<?php echo ucwords($item->type); ?>
						</td>		
						<td>
							<?php echo ArtDataHelper::getChartPaletteHtml($item->content); ?>
						</td>		
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="makeDuplicate(<?php echo $item->id; ?>)" data-uk-tooltip title="Make a copy"><i class="uk-icon-clone"></i></a>
						</td>																				
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="removeTemplate(<?php echo $item->id; ?>)" data-uk-tooltip title="Remove"><i class="uk-icon-close"></i></a>
						</td>																																						
					</tr>	
					
				<?php } ?>
			<?php } else { ?>

					<tr>
						<td colspan="10" style="text-align:center;">	
							<div style="padding-bottom:75px;padding-top:75px;">
								<h3>Create <a href="index.php?option=com_artdata&amp;view=templates&amp;layout=default_new_chart">new chart template</a> to get started.</h3>
								<p>Templates are used to 'style' a chart. Create a template for a custom feel for your chart. Using Art Data you can visualize data any way you want.</p>
							</div>
						</td>
					</tr>
		
			<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="10" style="text-align:center;">					
							
						<!--<div class="uk-float-left">
							<select style="width:100px;">
								<option value="0">All</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
							</select>
						</div>-->

						<!--<ul class="uk-pagination">
	                        <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
	                        <li class="uk-active"><span>1</span></li>
	                        <li><a href="#">2</a></li>
	                        <li><a href="#">3</a></li>
	                        <li><a href="#">4</a></li>
	                        <li><span>...</span></li>
	                        <li><a href="#">20</a></li>
	                        <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
	                    </ul>-->
								
					</td>
				</tr>
			</tfoot>	
		</table>
			

	</div>


</div>

<form method="post" action="index.php?option=com_artdata&amp;task=Templates.remove" name="art-data-removal-form" id="art-data-remove-form">
	<input type="hidden" name="art-data-item-id" id="art-data-item-id" value="0">
</form>
<form method="post" action="index.php?option=com_artdata&amp;task=Templates.duplicate" name="art-data-duplicate-form" id="art-data-duplicate-form">
	<input type="hidden" name="art-data-duplicate-item-id" id="art-data-duplicate-item-id" value="0">
</form>



<!-- This is the create new modal -->
<div id="art-data-new-template-choice-modal" class="uk-modal">
    <div class="uk-modal-dialog">
    	<!--<a class="uk-modal-close uk-close"></a>-->
    	<div class="uk-modal-header" id="art-data-type-activated">
    		<h2>
    			<i class="uk-icon-paint-brush"></i> <?php echo JText::_( 'select template type' ); ?>
    		</h2>
    	</div>

    	<div id="art-data-form">
    		<?php echo $this->loadTemplate('template_choice'); ?>
    	</div>

    </div>
</div>

