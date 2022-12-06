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

$defaultPalette = array("#7E6DA1","#C2CF30","#FF8900","#FE2600","#E3003F","#8E1E5F","#FE2AC2","#CCF030","#9900EC","#3A1AA8","#3932FE","#3276FF","#35B9F6","#42BC6A","#91E0CB");

?>

<div class="art-data-body" style="z-index:0;">

    <div class="uk-grid">
        <div class="uk-width-medium-1-4" style="border-right:solid 1px #dddddd;">
            <div class="uk-panel" style="padding-left:20px;padding-right:20px;height:1000px;">

                <h3 class="uk-text-center">New Template - Chart</h3>
                <hr class="uk-margin-bottom" />

                <form class="uk-form" action="index.php?option=com_artdata&amp;task=Templates.save" method="post" name="TemplateForm" id="TemplateForm">
                    <div class="art-data-accordion" id="art-data-new-accordion" data-art-data-accordion='["chart"]'>
                        <h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('chart')">Chart</h3>
                        <div id="art-data-accordion-content-chart" class="uk-margin-bottom">

                            <div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
                                <div class="uk-width-medium-1-2">
                                    
                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Background
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                            <div class="art-data-colorpicker-container">
                                                <div class="uk-float-left" style="padding-right:5px;">
                                                    <input type="text" style="width:90px;" name="art-data-chart-background" id="art-data-chart-background" value="#ffffff">
                                                </div>  
                                                <div class="uk-float-left">
                                                    <div class="art-data-square-palette-item" id="art-data-chart-background-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#ffffff;">&nbsp;</div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-width-medium-1-2">   

                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Opacity
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">

                                            <select name="art-data-chart-opacity" id="art-data-chart-opacity" onchange="modifyChartConfig('opacity',this.value)">
                                                <?php $opacityChoices = array(100,95,90,85,80,75,70,65,60,55,50,45,40,35,30,25,20,15,10,5); ?>
                                                <?php foreach ($opacityChoices as $choice) { ?>

                                                        <option value="<?php echo $choice / 100; ?>"><?php echo $choice; ?>%</option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
                                <div class="uk-width-medium-1-2">
                                    
                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Width
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                              <input type="text" style="width:90px;" name="art-data-chart-width" id="art-data-chart-width" onblur="modifyChartConfig('width',this.value)" value="400"> 
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-width-medium-1-2">   

                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Height
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                            <input type="text" style="width:90px;" name="art-data-chart-height" id="art-data-chart-height" onblur="modifyChartConfig('height',this.value)" value="400"> 
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('axis')">Axis</h3>
                        <div id="art-data-accordion-content-axis" class="uk-margin-bottom" style="display:none;">

                            <div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
                                <div class="uk-width-medium-1-2">
                                    
                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Axis Lines Color
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                            <div class="art-data-colorpicker-container">
                                                <div class="uk-float-left" style="padding-right:5px;">
                                                    <input type="text" style="width:90px;" name="art-data-chart-axis-color" id="art-data-chart-axis-color" value="#000000" >
                                                </div>  
                                                <div class="uk-float-left">
                                                    <div class="art-data-square-palette-item" id="art-data-chart-axis-color-preview" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:#000000;">&nbsp;</div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-width-medium-1-2">                                    

                                    <div class="uk-panel uk-text-center" style="height:35px;">
                                        <div>Show Ticks</div>
                                        <div>
                                            <i style="cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);" class="uk-icon-toggle-on" onclick="toggleNewIcon(0,'showTicks','art-data-chart-axis-show-ticks')" id="art-data-chart-axis-show-ticks"></i>
                                        </div>                              
                                    </div>

                                </div>
                            </div>

                            <div class="uk-grid" style="margin-top:15px;margin-bottom:15px;">
                                <div class="uk-width-medium-1-2">
                                    
                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Ticks
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                            <input type="text" style="width:90px;" name="art-data-chart-axis-ticks" id="art-data-chart-axis-ticks" onblur="modifyChartConfig('ticks',this.value)" value="8">
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-width-medium-1-2">                                    

                                    <div class="uk-form-row uk-text-center">
                                        <label class="uk-form-label" for="">
                                            Padding
                                        </label>
                                        <div class="uk-form-controls uk-width-1-1">
                                            <input type="text" style="width:90px;" name="art-data-chart-axis-padding" id="art-data-chart-axis-padding" onblur="modifyChartConfig('axispadding',this.value)" value="5"> 
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <h3 class="art-data-accordion-title uk-text-center" onclick="toggleAccordionNode('palette')">Palette</h3>
                        <div id="art-data-accordion-content-palette" class="uk-margin-bottom" style="display:none;">

                            <?php foreach ($defaultPalette as $key => $color) { ?>

                                    <div class="uk-clearfix uk-text-center uk-width-1-1">
                                        <script type="text/javascript">
                                            jQuery(function($){
                                                $( "#art-data-chart-palette-<?php echo $key; ?>" ).colorpicker({hideButton:true,color:'<?php echo $color; ?>'});
                                                $("#art-data-chart-palette-<?php echo $key; ?>").on("change.color", function(event, color){
                                                    $('#art-data-chart-palette-preview-<?php echo $key; ?>').css('background-color', color);
                                                    modifyChartPalette(<?php echo $key; ?>,color);
                                                });
                                            }); 
                                        </script>
                                        <div style="max-width:135px;margin:0 auto;">
                                            <div class="uk-float-left" style="padding-right:5px;">
                                                <input type="text" name="art-data-chart-palette-<?php echo $key; ?>" id="art-data-chart-palette-<?php echo $key; ?>" style="width:90px;" value="<?php echo $color; ?>" />
                                            </div>  
                                            <div class="uk-float-left">
                                                <div class="art-data-square-palette-item" id="art-data-chart-palette-preview-<?php echo $key; ?>" style="margin:0;width:29px;height:29px;border-radius:4px;background-color:<?php echo $color; ?>;">&nbsp;</div>
                                            </div>  
                                        </div>

                                    </div>

                                    <hr />

                            <?php } ?>

                        </div>
                    </div>

                    <input type="hidden" name="art-data-new-template-content" id="art-data-new-template-content" value="{}">
                    <input type="hidden" name="art-data-new-template-name-value" id="art-data-new-template-name-value" value="">
                    <input type="hidden" name="art-data-new-template-type" id="art-data-new-template-type" value="chart">
                    <input type="hidden" name="art-data-close" id="art-data-close" value="0">

                </form>

            </div>
        </div>
        <div class="uk-width-medium-3-4">
            <div class="uk-panel">
                <h3 class="uk-text-center">Chart Template Preview</h3>
                <hr class="uk-margin-bottom" />  

                <div class="uk-margin-large-bottom">

                    <div class="uk-button-dropdown" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
                        <button class="uk-button">Toggle Chart Type Preview <i class="uk-icon-caret-down"></i></button>
                        <div class="uk-dropdown uk-dropdown-width-3 uk-dropdown-bottom"><!-- style="top: 30px; left: 0px;"-->

                            <div class="uk-grid uk-dropdown-grid">
                                <div class="uk-width-1-3">

                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li class="uk-active" id="art-data-bar-chart-tab"><a href="javascript:void(0);" onclick="toggleBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Bar</a></li>
                                        <li id="art-data-stackedbar-chart-tab"><a href="javascript:void(0);" onclick="toggleStackedBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Stacked Bar</a></li>
                                        <li id="art-data-percentbar-chart-tab"><a href="javascript:void(0);" onclick="togglePercentBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Percent Bar</a></li>
                                        <li id="art-data-stepupbar-chart-tab"><a href="javascript:void(0);" onclick="toggleStepUpBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Step Up Bar</a></li>
                                        <li id="art-data-waterfall-chart-tab"><a href="javascript:void(0);" onclick="toggleWaterfallChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Waterfall</a></li>
                                    </ul>

                                </div>
                                <div class="uk-width-1-3">

                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li id="art-data-line-chart-tab"><a href="javascript:void(0);" onclick="toggleLineChartPreviewTab()"><i class="uk-icon-line-chart"></i> Line</a></li>
                                        <li id="art-data-area-chart-tab"><a href="javascript:void(0);" onclick="toggleAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Area</a></li>
                                        <li id="art-data-stackedarea-chart-tab"><a href="javascript:void(0);" onclick="toggleStackedAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Stacked Area</a></li>
                                        <li id="art-data-percentarea-chart-tab"><a href="javascript:void(0);" onclick="togglePercentAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Percent Area</a></li>
                                    </ul>

                                </div>
                                <div class="uk-width-1-3">

                                    <ul class="uk-nav uk-nav-dropdown uk-panel">
                                        <li id="art-data-pie-chart-tab"><a href="javascript:void(0);" onclick="togglePieChartPreviewTab()"><i class="uk-icon-pie-chart"></i> Pie</a></li>
                                        <li id="art-data-donut-chart-tab"><a href="javascript:void(0);" onclick="toggleDonutChartPreviewTab()"><i class="uk-icon-pie-chart"></i> Donut</a></li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="art-data-chart-preview-bar">
                    <div id="uv-div-bar" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-stackedbar" style="display:none;">
                    <div id="uv-div-stackedbar" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-percentbar" style="display:none;">
                    <div id="uv-div-percentbar" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-stepupbar" style="display:none;">
                    <div id="uv-div-stepupbar" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-waterfall" style="display:none;">
                    <div id="uv-div-waterfall" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-line" style="display:none;">
                    <div id="uv-div-line" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-area" style="display:none;">
                    <div id="uv-div-area" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-stackedarea" style="display:none;">
                    <div id="uv-div-stackedarea" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-percentarea" style="display:none;">
                    <div id="uv-div-percentarea" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-pie" style="display:none;">
                    <div id="uv-div-pie" class="uk-width-1-1"></div>
                </div>
                <div id="art-data-chart-preview-donut" style="display:none;">
                    <div id="uv-div-donut" class="uk-width-1-1"></div>
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
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="">
                            <?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_NAME' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input name="art-data-new-template-name" id="art-data-new-template-name" class="uk-form-large uk-width-1-1" type="text" value="" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
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

