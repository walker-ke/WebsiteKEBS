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

<style>
.cm-s-default {border: 1px solid #DDD;}
.art-data-form-heading {
	padding-top:5px;
	padding-bottom:5px;
	padding-left:5px;
	margin-bottom:20px;
	margin-top:10px;
	/*border-top: 1px solid #DDD;*/
	border-bottom: 1px solid #DDD;
	font-weight:bold;
}
.art-data-square-palette-item {
	border: 1px solid #DDD;
	margin:5px;
	float:left;
	height:40px;
	width:40px;
}
</style>
<script type="text/javascript">
	var artDataSearch = "<?php echo $this->state->get('art_data_search'); ?>";
</script>
<div class="art-data-body">
	<?php $input = JFactory::getApplication()->input;
	//if a notification is needed
	if ($input->getString('action')) {
		echo ArtDataHelper::getArtDataNotification($input->getString('action'));
	} ?>

	<form action="<?php echo JRoute::_('index.php?option=com_artdata'); ?>" method="post" name="adminForm" id="adminForm" class="uk-form"><!--&view=edit&layout=edit-->
		<table class="uk-table uk-table-striped uk-table-hover">
			<thead>
				<tr>
					<th>
						<?php echo JText::_( 'Name' ); ?>
					</th> 	
		            <th>
		            	<?php echo JText::_( 'Access' ); ?>
		            </th>													  																								
		            <th>
		            	<?php echo JText::_( 'Type' ); ?>
		            </th>
		            <th>
		            	<?php echo JText::_( 'Data Source' ); ?>
		            </th>
		            <th>
		            	<?php echo JText::_( 'Template' ); ?>
		            </th>	
		            <th>
		            	<?php echo JText::_( 'Shortcode' ); ?>
		            </th>				
		            <th>
		            </th>            	            				            					            			            
		            <th class="uk-text-center">
		            </th>		
		            <th class="uk-text-center">
		            </th>			            	
		            <th>
		            </th>				            	            
				</tr>
			</thead>
			<tbody id="art-data-tbody">
			<?php

			if (count($this->items) > 0) {

				foreach ($this->items as $i => $item) { ?>

					<tr>
						<td>
							<a href="javascript:void(0);" onclick="launchEditModal(<?php echo $item->id; ?>)">
								<?php echo $item->name; ?>
							</a>
						</td>
						<td>
							<?php echo $item->usergroup; ?>
							<?php //echo ArtDataHelper::getUserGroupTitle($item->access); ?>
						</td>								
						<td>
							<?php echo ArtDataHelper::getVisualizationTypeIcon($item->type); ?>
							&nbsp;
							<?php echo ucwords($item->type); ?>
						</td>	
						<td>

							<?php if ($item->data_source_type == 'custom') { ?>
								<?php if ($item->data_source == 'html') { ?>
										Custom: HTML
								<?php } elseif ($item->data_source == 'sql') { ?>
										Custom: SQL
								<?php } elseif ($item->data_source == 'csv') { ?>
										Custom: CSV
								<?php } ?>
							<?php } else { ?>
									Dataset: <a href="index.php?option=com_artdata&amp;view=data&amp;layout=default_new&amp;id=<?php echo $item->dataset_source; ?>"><?php echo $item->dataset_source_name; ?></a>
							<?php } ?>	
						</td>		
						<td>
							<?php $templateUri = ($item->type == 'DynamicTable' || $item->type == 'StaticTable') ? 'index.php?option=com_artdata&view=templates&layout=default_edit_table&id='.$item->template_id : 'index.php?option=com_artdata&view=templates&layout=default_edit_chart&id='.$item->template_id ; ?>
							<a href="<?php echo $templateUri; ?>"><?php echo $item->template_name; ?></a>
						</td>		
						<td>
							<code style="padding:2px;">[artdata id="<?php echo $item->id; ?>"]</code>
						</td>			
						<td>
							<a target="_blank" href="<?php echo JURI::root(); ?>index.php?option=com_artdata&amp;view=visualizations&amp;id=<?php echo $item->id; ?>">Preview</a>
						</td>									
						<td class="uk-text-center" style="width:1%;">

							<?php if ($item->published == 1) { ?>
									<a href="javascript:void(0);" data-uk-tooltip title="Toggle publishing" onclick="togglePublishing(0,<?php echo $item->id; ?>)"><i class="uk-icon-check-circle-o" style="color:rgba(101, 159, 19, 1) !important;"></i></a>
							<?php } else { ?>
									<a href="javascript:void(0);" data-uk-tooltip title="Toggle publishing" onclick="togglePublishing(1,<?php echo $item->id; ?>)"><i class="uk-icon-times-circle" style="color:rgba(216, 80, 48, 1) !important;"></i></a>
							<?php } ?>
						</td>	
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="makeDuplicate(<?php echo $item->id; ?>)" data-uk-tooltip title="Make a copy"><i class="uk-icon-clone"></i></a>
						</td>								
						<td class="uk-text-center" style="width:1%;">
							<a href="javascript:void(0);" onclick="removeVisualization(<?php echo $item->id; ?>)" data-uk-tooltip title="Remove"><i class="uk-icon-close"></i></a>
						</td>																																										
					</tr>	
					
				<?php } ?>
			<?php } else { ?>

					<tr>
						<td colspan="10" style="text-align:center;">	
							<div style="padding-bottom:75px;padding-top:75px;">
								<h3>Create <a href="javascript:void(0);" data-uk-modal="{target:'#art-data-create-new'}">new visualization</a> to get started.</h3>
								<p>Visualizations are the variety of different ways to display data. Create a visualization to show a table or chart. Using ArtData you an visualize data any way you want.</p>
							</div>
						</td>
					</tr>
		
			<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7" style="text-align:center;">					
							
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

	<!--<input type="hidden" name="encouragement_select" id="encouragement_select"> -->
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php //echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php //echo $listDirn; ?>" />
	<?php echo JHtml::_('form.token'); ?>


	</form>     
</div>

<form method="post" action="index.php?option=com_artdata&amp;task=Visualizations.remove" name="art-data-removal-form" id="art-data-removal-form">
	<input type="hidden" name="art-data-item-id" id="art-data-item-id" value="0">
</form>
<form method="post" action="index.php?option=com_artdata&amp;task=Visualizations.duplicate" name="art-data-duplicate-form" id="art-data-duplicate-form">
	<input type="hidden" name="art-data-duplicate-item-id" id="art-data-duplicate-item-id" value="0">
</form>
<form method="post" action="index.php?option=com_artdata&amp;task=Visualizations.togglePublishing" name="art-data-publishing-form" id="art-data-publishing-form">
	<input type="hidden" name="art-data-publishing-item-id" id="art-data-publishing-item-id" value="0">
	<input type="hidden" name="art-data-publishing-state" id="art-data-publishing-state" value="1">
</form>


<!-- This is the create new modal -->
<div id="art-data-create-new" class="uk-modal">
    <div class="uk-modal-dialog">
    	<!--<a class="uk-modal-close uk-close"></a>-->
    	<div class="uk-modal-header" id="art-data-type-activated">
    		<h2>
    			<i class="uk-icon-plus"></i> <?php echo JText::_( 'new visualization' ); ?>
    		</h2>
    	</div>

    	<div id="art-data-form">
    		<?php echo $this->loadTemplate('new'); ?>
    	</div>

        <div class="uk-modal-footer">
        	<div class="uk-clearfix">
	        	<div class="uk-float-right">
	        		<span style="padding-right:10px;">
	        			<a class="uk-button uk-button-default uk-button-large" href="javascript:void(0);" onclick="closeNewVisualizationModal()"><?php echo JText::_( 'Close' ); ?></a>
	        		</span>
	        		<a class="uk-button uk-button-primary uk-button-large" href="javascript:void(0);" onclick="saveNewVisualization()"><?php echo JText::_( 'Save' ); ?></a>
	        	</div>
	        </div>
        </div>
    </div>
</div>
 
<!-- This is the edit modal -->
<div id="art-data-edit" class="uk-modal">
    <div class="uk-modal-dialog">
    	<!--<a class="uk-modal-close uk-close"></a>-->
    	<div class="uk-modal-header" id="art-data-edit-type-activated">
    		<h2>
    			<i class="uk-icon-plus"></i> <?php echo JText::_( 'edit' ); ?>
    		</h2>
    	</div>

    	<div id="art-data-form">
    		<?php echo $this->loadTemplate('edit'); ?>
    	</div>

        <div class="uk-modal-footer">
        	<div class="uk-clearfix">
	        	<div class="uk-float-right">
	        		<span style="padding-right:10px;">
	        			<a class="uk-button uk-button-default uk-button-large" href="javascript:void(0);" onclick="closeEditVisualizationModal()"><?php echo JText::_( 'Close' ); ?></a>
	        		</span>
	        		<a class="uk-button uk-button-primary uk-button-large" href="javascript:void(0);" onclick="saveEditVisualization()"><?php echo JText::_( 'Save' ); ?></a>
	        	</div>
	        </div>
        </div>
    </div>
</div>

<!-- This is the settings modal -->
<div id="art-data-settings" class="uk-modal">
    <div class="uk-modal-dialog">
    	<a class="uk-modal-close uk-close"></a>
    	<div class="uk-modal-header">
    		<h2><i class="uk-icon-cog"></i> <?php echo JText::_( 'Settings' ); ?></h2>
    	</div>

    	<?php echo $this->loadTemplate('settings'); ?>

        <div class="uk-modal-footer">
        	<div class="uk-clearfix">
	        	<div class="uk-float-right">
	        		<span style="padding-right:10px;">
	        			<a class="uk-button uk-button-default uk-button-large" href="javascript:void(0);" onclick="closeApiSettingsModal()"><?php echo JText::_( 'Close' ); ?></a>
	        		</span>
	        		<a class="uk-button uk-button-primary uk-button-large" href="javascript:void(0);" onclick="saveApiSettings()"><?php echo JText::_( 'Save' ); ?></a>
	        	</div>
	        </div>
        </div>
    </div>
</div> 
