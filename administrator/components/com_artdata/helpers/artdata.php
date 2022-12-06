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

/**
 * Art Data administrator helper.
 */
class ArtDataHelper
{
	
	public static function getPublishedUserGroups() {
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM `#__usergroups`";
		$db->setQuery($sql);
		return $db->loadObjectList();
	}

	public static function getUserGroupTitle($groupId) {
		$db = JFactory::getDBO();
		$sql = "SELECT `title` FROM `#__usergroups` WHERE `id`=".$groupId;
		$db->setQuery($sql);
		return $db->loadResult();		
	}

	public static function isValueNumeric($value) {
	    if ($value == (string) (float) $value) {
	        return (bool) is_numeric($value);
	    }
	    if ($value >= 0 && is_string($value) && !is_float($value)) {
	        return (bool) ctype_digit($value);
	    }
	    return (bool) is_numeric($value);
	}

    public static function getSettings() {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_settings` WHERE `id`=1";
        $db->setQuery($sql);
        return $db->loadObject();
    }

    public static function isVisualizationChart($type) {
    	if ($type == 'DynamicTable' || $type == 'StaticTable') {
    		return false;
    	} else {
    		return true;
    	}
    }

    public static function getArtDataAdminMenuBar($view,$showButtonGroup=true,$buttonGroup=array('search','new')) {
    	$html = '';
    	$html .= '<div>'; // class="art-data-admin-menu"

			$html .= '<nav class="uk-navbar">';

	            //$html .= '<a class="uk-navbar-brand" href="index.php?option=com_artcalendar"><img style="max-width:14px;position:relative;bottom:1px;" src="components/com_artdata/assets/images/art-data-logo-43.jpg"> Art Data</a>';

	            $html .= '<a class="uk-navbar-brand" href="index.php?option=com_artdata"><img style="max-width:25px;" src="components/com_artdata/assets/images/art-data-logo-43.jpg"> <span style="position:relative;top:2px;">Art Data</span></a>';

	            $html .= '<ul class="uk-navbar-nav">';
	            	if ($view == 'visualizations') {
	            		$html .= '<li class="uk-parent uk-active" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">';
	            	} else {
	            		$html .= '<li class="uk-parent">'; // data-uk-dropdown="" aria-haspopup="true" aria-expanded="false"
	            	}
	                
	                    $html .= '<a href="index.php?option=com_artdata&amp;view=visualizations">Visualizations</a>';

	                    /*$html .= '<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">';
	                        $html .= '<ul class="uk-nav uk-nav-navbar">';
	                            $html .= '<li><a href="javascript:void(0);" onclick="launchCreateNewModal()"><i class="uk-icon-plus"></i> new</a></li>';
	                        $html .= '</ul>';
	                    $html .= '</div>';*/

	                $html .= '</li>';

	            $html .= '</ul>';

	            $html .= '<ul class="uk-navbar-nav">';

	            	if ($view == 'data') {
	            		$html .= '<li class="uk-parent uk-active" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">';
	            	} else {
	            		$html .= '<li class="uk-parent">'; // data-uk-dropdown="" aria-haspopup="true" aria-expanded="false"
	            	}

	                    $html .= '<a href="index.php?option=com_artdata&amp;view=data">Data</a>';

	                    /*$html .= '<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">';
	                        $html .= '<ul class="uk-nav uk-nav-navbar">';
	                            $html .= '<li><a href="#"><i class="uk-icon-plus"></i> new</a></li>';
	                        $html .= '</ul>';
	                    $html .= '</div>'; */

	                $html .= '</li>';

	            $html .= '</ul>';

	            $html .= '<ul class="uk-navbar-nav">';

	            	if ($view == 'templates') {
	            		$html .= '<li class="uk-parent uk-active" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">';
	            	} else {
	            		$html .= '<li class="uk-parent">'; // data-uk-dropdown="" aria-haspopup="true" aria-expanded="false"
	            	}

	                    $html .= '<a href="index.php?option=com_artdata&amp;view=templates">Templates</a>';

	                    /*$html .= '<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">';
	                        $html .= '<ul class="uk-nav uk-nav-navbar">';
	                            $html .= '<li><a href="#"><i class="uk-icon-plus"></i> new</a></li>';
	                        $html .= '</ul>';
	                    $html .= '</div>'; */

	                $html .= '</li>';

	            $html .= '</ul>';

	            /*$html .= '<ul class="uk-navbar-nav">';
	                $html .= '<li class="uk-parent">';
	                    $html .= '<a href=""><i class="uk-icon-search"></i></a>';
	                $html .= '</li>';
	            $html .= '</ul>'; */

	            //$html .= '<div class="uk-navbar-content">';
	                /*$html .= '<form class="uk-form uk-margin-remove uk-display-inline-block">';
	                    $html .= '<input type="text" placeholder="Search">';
	                    $html .= '<button class="uk-button uk-button-primary">Submit</button>';
	                $html .= '</form>'; */




	            //$html .= '</div>';
	            if ($showButtonGroup) {
		            $html .= '<div class="uk-navbar-content uk-navbar-flip">';

		            	$html .= '<span id="art-data-loading" class="uk-margin-right" style="display:none;"></span>';

		            	if (in_array('search',$buttonGroup)) {
							$html .= '<form class="uk-form uk-margin-remove uk-display-inline-block" action="index.php?option=com_artdata&amp;view=visualizations" method="post" style="position:relative;right:10px;" name="artDataSearchForm" id="artDataSearchForm">'; // style="position:relative;top:5px;"
								$html .= '<input type="text" value="" style="display:none;width:300px !important;position:relative;top:5px;" name="art-data-search" id="art-data-search" onkeyup="triggerSearch()" placeholder="search...">';				
								$html .= JHtml::_( 'form.token' );
							$html .= '</form>';
		            	}

		                $html .= '<div class="uk-button-group">';

		                	foreach ($buttonGroup as $button) {
		                		switch($button) {
		                			case 'search':
		                					$html .= '<a class="uk-button" id="art-data-search-toggle-button" onclick="toggleArtDataAdminSearchBar()" href="javascript:void(0);"><i class="uk-icon-search"></i></a>';
		                				break;
		                			case 'new':
		                					$html .= '<a href="javascript:void(0);" class="uk-button uk-button-primary" onclick="launchCreateNewModal()"><i class="uk-icon-plus"></i> '.JText::_( 'new' ).'</a>';
		                				break;
		                			case 'back':
		                					$html .= '<a href="index.php?option=com_artdata&view='.$view.'" class="uk-button"><i class="uk-icon-angle-double-left"></i> '.JText::_( 'back' ).'</a>';
		                				break;
		                			case 'save':
		                					$html .= '<a href="javascript:void(0);" class="uk-button uk-button-success" onclick="initSave()"><i class="uk-icon-save"></i> '.JText::_( 'save' ).'</a>';
		                				break;
		                			case 'saveclose':
		                					$html .= '<a href="javascript:void(0);" class="uk-button uk-button-primary" onclick="initSaveClose()"><i class="uk-icon-save"></i> '.JText::_( 'save &amp; close' ).'</a>';
		                				break;
		                		}
		                	}

		                $html .= '</div>';
		            $html .= '</div>';	            	
	            }    


	        $html .= '</nav>';


    	$html .= '</div>';

    	return $html;
    }

    public static function getChartPaletteHtml($configJson) {
    	$config = json_decode($configJson);
    	$html = '';
		for ($i=0;$i<count($config->graph->custompalette);$i++) {
			$html .= '<div class="art-data-square-palette-item" style="background-color:'.$config->graph->custompalette[$i].';"></div>';
		}    	

		return $html;
    }

    public static function getArtDataNotification($action) {
    	switch ($action) {
    		case 'template_created':	
    				$msg = 'The template has been created';
    			break;	
    		case 'template_saved':
    				$msg = 'The template has been saved';
    			break;
    		case 'template_removed':
    				$msg = 'The template has been removed';
    			break;
    		case 'template_duplicated':
    				$msg = 'The template has been copied';
    			break;    			
    		case 'visualization_created':
    				$msg = 'The visualization has been created.';
    			break;
    		case 'visualization_removed':
    				$msg = 'The visualization has been removed.';
    			break;
    		case 'visualization_saved':
    				$msg = 'The visualization has been saved.';
    			break;
    		case 'visualization_duplicated':
    				$msg = 'The visualization has been copied.';
    			break;
    		case 'dataset_removed':
    				$msg = 'The dataset has been removed.';
    			break;
    		case 'dataset_saved':
    				$msg = 'The dataset has been saved.';
    			break;
    		case 'dataset_duplicated':
    				$msg = 'The dataset has been copied.';
    			break;    			
    		default:
    				$msg = '';
    			break;
    	}
    	$html = '';
		$html .= '<div class="uk-alert" data-uk-alert>';
		    $html .= '<a href="" class="uk-alert-close uk-close"></a>';
		    $html .= '<p>'.$msg.'</p>';
		$html .= '</div>';

    	return $html;
    }

    public static function getTableTemplateMainColorPalette($JsonTemplateContent) {
    	$templateContent = json_decode($JsonTemplateContent);
    	$colors = array();
    	if (count($templateContent) > 0) {	
	    	foreach($templateContent as $declaration) {
	    		if ($declaration->selector == '.art-data-table-striped tbody tr:nth-of-type(2n+1)') {
	    			foreach($declaration->rules as $rule) {
	    				if ($rule->property == 'background') {
	    					$colors[] = $rule->value;
	    				}
	    			}
	    		}
	    		if ($declaration->selector == '.art-data-input') {
	    			foreach($declaration->rules as $rule) {
	    				if ($rule->property == 'background') {
	    					$colors[] = $rule->value;
	    				}
	    			}
	    		}	
	    		if ($declaration->selector == '.art-data-button') {
	    			foreach($declaration->rules as $rule) {
	    				if ($rule->property == 'background') {
	    					$colors[] = $rule->value;
	    				}
	    			}
	    		}	    		    		
	    		if ($declaration->selector == '.art-data-pagination > .art-data-active > span') {
	    			foreach($declaration->rules as $rule) {
	    				if ($rule->property == 'background') {
	    					$colors[] = $rule->value;
	    				}
	    			}
	    		}	
	    	}
	    }

	    $html = '';
	    if (count($colors) > 0) {
	    	foreach($colors as $color) {
	    		$html .= '<div class="art-data-square-palette-item" style="background-color:'.$color.';"></div>';
	    	}
	    }

	    return $html;
    }

    public static function getTableTemplates() {
    	$db = JFactory::getDBO();
    	$sql = "SELECT * FROM `#__artdata_templates` WHERE `type`='table'";
    	$db->setQuery($sql);
    	return $db->loadObjectList();
    }

    public static function getChartTemplates() {
    	$db = JFactory::getDBO();
    	$sql = "SELECT * FROM `#__artdata_templates` WHERE `type`='chart'";
    	$db->setQuery($sql);
    	return $db->loadObjectList();
    }

    public static function getTemplateName($id) {
    	$db = JFactory::getDBO();
    	$sql = "SELECT `name` FROM `#__artdata_templates` WHERE `id`=".$id;
    	$db->setQuery($sql);
    	return $db->loadResult();    	
    }

    public static function getVisualizationTypeIcon($type) {
    	switch ($type) {
    		case 'StaticTable':
    				$icon = '<i class="uk-icon-table"></i>';
    			break;
    		case 'DynamicTable':
    				$icon = '<i class="uk-icon-table"></i>';
    			break;    
       		case 'Bar':
       				$icon = '<i class="uk-icon-bar-chart"></i>';
    			break;
    		case 'Line':
    				$icon = '<i class="uk-icon-line-chart"></i>';
    			break;  
    		case 'Area':
    				$icon = '<i class="uk-icon-area-chart"></i>';
    			break;
    		case 'StackedBar':
    				$icon = '<i class="uk-icon-bar-chart"></i>';
    			break;  
       		case 'StackedArea':
       				$icon = '<i class="uk-icon-area-chart"></i>';
    			break;
    		case 'Pie':
    				$icon = '<i class="uk-icon-pie-chart"></i>';
    			break;  
    		case 'PercentBar':	
    				$icon = '<i class="uk-icon-bar-chart"></i>';
    			break;
    		case 'PercentArea':
    				$icon = '<i class="uk-icon-area-chart"></i>';
    			break; 
    		case 'Donut':
    				$icon = '<i class="uk-icon-pie-chart"></i>';
    			break; 
    		case 'PolarArea':
    				$icon = '<i class="uk-icon-pie-chart"></i>';
    			break;     			
    		case 'StepUpBar':
    				$icon = '<i class="uk-icon-bar-chart"></i>';
    			break; 
    		case 'Waterfall':
    				$icon = '<i class="uk-icon-bar-chart"></i>';
    			break; 
    		default:
    				$icon = '<i class="uk-icon-question-circle"></i>';
    			break;
    	}

    	return $icon;
    }

    public static function getDatasets() {
        $db = JFactory::getDBO();
        $sql = "SELECT * 
                FROM `#__artdata_data`";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }


}
