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
						<?php echo JText::_( 'Type' ); ?>
					</th>	
					<th>
						<?php echo JText::_( 'Series' ); ?>
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
							<a href="index.php?option=com_artdata&amp;view=data&amp;layout=default_new&amp;id=<?php echo $item->id; ?>">
								<?php echo $item->name; ?>
							</a>
						</td>	
						<td>
							<?php echo ucwords($item->type); ?>
						</td>
						<td>
							<?php echo ucwords($item->series); ?>
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
								<h3>Create <a href="javascript:void(0);" onclick="launchCreateNewModal()">new dataset</a> to get started.</h3>
								<p>Datasets are used to populate a visualization with data. Fully customize your dataset for the perfect chart or table.</p>
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

<form method="post" action="index.php?option=com_artdata&amp;task=Data.remove" name="art-data-removal-form" id="art-data-removal-form">
	<input type="hidden" name="art-data-item-id" id="art-data-item-id" value="0">
</form>
<form method="post" action="index.php?option=com_artdata&amp;task=Data.duplicate" name="art-data-duplicate-form" id="art-data-duplicate-form">
	<input type="hidden" name="art-data-duplicate-item-id" id="art-data-duplicate-item-id" value="0">
</form>


