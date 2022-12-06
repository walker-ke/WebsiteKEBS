<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// no direct access
defined('_JEXEC') or die; ?>


<div class="art-data-body art-data-body-preview" style="z-index: -1000 !important;">	

    <div class="uk-grid">
        <div class="uk-width-medium-1-4" style="border-right:solid 1px #dddddd;">
            <div class="uk-panel" style="padding-right:20px;height:1000px;">

	            	<h3 class="uk-text-center">New Template - Table</h3>
	            	<hr class="uk-margin-bottom" />
	            	
	            	<form class="uk-form" action="index.php?option=com_artdata&amp;task=Templates.save" method="post" name="TemplateForm" id="TemplateForm">

		            	<div class="art-data-accordion" id="art-data-new-accordion" data-art-data-accordion='["table-styles"]'>

		            		<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('table-styles')">Table Modifiers</h3>
		        			<div id="art-data-accordion-content-table-styles" class="uk-margin-bottom">

								<div class="uk-grid uk-margin-top uk-margin-large-bottom">
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">
								        	<div>Condensed</div>
								        	<div class="uk-margin-top">
								        		<i style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);" class="uk-icon-toggle-off" onclick="toggleNewIcon(1,'condensed','art-data-new-table-condensed')" id="art-data-new-table-condensed"></i>
								        	</div>					        	
								        </div>
								    </div>
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">
								        	<div>Striped</div>
								        	<div class="uk-margin-top">
								        		<i style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);" class="uk-icon-toggle-off" onclick="toggleNewIcon(1,'striped','art-data-new-table-striped')" id="art-data-new-table-striped"></i>
								        	</div>
								        </div>
								    </div>
								</div>
								<div class="uk-grid uk-margin-large-bottom">
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">
								        	<div>Hover</div>
								        	<div class="uk-margin-top">
								        		<i style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);" class="uk-icon-toggle-off" onclick="toggleNewIcon(1,'hover','art-data-new-table-hover')" id="art-data-new-table-hover"></i>
								        	</div>
								        </div>
								    </div>
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">

								        </div>
								    </div>
								</div>

							    <div class="uk-form-row uk-margin-bottom">
							        <label class="uk-form-label" for="">
							        	Width
							        </label>
							        <div class="uk-form-controls">
										<select class="uk-width-1-1" name="art-data-new-table-width" id="art-data-new-table-width" style="margin:0 auto;" onchange="toggleTableWidthStylePreview(this.value)">
											<option value="100%">100%</option>
											<?php for ($i=95;$i>0;$i=$i-5) { ?>
													<option value="<?php echo $i.'%'; ?>"><?php echo $i.'%'; ?></option>
											<?php } ?>
											<option value="auto">auto</option>
										</select>
							        </div>
							    </div>

							</div>

		            		<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('table-headers')">Table Headers</h3>
		        			<div id="art-data-accordion-content-table-headers" class="uk-margin-bottom" style="display:none;">

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Align
									        </label>
									        <div class="uk-form-controls">
												<select class="uk-width-1-1" name="art-data-new-table-th-text-align" id="art-data-new-table-th-text-align" style="margin:0 auto;" onchange="toggleThTextAlignStylePreview(this.value)">
													<option value="left">left</option>
													<option value="center">center</option>
													<option value="right">right</option>
												</select>
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Padding
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-th-padding" id="art-data-new-table-th-padding" value="8px 8px" onblur="toggleThPaddingStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								</div>

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Font Size
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-th-padding" id="art-data-new-table-th-font-size" value="14px" onblur="toggleThFontSizeStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Font Weight
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-th-font-weight" id="art-data-new-table-th-font-weight" value="bold" onblur="toggleThFontWeightStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								</div>

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Color
									        </label>
									        <div class="uk-form-controls">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-th-color" id="art-data-new-table-th-color" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-th-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">

								    </div>
								</div>

							    <div class="uk-form-row">
							        <label class="uk-form-label" for="">
							        	Border Bottom
							        </label>
							        <div class="uk-form-controls uk-width-1-1">
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-th-border-bottom-size" id="art-data-new-table-th-border-bottom-size" value="1px" onblur="toggleThBorderBottomSizeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-th-border-bottom-type" id="art-data-new-table-th-border-bottom-type" value="solid" onblur="toggleThBorderBottomTypeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:90px;" name="art-data-new-table-th-border-bottom-color" id="art-data-new-table-th-border-bottom-color" value="#dddddd">
							        	</div>	
							        	<div class="uk-float-left">
							        		<div class="art-data-square-palette-item" id="art-data-new-table-th-border-bottom-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#dddddd;">&nbsp;</div>
							        	</div>	
							        </div>
							    </div>

							</div>
		            		<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('table-data')">Table Data</h3>
		        			<div id="art-data-accordion-content-table-data" class="uk-margin-bottom" style="display:none;">


								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Align
									        </label>
									        <div class="uk-form-controls">
												<select class="uk-width-1-1" name="art-data-new-table-td-text-align" id="art-data-new-table-td-text-align" style="margin:0 auto;" onchange="toggleTdTextAlignStylePreview(this.value)">
													<option value="left">left</option>
													<option value="center">center</option>
													<option value="right">right</option>
												</select>
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Padding
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-td-padding" id="art-data-new-table-td-padding" value="8px 8px" onblur="toggleTdPaddingStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								</div>

							    <div class="uk-form-row">
							        <label class="uk-form-label" for="">
							        	Border Bottom
							        </label>
							        <div class="uk-form-controls uk-width-1-1">
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-td-border-bottom-size" id="art-data-new-table-td-border-bottom-size" value="1px" onblur="toggleTdBorderBottomSizeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-td-border-bottom-type" id="art-data-new-table-td-border-bottom-type" value="solid" onblur="toggleTdBorderBottomTypeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:90px;" name="art-data-new-table-td-border-bottom-color" id="art-data-new-table-td-border-bottom-color" value="#dddddd">
							        	</div>	
							        	<div class="uk-float-left">
							        		<div class="art-data-square-palette-item" id="art-data-new-table-td-border-bottom-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#dddddd;">&nbsp;</div>
							        	</div>	
							        </div>
							    </div>

							    <div class="uk-form-row">
							        <label class="uk-form-label" for="">
							        	Striped Background
							        </label>
							        <div class="uk-form-controls uk-width-1-1">
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:90px;" name="art-data-new-table-td-striped-background-color" id="art-data-new-table-td-striped-background-color" value="#fafafa">
							        	</div>	
							        	<div class="uk-float-left">
							        		<div class="art-data-square-palette-item" id="art-data-new-table-td-striped-background-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#fafafa;">&nbsp;</div>
							        	</div>	
							        </div>
							    </div>
							</div>


		            		<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('search-bar')">Search Input</h3>
		        			<div id="art-data-accordion-content-search-bar" class="uk-margin-bottom" style="display:none;">

								<!--<div class="uk-grid uk-margin-large-bottom" style="margin-top:15px;">
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">
								        	<div>Large</div>
								        	<div class="uk-margin-top">
								        		<i style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);" class="uk-icon-toggle-off" onclick="toggleNewIcon(1,'input-large','art-data-new-table-search-bar-large')" id="art-data-new-table-search-bar-large"></i>
								        	</div>					        	
								        </div>
								    </div>
								    <div class="uk-width-medium-1-2">
								        <div class="uk-panel uk-text-center" style="height:35px;">
								        	<div>Small</div>
								        	<div class="uk-margin-top">
								        		<i style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);" class="uk-icon-toggle-off" onclick="toggleNewIcon(1,'input-small','art-data-new-table-search-bar-small')" id="art-data-new-table-search-bar-small"></i>
								        	</div>
								        </div>
								    </div>
								</div>-->

								<div class="uk-grid" style="margin-top:15px;">
								    <div class="uk-width-medium-1-2">

								        <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Height
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-search-bar-height" id="art-data-new-table-search-bar-height" value="30px" onblur="toggleSearchBarHeightStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Width
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-search-bar-width" id="art-data-new-table-search-bar-width" value="206px" onblur="toggleSearchBarWidthStylePreview(this.value)">
									        </div>
									    </div>	

								    </div>
								</div>
								<div class="uk-grid" style="margin-top:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Padding
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-search-bar-padding" id="art-data-new-table-search-bar-padding" value="4px 6px" onblur="toggleSearchBarPaddingStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-background-color" id="art-data-new-table-search-bar-background-color" value="#ffffff">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-background-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#ffffff;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>
								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Border Radius
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-search-bar-border-radius" id="art-data-new-table-search-bar-padding" value="4px" onblur="toggleSearchBarBorderRadiusStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">								     

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-color" id="art-data-new-table-search-bar-color" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>						
							    <div class="uk-form-row">
							        <label class="uk-form-label" for="">
							        	Border 
							        </label>
							        <div class="uk-form-controls uk-width-1-1">
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-search-bar-border-size" id="art-data-new-table-search-bar-border-size" value="1px" onblur="toggleSearchBarBorderBottomSizeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-search-bar-border-type" id="art-data-new-table-search-bar-border-type" value="solid" onblur="toggleSearchBarBorderBottomTypeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-border-color" id="art-data-new-table-search-bar-border-color" value="#dddddd">
							        	</div>	
							        	<div class="uk-float-left">
							        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-border-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#dddddd;">&nbsp;</div>
							        	</div>	
							        </div>
							    </div>


							    <h4>Focus</h4>
							    <hr />

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-background-color-focus" id="art-data-new-table-search-bar-background-color-focus" value="#f5fbfe">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-background-color-focus-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#f5fbfe;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">								     

									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-color-focus" id="art-data-new-table-search-bar-color-focus" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-color-focus-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>		

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Border Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-bar-border-color-focus" id="art-data-new-table-search-bar-border-color-focus" value="#99baca">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-bar-border-color-focus-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#99baca;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">								     


								    </div>
								</div>	

		        			</div>	

		            		<!--<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('search-button')">Search Button</h3>
		        			<div id="art-data-accordion-content-search-button" class="uk-margin-bottom" style="display:none;">

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Padding
									        </label>
									        <div class="uk-form-controls">
												<input type="text" class="uk-width-1-1" name="art-data-new-table-search-button-padding" id="art-data-new-table-search-button-padding" value="0 12px" onblur="toggleSearchButtonPaddingStylePreview(this.value)">
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-button-background-color" id="art-data-new-table-search-button-background-color" value="#f5f5f5">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-button-background-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#f5f5f5;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>
						
								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-search-button-color" id="art-data-new-table-search-button-color" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-search-button-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">								     

								    </div>
								</div>

							    <div class="uk-form-row">
							        <label class="uk-form-label" for="">
							        	Border 
							        </label>
							        <div class="uk-form-controls uk-width-1-1">
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-search-button-border-size" id="art-data-new-table-search-button-border-size" value="1px" onblur="toggleSearchButtonBorderSizeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:45px;" name="art-data-new-table-search-button-border-type" id="art-data-new-table-search-button-border-type" value="solid" onblur="toggleSearchButtonBorderTypeStylePreview(this.value)">
							        	</div>
							        	<div class="uk-float-left" style="padding-right:5px;">
							        		<input type="text" style="width:90px;" name="art-data-new-table-search-button-border-color" id="art-data-new-table-search-button-border-color" value="#dddddd">
							        	</div>	
							        	<div class="uk-float-left">
							        		<div class="art-data-square-palette-item" id="art-data-new-table-search-button-border-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#dddddd;">&nbsp;</div>
							        	</div>	
							        </div>
							    </div>

		        			</div>	-->

		            		<h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('pagination')">Pagination</h3>
		        			<div id="art-data-accordion-content-pagination" class="uk-margin-bottom" style="display:none;">

							    <h4>Active</h4>
							    <hr />

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-active-background" id="art-data-new-table-pagination-active-background" value="#00a8e6">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-active-background-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#00a8e6;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-active-color" id="art-data-new-table-pagination-active-color" value="#ffffff">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-active-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#ffffff;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>

							    <h4>Non-Active</h4>
							    <hr />

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-background" id="art-data-new-table-pagination-background" value="#f5f5f5">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-background-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#f5f5f5;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-color" id="art-data-new-table-pagination-color" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>

							    <!--<h4>Focus &amp; Hover</h4>
							    <hr />							    

								<div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Background
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-focus-hover-background" id="art-data-new-table-pagination-focus-hover-background" value="#fafafa">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-focus-hover-background-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#fafafa;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								    <div class="uk-width-medium-1-2">
								        
									    <div class="uk-form-row">
									        <label class="uk-form-label" for="">
									        	Text Color
									        </label>
									        <div class="uk-form-controls uk-width-1-1">
									        	<div class="uk-float-left" style="padding-right:5px;">
									        		<input type="text" style="width:90px;" name="art-data-new-table-pagination-focus-hover-color" id="art-data-new-table-pagination-focus-hover-color" value="#444444">
									        	</div>	
									        	<div class="uk-float-left">
									        		<div class="art-data-square-palette-item" id="art-data-new-table-pagination-focus-hover-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#444444;">&nbsp;</div>
									        	</div>	
									        </div>
									    </div>

								    </div>
								</div>-->

		        			</div>	

						</div>

						<input type="hidden" name="art-data-new-template-content" id="art-data-new-template-content" value="[]">
						<input type="hidden" name="art-data-new-template-name-value" id="art-data-new-template-name-value" value="">
						<input type="hidden" name="art-data-new-template-type" id="art-data-new-template-type" value="table">

						<input type="hidden" name="art-data-new-template-condensed-value" id="art-data-new-template-condensed-value" value="0">
						<input type="hidden" name="art-data-new-template-striped-value" id="art-data-new-template-striped-value" value="0">
						<input type="hidden" name="art-data-new-template-hover-value" id="art-data-new-template-hover-value" value="0">

	            	</form>

	           	
            </div>
        </div>
        <div class="uk-width-medium-3-4">
            <div class="uk-panel">

            	<h3 class="uk-text-center">Table Template Preview</h3>
            	<hr class="uk-margin-bottom" />

            	<div class="uk-text-center" id="art-data-loading-content" style="width:100%;margin-top:150px;">
					<div style="font-size:25px;"><i class="uk-icon-spinner uk-icon-spin"></i> loading template preview...</div>
				</div>
            	<div id="art-data-preview-table-container" style="display:none;">

            		<div class="art-data-width-1-1 art-data-clearfix">
            			<div id="art-data-search-bar-container">
	            			<!--<form>-->
	            				<a class="art-data-button" id="art-data-button-preview">
	            					Search
	            				</a>
	            				<input type="text" class="art-data-input" id="art-data-table-preview-search-bar">
	            			<!--</form>-->
            			</div>
            		</div>


	                <table class="art-data-table" id="art-data-preview-table">
	                    <thead>
	                        <tr>
	                            <th>Table Heading</th>
	                            <th>Table Heading</th>
	                            <th>Table Heading</th>
	                            <th>Table Heading</th>
	                            <th>Table Heading</th>                           
	                        </tr>
	                    </thead>
	                    <tfoot>
	                        <tr>
	                            <td colspan="5">

	                            	<div class="uk-float-left uk-margin-top">
	                            		<select class="art-data-input art-data-input-display-field">
	                            			<option value="5">5</option>
	                            			<option value="10">10</option>
	                            			<option value="15">15</option>
	                            			<option value="20">20</option>
	                            			<option value="50">50</option>
	                            			<option value="100">100</option>
	                            			<option value="all">All</option>
	                            		</select>
	                            	</div>
	                            	<div class="uk-text-center uk-margin-top">
		                            	<ul class="art-data-pagination">
			                                <li class="art-data-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
			                                <li class="art-data-active"><a>1</a></li>
			                                <li><a href="#">2</a></li>
			                                <li><a href="#">3</a></li>
			                                <li><a href="#">4</a></li>
			                                <li><span>...</span></li>
			                                <li><a href="#">20</a></li>
			                                <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
			                            </ul>
	                            	</div>

	                            </td>
	                            
	                        </tr>
	                    </tfoot>
	                    <tbody>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>                         
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>
	                        <tr>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
	                            <td>Table Data</td>
								<td>Table Data</td>
	                            <td>Table Data</td>
	                        </tr>

	                    </tbody>
	                </table>    
            	</div>

            </div>
        </div>
    </div>

	<!-- This is the new template basics modal -->
	<div id="art-data-new-template-basics-modal" class="uk-modal" style="margin-top:50px;">
	    <div class="uk-modal-dialog">
	    	<div class="uk-modal-header" id="art-data-type-activated">
	    		<h2>
	    			<i class="uk-icon-save"></i> <?php echo JText::_( 'save template' ); ?>
	    		</h2>
	    	</div>
	    	<div>
	    		<form class="uk-form">

					<div class="uk-alert" data-uk-alert>
					    <a href="" class="uk-alert-close uk-close"></a>
					    <p>Please give the new template a name below before saving.</p>
					</div>

		            <div class="uk-form-row">
		                <label class="uk-form-label" for="">
		                    <?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_NAME' ); ?>
		                </label>
		                <div class="uk-form-controls">
		                    <input name="art-data-new-template-name" id="art-data-new-template-name" class="uk-form-large uk-width-1-1" value="" type="text" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
		                </div>
		            </div>	 
	            </form>
	    	</div>
	        <div class="uk-modal-footer">
	        	<div class="uk-clearfix">
		        	<div class="uk-float-right">
		        		<span style="padding-right:10px;">
		        			<a class="uk-button uk-button-default uk-button-large" href="javascript:void(0);" onclick="closeTemplateBasicsModal()"><?php echo JText::_( 'Close' ); ?></a>
		        		</span>
		        		<a class="uk-button uk-button-primary uk-button-large" href="javascript:void(0);" onclick="finalizeSave()"><?php echo JText::_( 'Save' ); ?></a>
		        	</div>
		        </div>
	        </div>
	    </div>
	</div>

</div>