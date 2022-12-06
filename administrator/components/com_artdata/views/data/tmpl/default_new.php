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

<div class="art-data-body">
    <?php $input = JFactory::getApplication()->input;
    //if a notification is needed
    if ($input->getString('action')) {
        echo ArtDataHelper::getArtDataNotification($input->getString('action'));
    } ?>
    

    <form class="uk-form uk-form-stacked" method="post" action="index.php?option=com_artdata&amp;task=Data.save" name="createNewForm" id="createNewForm">
        <?php $style1 = (JFactory::getApplication()->input->getInt('id')) ? '' : 'style="display:none;"' ; ?>
        <div id="art-data-dataset-loading-container" <?php echo $style1; ?>>
            <h3 class="uk-text-center"><i class="uk-icon-spinner uk-icon-spin"></i> Loading your dataset...</h3>
        </div>
        <?php $style2 = (JFactory::getApplication()->input->getInt('id')) ? 'style="display:none;"' : '' ; ?>
        <div id="art-data-dataset-basic-form-item-container" <?php echo $style2; ?>>
            <h3>New Dataset</h3>
            <div class="uk-form-row">
                <label class="uk-form-label" for="art-data-dataset-name">
                    <?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_NAME' ); ?>
                </label>
                <div class="uk-form-controls">
                    <input name="art-data-dataset-name" id="art-data-dataset-name" class="uk-form-large uk-width-1-1" value="" type="text" data-uk-tooltip title="<?php echo JText::_( 'Give this item a name.' ); ?>">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="" id="art-data-type-label">
                    <?php echo JText::_( 'Visualization Type' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select id="art-data-dataset-visualization-type" name="art-data-dataset-visualization-type" class="uk-form-large uk-width-1-1" onchange="visualizationTypeSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select the type of visualization that this dataset is intended to be used with' ); ?>">
                        <option value=""><?php echo JText::_( 'select...' ); ?></option>
                        <option value="table">Table</option>
                        <option value="chart">Chart</option>
                    </select>   
                </div>
            </div>    
            <div class="uk-form-row" id="art-data-dataset-series-row" style="display:none;">
                <label class="uk-form-label" for="">
                    <?php echo JText::_( 'Series' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select id="art-data-dataset-series" name="art-data-dataset-series" class="uk-form-large uk-width-1-1" onchange="seriesSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Since this is a chart dataset, select either multi series data or single series data' ); ?>">
                        <option value=""><?php echo JText::_( 'select...' ); ?></option>
                        <option value="multiple">Multiple</option>
                        <option value="single">Single</option>
                    </select>   
                </div>
            </div>        
        </div>
        <div class="uk-form-row" id="art-data-spreadsheet-container" style="display:none;">
            <div class="uk-form-controls">
                
                <div class="uk-margin-top">
                    <div id="art-data-spreadsheet" class="uk-width-1-1"></div>
                </div>

                <div class="uk-panel uk-width-1-1 uk-margin-top">

                    <div class="uk-width-1-2" style="display:block;margin:0 auto;">

                        <div class="uk-grid">
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">

                                    <!--<div class="uk-text-center uk-margin-bottom"><strong>Columns</strong></div>-->
                                    <div class="uk-text-center">
                                        <a class="uk-icon-button uk-icon-plus art-data-green" onclick="addSpreadSheetColumn()" href="javascript:void(0);" data-uk-tooltip title="Add Column"></a>
                                        <a class="uk-icon-button uk-icon-minus art-data-red" onclick="removeSpreadSheetColumn()" href="javascript:void(0);" data-uk-tooltip title="Remove Column"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">
                                    <div class="uk-align-center">
                                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click',pos:'bottom-center'}">
                                            <button class="uk-button">Preview Population<i class="uk-icon-caret-down"></i></button>
                                            <div style="top: 30px; left: 0px;" class="uk-dropdown uk-dropdown-width-3 uk-dropdown-bottom"><!-- style="top: 30px; left: 0px;"-->

                                                <div class="uk-grid uk-dropdown-grid">
                                                   <div class="uk-width-1-4">

                                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                                            <li><a href="javascript:void(0);" onclick="toggleTablePreview()"><i class="uk-icon-table"></i> Table</a></li>
                                                        </ul>

                                                    </div>                                                
                                                    <div class="uk-width-1-4">

                                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                                            <li class="uk-active" id="art-data-bar-chart-tab"><a href="javascript:void(0);" onclick="toggleBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Bar</a></li>
                                                            <li id="art-data-stackedbar-chart-tab"><a href="javascript:void(0);" onclick="toggleStackedBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Stacked Bar</a></li>
                                                            <li id="art-data-percentbar-chart-tab"><a href="javascript:void(0);" onclick="togglePercentBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Percent Bar</a></li>
                                                            <li id="art-data-stepupbar-chart-tab"><a href="javascript:void(0);" onclick="toggleStepUpBarChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Step Up Bar</a></li>
                                                            <li id="art-data-waterfall-chart-tab"><a href="javascript:void(0);" onclick="toggleWaterfallChartPreviewTab()"><i class="uk-icon-bar-chart"></i> Waterfall</a></li>
                                                        </ul>

                                                    </div>
                                                    <div class="uk-width-1-4">

                                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                                            <li id="art-data-line-chart-tab"><a href="javascript:void(0);" onclick="toggleLineChartPreviewTab()"><i class="uk-icon-line-chart"></i> Line</a></li>
                                                            <li id="art-data-area-chart-tab"><a href="javascript:void(0);" onclick="toggleAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Area</a></li>
                                                            <li id="art-data-stackedarea-chart-tab"><a href="javascript:void(0);" onclick="toggleStackedAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Stacked Area</a></li>
                                                            <li id="art-data-percentarea-chart-tab"><a href="javascript:void(0);" onclick="togglePercentAreaChartPreviewTab()"><i class="uk-icon-area-chart"></i> Percent Area</a></li>
                                                        </ul>

                                                    </div>
                                                    <div class="uk-width-1-4">

                                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                                            <li id="art-data-pie-chart-tab"><a href="javascript:void(0);" onclick="togglePieChartPreviewTab()"><i class="uk-icon-pie-chart"></i> Pie</a></li>
                                                            <li id="art-data-donut-chart-tab"><a href="javascript:void(0);" onclick="toggleDonutChartPreviewTab()"><i class="uk-icon-pie-chart"></i> Donut</a></li>
                                                        </ul>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>                            
                            <div class="uk-width-medium-1-3">
                                <div class="uk-panel">

                                    <!--<div class="uk-text-center uk-margin-bottom"><strong>Rows</strong></div>-->
                                    <div class="uk-text-center" style="display:block;margin:0 auto;">
                                        <a class="uk-icon-button uk-icon-plus art-data-green" onclick="addSpreadSheetRow()" href="javascript:void(0);" data-uk-tooltip title="Add Row"></a>
                                        <a class="uk-icon-button uk-icon-minus art-data-red" onclick="removeSpreadSheetRow()" href="javascript:void(0);" data-uk-tooltip title="Remove Row"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
             
                </div>

            </div>
        </div>

        <input type="hidden" name="art-data-dataset-item-id" id="art-data-dataset-item-id" value="0">
        <input type="hidden" name="art-data-dataset-content" id="art-data-dataset-content" value="">
        <input type="hidden" name="art-data-dataset-after-processing-action" id="art-data-dataset-after-processing-action" value="0">

    </form>

    <div class="uk-panel uk-panel-box uk-width-1-1" id="art-data-dataset-preview" style="background-color:#fff;min-height:100px;display:none;">
        <h3 class="uk-title uk-text-center">Preview How a Dataset Will Populate a Visualization</h3>

        <div id="art-data-chart-preview-bar" style="width:550px;display:block;margin:0 auto;">
            <div id="uv-div-bar" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-stackedbar" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-stackedbar" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-percentbar" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-percentbar" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-stepupbar" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-stepupbar" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-waterfall" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-waterfall" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-line" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-line" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-area" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-area" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-stackedarea" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-stackedarea" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-percentarea" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-percentarea" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-pie" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-pie" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-chart-preview-donut" style="width:550px;display:none;margin:0 auto;">
            <div id="uv-div-donut" class="uk-width-1-1"></div>
        </div>
        <div id="art-data-table-preview-container" style="display:none;">
            <div id="art-data-table-preview" class="uk-width-1-1"></div>
        </div>

    </div>

</div>



