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

<form class="uk-form uk-form-stacked" method="post" action="index.php?option=com_artdata&amp;task=Visualizations.createNew" name="createNewForm" id="createNewForm">

    <div class="uk-form-row">
        <label class="uk-form-label" for="" id="art-data-type-label">
            <?php echo JText::_( 'Type' ); ?>
        </label>
        <div class="uk-form-controls">
            <select id="art-data-type" name="art-data-type" class="uk-form-large uk-width-1-1" onchange="typeSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select the visualization type' ); ?>">
                <option value=""><?php echo JText::_( 'select...' ); ?></option>
                <optgroup label="<?php echo JText::_( 'Table' ); ?>">
                    <option value="StaticTable">Static Table</option>
                    <option value="DynamicTable">Dynamic Table</option>
                </optgroup>
                <optgroup label="<?php echo JText::_( 'Chart' ); ?>">
                    <option value="Bar">Bar</option>
                    <option value="Line">Line</option>
                    <option value="Area">Area</option>
                    <option value="StackedBar">Stacked Bar</option>
                    <option value="StackedArea">Stacked Area</option>
                    <option value="Pie">Pie</option>
                    <option value="PercentBar">Percent Bar</option>
                    <option value="PercentArea">Percent Area</option>
                    <option value="Donut">Donut</option>
                    <option value="StepUpBar">Step Up Bar</option>
                    <option value="PolarArea">Polar Area</option>
                    <option value="Waterfall">Waterfall</option>
                </optgroup>
            </select>   
        </div>
    </div>

    <div class="art-data-accordion" style="display:none;" id="art-data-new-accordion" data-art-data-accordion='["basics"]'>

        <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('basics')">Basics</h3>
        <div id="art-data-accordion-content-basics" class="uk-margin-bottom">

            <div class="uk-form-row">
                <label class="uk-form-label" for="">
                    <?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_NAME' ); ?>
                </label>
                <div class="uk-form-controls">
                    <input name="art-data-new-visualization-name" id="art-data-new-visualization-name" class="uk-form-large uk-width-1-1" value="" type="text" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
                </div>
            </div>

            <div style="height:15px;"></div>
            <div class="uk-clearfix">
                <div class="uk-float-left" style="padding-right:15px;">
                    <div class="uk-form-controls uk-text-center">
                        <span style="position:relative;bottom:5px;font-weight:bold;"><?php echo JText::_( 'COM_ARTDATA_PUBLISHED_FIELD_NAME' ); ?></span> <i id="art-data-published" onclick="toggleNewIcon(0,'published','art-data-published')" class="uk-icon-toggle-on" style="cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);"></i>
                    </div>
                </div>      
                <div class="uk-float-left" style="padding-right:15px;">
                    <div class="uk-form-controls uk-text-center">
                       <span style="position:relative;bottom:5px;font-weight:bold;"><?php echo JText::_( 'COM_ARTDATA_SHOW_TITLE_FIELD_NAME' ); ?></span> <i id="art-data-show-title" onclick="toggleNewIcon(0,'showTitle','art-data-show-title')" class="uk-icon-toggle-on" style="cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);"></i>
                    </div>
                </div>
            </div>

            <div style="height:15px;"></div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="">
                    <?php echo JText::_( 'COM_ARTDATA_ACCESS_FIELD_NAME' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select id="art-data-new-visualization-access" name="art-data-new-visualization-access" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select which access level should be required to view this visualization' ); ?>">
                    <?php 
                        $userGroups = ArtDataHelper::getPublishedUserGroups(); 
                        $document = JFactory::getDocument();
                        $document->addScriptDeclaration('window.ArtCalendarJoomlaUserGroups = '.json_encode($userGroups).';');
                        foreach ($userGroups as $group) {
                            echo '<option value="'.$group->id.'">'.$group->title.'</option>';
                        }
                    ?>
                    </select>
                </div>
            </div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="">
                    <?php echo JText::_( 'COM_ARTDATA_DESCRIPTION_FIELD_NAME' ); ?>
                </label>
                <div class="uk-form-controls">
                    <textarea type="text" style="height:80px;" name="art-data-new-visualization-description" id="art-data-new-visualization-description" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Give this visualization a description to help you remember it\'s purpose' ); ?>"></textarea>
                </div>
            </div>

        </div>

        <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('data')">Data</h3>
        <div id="art-data-accordion-content-data" class="uk-margin-bottom" style="display:none;">

            <div class="uk-form-row" id="art-data-new-visualization-data-source-type-container">
                <!--<div class="art-data-form-heading uk-text-large">Data</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-type-label">
                    <?php echo JText::_( 'Source Type' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-data-source-type" id="art-data-new-visualization-data-source-type" class="uk-width-1-1 uk-form-large" onchange="dataSourceTypeSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select which type of data source you\'d like to use to populate your visualization' ); ?>">
                        <option value=""><?php echo JText::_( 'select...' ); ?></option>
                        <option value="custom">Custom</option> <!--value="tablecode"-->
                        <option value="dataset">ArtData Dataset</option>
                    </select>
                    <div id="art-data-data-source-type-activated" style="display:none;"></div>
                </div>
            </div>

            <div id="art-data-new-visualization-dataset-source-container" class="uk-margin-top" style="display:none;">
                <div class="uk-form-row">
                    <!--<div class="art-data-form-heading uk-text-large">Data</div>-->
                    <label class="uk-form-label" for="" id="art-data-new-visualization-dataset-source-label">
                        <?php echo JText::_( 'Dataset' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <?php if (count($this->datasets)) { ?>
                            <select name="art-data-new-visualization-dataset-source" id="art-data-new-visualization-dataset-source" class="uk-width-1-1 uk-form-large" data-uk-tooltip title="<?php echo JText::_( 'Select which one of your datasets you\'d like to use to populate your visualization' ); ?>">
                                <option value=""><?php echo JText::_( 'select...' ); ?></option>
                                <?php foreach ($this->datasets as $dataset) { ?>
                                        <option value="<?php echo $dataset->id; ?>"><?php echo $dataset->name; ?></option>
                                <?php } ?>
                            </select>
                        <?php } else { ?>

                                <div class="uk-text-center"><strong>You haven't created any datasets yet. <a href="index.php?option=com_artdata&amp;view=data&amp;layout=default_new">Create one</a> to get started.</strong></div>

                        <?php } ?>
                        <div id="art-data-data-source-type-activated" style="display:none;"></div>
                    </div>
                </div>
            </div>

            <div id="art-data-new-visualization-custom-source-container" class="uk-margin-top" style="display:none;">
                <div class="uk-form-row" id="art-data-new-visualization-data-source-container">
                    <!--<div class="art-data-form-heading uk-text-large">Data</div>-->
                    <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-label">
                        <?php echo JText::_( 'Source' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <select name="art-data-new-visualization-data-source" id="art-data-new-visualization-data-source" class="uk-width-1-1 uk-form-large" onchange="dataSourceSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select which custom data source you\'d like to use to populate your visualization' ); ?>">
                            <option value=""><?php echo JText::_( 'select...' ); ?></option>
                            <option value="html">HTML Table</option> <!--value="tablecode"-->
                            <option value="sql">SQL Query</option>
                            <option value="csv">CSV File</option>
                        </select>
                        <div id="art-data-data-source-activated" style="display:none;"></div>
                    </div>
                </div>

                <div class="uk-form-row" id="art-data-new-visualization-data-source-content-container">
                    <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-content-label">
                        <?php echo JText::_( 'Source Content' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <input type="text" name="art-data-new-visualization-data-source-csv-entry" id="art-data-new-visualization-data-source-csv-entry" class="uk-width-1-1 uk-form-large" data-uk-tooltip title="<?php echo JText::_( 'Enter the path to your CSV file' ); ?>" style="display:none;" />
                        <textarea name="art-data-new-visualization-data-source-content" id="art-data-new-visualization-data-source-content" class="uk-width-1-1 uk-form-large" data-uk-tooltip title="<?php echo JText::_( 'Enter your data source content here - this would be your HTML or SQL Query.' ); ?>"></textarea>
                        <div id="art-data-data-source-content-activated" style="display:none;"></div>
                    </div>
                </div>

                <div class="uk-form-row" id="art-data-new-visualization-data-source-db-type-container" style="display:none;">
                    <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-db-type-label">
                        <?php echo JText::_( 'Database' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <select name="art-data-new-visualization-data-source-db-type" id="art-data-new-visualization-data-source-db-type" class="uk-width-1-1 uk-form-large" onchange="connectionDetailsActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select the type of database you\'d like to query to populate this visualization' ); ?>">
                            <option value="mysql-joomla">MySQL - Joomla Database</option> <!--value="tablecode"-->
                            <option value="mysql-other">MySQL - Other Database</option>
                            <option value="postgresql">PostgreSQL</option>
                            <option value="mssql">MSSQL (mssql extension)</option>
                            <option value="sqlsrv">MSSQL (sqlsrv extension)</option>
                            <option value="oracle">Oracle</option>
                            <option value="access">Access</option>
                            <option value="sqlite">SQLite</option>
                            <option value="firebird">Firebird</option>
                            <option value="informix">Informix</option>
                            <option value="foxpro">Foxpro</option>
                            <option value="ado">ADO</option>
                            <option value="sybase">Sybase</option>
                            <option value="frontbase">FrontBase</option>
                            <option value="db2">DB2</option>
                            <option value="sapdb">SAP DB</option>
                            <option value="etezza">Netezza</option>
                            <option value="ldap">LDAP</option>
                            <option value="odbc">ODBC</option>
                            <option value="odbtp">ODBTP</option>
                        </select>
                    </div>
                </div>

                <div class="uk-form-row" id="art-data-new-visualization-data-source-connection-details-container" style="display:none;">
                    <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-connection-details-label">
                        <?php echo JText::_( 'Connection Details' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <input type="text" name="art-data-new-visualization-data-source-connection-details-db-host" id="art-data-new-visualization-data-source-connection-details-db-host" class="uk-width-1-1 uk-form-large" placeholder="Host" data-uk-tooltip title="<?php echo JText::_( 'Enter your database server hostname' ); ?>" />
                        <input type="text" name="art-data-new-visualization-data-source-connection-details-db-name" id="art-data-new-visualization-data-source-connection-details-db-name" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database Name" data-uk-tooltip title="<?php echo JText::_( 'Enter your database name' ); ?>" />
                        <input type="text" name="art-data-new-visualization-data-source-connection-details-db-user" id="art-data-new-visualization-data-source-connection-details-db-user" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database User" data-uk-tooltip title="<?php echo JText::_( 'Enter your database user' ); ?>" />
                        <input type="text" name="art-data-new-visualization-data-source-connection-details-db-password" id="art-data-new-visualization-data-source-connection-details-db-password" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database Password" data-uk-tooltip title="<?php echo JText::_( 'Enter your database password' ); ?>" />
                    </div>
                </div>

                <div class="uk-form-row" id="art-data-new-visualization-data-source-csv-delimiter-container" style="display:none;">
                    <label class="uk-form-label" for="" id="aart-data-new-visualization-data-source-csv-delimiter-label">
                        <?php echo JText::_( 'CSV Delimiter' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <input type="text" name="art-data-new-visualization-data-source-csv-delimiter" id="art-data-new-visualization-data-source-csv-delimiter" class="uk-width-1-1 uk-form-large" value="," data-uk-tooltip title="<?php echo JText::_( 'Enter the symbol you\'d like to use as a delimiter for your CSV file' ); ?>" />
                    </div>
                </div>

            </div>

        </div>

        <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('theme')">Style</h3>
        <div id="art-data-accordion-content-theme" class="uk-margin-bottom" style="display:none;">

            <div class="uk-form-row" id="art-data-new-visualization-chart-theme-container">
                <!--<div class="art-data-form-heading uk-text-large">Theme</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-theme-label">
                    <?php echo JText::_( 'Chart Template' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-chart-template-id" id="art-data-new-visualization-template-id" class="uk-form-large uk-width-1-1" onchange="toggleChartPalletteSamples(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select the template you\'d like to use to style your visualization' ); ?>">
                        <option value="">select... </option>
                        <?php foreach ($this->chart_templates as $tmpl) { ?>
                                    <option value="<?php echo $tmpl->id; ?>"><?php echo $tmpl->name; ?></option>
                        <?php } ?>
                    </select>
                    <div id="art-data-new-visualization-palette-samples" class="uk-margin-top">

                    </div>
                </div>
            </div>

            <div class="uk-form-row" id="art-data-new-visualization-table-theme-container">
                <!--<div class="art-data-form-heading uk-text-large">Theme</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-table-theme-label">
                    <?php echo JText::_( 'Table Template' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-table-template-id" id="art-data-new-visualization-table-template-id" class="uk-form-large uk-width-1-1" onchange="toggleTablePalletteSamples(this.value)" data-uk-tooltip title="<?php echo JText::_( 'Select the template you\'d like to use to style your visualization' ); ?>">
                        <option value="">select... </option>
                        <?php foreach ($this->table_templates as $tmpl) { ?>
                                    <option value="<?php echo $tmpl->id; ?>"><?php echo $tmpl->name; ?></option>
                        <?php } ?>
                    </select>
                    <div class="uk-text-bold uk-margin-top" style="margin-bottom:5px;">
                        <?php echo JText::_( 'Table Template Preview' ); ?>
                    </div>                    
                    <hr />
                    <div id="art-data-new-visualization-table-palette-samples" style="display:none;">
                        <?php echo $this->loadTemplate('table_preview'); ?>
                    </div>
                </div>
            </div>


        </div>

        <div id="art-data-accordion-node-other" style="display:none;">
            <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('other')">Other</h3>
            <div id="art-data-accordion-content-other" class="uk-margin-bottom" style="display:none;">


                <div id="art-data-other-options-table" style="display:none;">

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-convert-links-images-label">
                            <?php echo JText::_( 'Convert Links &amp; Images' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <select name="art-data-new-visualization-convert-links-images" id="art-data-new-visualization-convert-links-images" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select how you\'d like to convert links and images' ); ?>">
                                <option value="1">Automatically</option>
                                <option value="2">By pattern</option>
                                <option value="3">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-links-pattern-label">
                            <?php echo JText::_( 'Link conversion pattern' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-links-pattern" id="art-data-new-visualization-links-pattern" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter your link conversion pattern if using convert by pattern. Default pattern is TITLE|URL.' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-links-no-follow-label">
                            <?php echo JText::_( 'Nofollow Links' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <select name="art-data-new-visualization-links-no-follow" id="art-data-new-visualization-links-no-follow" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select yes or no for adding a rel="nofollow" attribute to converted links' ); ?>">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-links-new-window-label">
                            <?php echo JText::_( 'Open links in new window' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <select name="art-data-new-visualization-links-new-window" id="art-data-new-visualization-links-new-window" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select yes or no for adding target="_blank" to open converted links in a new window' ); ?>">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-pagination-limit-label">
                            <?php echo JText::_( 'Pagination limit default' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-pagination-limit" id="art-data-new-visualization-pagination-limit"  value="10" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Enter your default pagination limit (page size) for dynamic table. Make sure this integer is one of the integers listed below in your pagination limit options.' ); ?>">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-pagination-limit-options-label">
                            <?php echo JText::_( 'Pagination limit options' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-pagination-limit-options" id="art-data-new-visualization-pagination-limit-options" class="uk-width-1-1 uk-form-large" value="5,10,15,20,50,100,200" data-uk-tooltip title="<?php echo JText::_( 'Enter comma delimited integers to use for your pagination limit options. These integers are the options for how large of a dataset to show in your dynamic table.' ); ?>" />
                        </div>
                    </div>

                </div>
                <div id="art-data-other-options-chart" style="display:none;">

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-graph-orientation-label">
                            <?php echo JText::_( 'Chart Orientation' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <select name="art-data-new-visualization-config-graph-orientation" id="art-data-new-visualization-config-graph-orientation" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select the chart orientation' ); ?>">
                                <option value="Horizontal">Horizontal</option>
                                <option value="Vertical">Vertical</option>
                            </select>
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-caption-label">
                            <?php echo JText::_( 'Chart Title' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-caption" id="new-chart-config-meta-caption" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a chart title' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-subcaption-label">
                            <?php echo JText::_( 'Chart Sub-Title' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-subcaption" id="art-data-new-visualization-config-meta-subcaption" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a chart sub-title' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-hlabel-label">
                            <?php echo JText::_( 'Horizontal Axis Label' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-hlabel" id="art-data-new-visualization-config-meta-hlabel" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a horizontal axis label' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-hsublabel-label">
                            <?php echo JText::_( 'Horizontal Axis Sub-Label' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-hsublabel" id="art-data-new-visualization-config-meta-hsublabel" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a horizontal axis sub-label' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-vlabel-label">
                            <?php echo JText::_( 'Vertical Axis Label' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-vlabel" id="art-data-new-visualization-config-meta-vlabel" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a vertical axis label' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-vsublabel-label">
                            <?php echo JText::_( 'Vertical Axis Sub-Label' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-vsublabel" id="art-data-new-visualization-config-meta-vsublabel" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'Enter a vertical axis sub-label' ); ?>" />
                        </div>
                    </div>

                    <div class="uk-clearfix uk-margin-top uk-margin-bottom">
                        <div class="uk-float-left" style="padding-right:15px;">
                            <div class="uk-form-controls uk-text-center">
                                <span style="position:relative;bottom:5px;font-weight:bold;"><?php echo JText::_( 'Downloadable Chart' ); ?></span> <i id="art-data-new-downloadable" onclick="toggleNewIcon(0,'downloadable','art-data-new-downloadable')" class="uk-icon-toggle-on" style="cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);"></i>
                            </div>
                        </div>  
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="" id="art-data-new-visualization-config-meta-downloadLabel-label">
                            <?php echo JText::_( 'Download Label' ); ?>
                        </label>
                        <div class="uk-form-controls">
                            <input type="text" name="art-data-new-visualization-config-meta-downloadLabel" id="art-data-new-visualization-config-meta-downloadLabel" class="uk-width-1-1 uk-form-large" value="Download" data-uk-tooltip title="<?php echo JText::_( 'Enter a label to use for your download link' ); ?>" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

       

    </div>

    <input type="hidden" name="art-data-new-visualization-structure" id="art-data-new-visualization-structure" value="[]">
    
    <input type="hidden" name="art-data-new-visualization-published" id="art-data-new-visualization-published-value" value="1">
    <input type="hidden" name="art-data-new-visualization-show-title" id="art-data-new-visualization-show-title-value" value="1">    

    <input type="hidden" name="art-data-html-content" id="art-data-new-visualization-html-content" value="">
    <input type="hidden" name="art-data-new-visualization-config-meta-isDownloadable" id="art-data-new-visualization-config-meta-isDownloadable" value="0">

</form>




