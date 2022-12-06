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
            <select id="art-data-type" name="art-data-type" class="uk-form-large uk-width-1-1" onchange="typeSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_TYPE_FIELD_TOOLTIP' ); ?>">
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

    <div class="art-data-accordion" style="display:none;" id="art-data-new-accordion" data-art-data-accordion>

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
                        <span style="position:relative;bottom:5px;font-weight:bold;"><?php echo JText::_( 'COM_ARTDATA_PUBLISHED_FIELD_NAME' ); ?></span> <i id="art-data-published" onclick="toggleIcon(0,'published','art-data-published')" class="uk-icon-toggle-on" style="cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);"></i>
                    </div>
                </div>      
                <div class="uk-float-left" style="padding-right:15px;">
                    <div class="uk-form-controls uk-text-center">
                       <span style="position:relative;bottom:5px;font-weight:bold;"><?php echo JText::_( 'COM_ARTDATA_SHOW_TITLE_FIELD_NAME' ); ?></span> <i id="art-data-show-title" onclick="toggleIcon(1,'showTitle','art-data-show-title')" class="uk-icon-toggle-off" style="cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);"></i>
                    </div>
                </div>
            </div>

            <div style="height:15px;"></div>

            <div class="uk-form-row">
                <label class="uk-form-label" for="">
                    <?php echo JText::_( 'COM_ARTDATA_ACCESS_FIELD_NAME' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select id="art-data-new-visualization-access" name="art-data-new-visualization-access" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_ACCESS_FIELD_TOOLTIP' ); ?>">
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
                    <textarea type="text" style="height:80px;" name="art-data-new-visualization-description" id="art-data-new-visualization-description" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_DESCRIPTION_FIELD_TOOLTIP' ); ?>"></textarea>
                </div>
            </div>

        </div>

        <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('data')">Data</h3>
        <div id="art-data-accordion-content-data" class="uk-margin-bottom" style="display:none;">

            <div class="uk-form-row" id="art-data-new-visualization-data-source-container">
                <!--<div class="art-data-form-heading uk-text-large">Data</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-label">
                    <?php echo JText::_( 'Source' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-data-source" id="art-data-new-visualization-data-source" class="uk-width-1-1 uk-form-large" onchange="dataSourceSelectionActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
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
                    <input type="text" name="art-data-new-visualization-data-source-csv-entry" id="art-data-new-visualization-data-source-csv-entry" class="uk-width-1-1 uk-form-large" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" style="display:none;" />
                    <textarea name="art-data-new-visualization-data-source-content" id="art-data-new-visualization-data-source-content" class="uk-width-1-1 uk-form-large" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>"></textarea>
                    <div id="art-data-data-source-content-activated" style="display:none;"></div>
                </div>
            </div>

            <div class="uk-form-row" id="art-data-new-visualization-data-source-db-type-container" style="display:none;">
                <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-db-type-label">
                    <?php echo JText::_( 'Database' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-data-source-db-type" id="art-data-new-visualization-data-source-db-type" class="uk-width-1-1 uk-form-large" onchange="connectionDetailsActivate(this.value)" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
                        <option value="mysql-joomla">MySQL - Joomla Database</option> <!--value="tablecode"-->
                        <option value="mysql-other">MySQL - Other Database</option>
                        <option value="PostgreSQL">PostgreSQL</option>
                        <option value="MSSQL">MSSQL</option>
                        <option value="Oracle">Oracle</option>
                        <option value="Access">Access</option>
                        <option value="SQLite">SQLite</option>
                        <option value="Firebird">Firebird</option>
                        <option value="Informix">Informix</option>
                        <option value="Foxpro">Foxpro</option>
                        <option value="ADO">ADO</option>
                        <option value="Sybase">Sybase</option>
                        <option value="FrontBase">FrontBase</option>
                        <option value="DB2">DB2</option>
                        <option value="SAP DB">SAP DB</option>
                        <option value="Netezza">Netezza</option>
                        <option value="LDAP">LDAP</option>
                        <option value="ODBC">ODBC</option>
                        <option value="ODBTP">ODBTP</option>
                    </select>
                </div>
            </div>

            <div class="uk-form-row" id="art-data-new-visualization-data-source-connection-details-container" style="display:none;">
                <label class="uk-form-label" for="" id="art-data-new-visualization-data-source-connection-details-label">
                    <?php echo JText::_( 'Connection Details' ); ?>
                </label>
                <div class="uk-form-controls">
                    <input type="text" name="art-data-new-visualization-data-source-connection-details-db-host" id="art-data-new-visualization-data-source-connection-details-db-host" class="uk-width-1-1 uk-form-large" placeholder="Host" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                    <input type="text" name="art-data-new-visualization-data-source-connection-details-db-name" id="art-data-new-visualization-data-source-connection-details-db-name" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database Name" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                    <input type="text" name="art-data-new-visualization-data-source-connection-details-db-user" id="art-data-new-visualization-data-source-connection-details-db-user" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database User" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                    <input type="text" name="art-data-new-visualization-data-source-connection-details-db-password" id="art-data-new-visualization-data-source-connection-details-db-password" class="uk-width-1-1 uk-form-large uk-margin-small-top" placeholder="Database Password" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                </div>
            </div>

            <div class="uk-form-row" id="art-data-new-visualization-data-source-csv-delimiter-container" style="display:none;">
                <label class="uk-form-label" for="" id="aart-data-new-visualization-data-source-csv-delimiter-label">
                    <?php echo JText::_( 'CSV Delimiter' ); ?>
                </label>
                <div class="uk-form-controls">
                    <input type="text" name="art-data-new-visualization-data-source-csv-delimiter" id="art-data-new-visualization-data-source-csv-delimiter" class="uk-width-1-1 uk-form-large" value="," data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                </div>
            </div>

        </div>

        <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('theme')">Theme</h3>
        <div id="art-data-accordion-content-theme" class="uk-margin-bottom" style="display:none;">

            <div class="uk-form-row" id="art-data-new-visualization-chart-theme-container">
                <!--<div class="art-data-form-heading uk-text-large">Theme</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-theme-label">
                    <?php echo JText::_( 'Palette' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-palette" id="art-data-new-visualization-palette" class="uk-form-large uk-width-1-1" onchange="toggleChartPalletteSamples(this.value)" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
                        <option value="Default">Default</option>
                        <option value="Plain">Plain</option>
                        <option value="Android">Android</option>
                        <option value="Soft">Soft</option>
                        <option value="Simple">Simple</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Olive">Olive</option>
                        <option value="Candid">Candid</option>
                        <option value="Sulphide">Sulphide</option>
                        <option value="Lint">Lint</option>
                    </select>
                    <div id="art-data-new-visualization-palette-samples" class="uk-margin-top">
                        <?php $defaults = array('#7E6DA1','#C2CF30','#FF8900','#FE2600','#E3003F','#8E1E5F','#FE2AC2','#CCF030','#9900EC','#3A1AA8','#3932FE','#3276FF','#35B9F6','#42BC6A','#91E0CB'); ?>
                        <?php foreach ($defaults as $color) { ?>
                                <div class="art-data-square-palette-item" style="background-color:<?php echo $color; ?>;">
                                </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="uk-form-row" id="art-data-new-visualization-table-theme-container">
                <!--<div class="art-data-form-heading uk-text-large">Theme</div>-->
                <label class="uk-form-label" for="" id="art-data-new-visualization-table-theme-label">
                    <?php echo JText::_( 'Palette' ); ?>
                </label>
                <div class="uk-form-controls">
                    <select name="art-data-new-visualization-table-palette" id="art-data-new-visualization-table-palette" class="uk-form-large uk-width-1-1" onchange="toggleTablePalletteSamples(this.value)" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
                        <option value="1">Style 1</option> <!--standard uikit-->
                        <option value="2">Style 2</option> <!--gusto-->
                        <option value="3">Style 3</option> <!--venice-->
                        <option value="4">Style 4</option> <!--capture-->
                        <option value="5">Style 5</option> <!--organic-->
                        <option value="6">Style 6</option> <!--lykka-->
                    </select>
                    <div id="art-data-new-visualization-table-palette-samples" class="uk-margin-top uk-text-center">
                        <img src="components/com_artdata/assets/images/tables/table-1.jpg" id="art-data-new-visualization-table-palette-samples-img">
                    </div>
                </div>
            </div>


        </div>

        <div id="art-data-accordion-node-other" style="display:none;">
            <h3 class="art-data-accordion-title" onclick="toggleAccordionNode('other')">Other</h3>
            <div id="art-data-accordion-content-other" class="uk-margin-bottom" style="display:none;">


                <div class="uk-form-row">
                    <label class="uk-form-label" for="" id="art-data-new-visualization-convert-links-images-label">
                        <?php echo JText::_( 'Convert Links &amp; Images' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <select name="art-data-new-visualization-convert-links-images" id="art-data-new-visualization-convert-links-images" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
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
                        <input type="text" name="art-data-new-visualization-links-pattern" id="aart-data-new-visualization-links-pattern" class="uk-width-1-1 uk-form-large" value="" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>" />
                    </div>
                </div>

                <div class="uk-form-row">
                    <label class="uk-form-label" for="" id="art-data-new-visualization-links-no-follow-label">
                        <?php echo JText::_( 'Nofollow Links' ); ?>
                    </label>
                    <div class="uk-form-controls">
                        <select name="art-data-new-visualization-links-no-follow" id="art-data-new-visualization-links-no-follow" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
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
                        <select name="art-data-new-visualization-links-new-window" id="art-data-new-visualization-links-new-window" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'COM_ARTDATA_NAME_FIELD_TOOLTIP' ); ?>">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <input type="hidden" name="art-data-new-visualization-structure" id="art-data-new-visualization-structure" value="[]">

</form>




