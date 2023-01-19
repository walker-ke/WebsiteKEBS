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

//load needed objects
$app = JFactory::getApplication();
$document = JFactory::getDocument();
$user = JFactory::getUser(); 

$ArtDataVisualizations = new ArtDataVisualizations(); //load visualizations class  

/*
*
*  Assemble all needed visualization data first
*
*/  

if ( $app->input->getInt('id') || (array_key_exists('visualizationId',$vars) && $vars['visualizationId'] > 0) ) {

	if ( (array_key_exists('visualizationId',$vars) && $vars['visualizationId'] > 0) ) {
        $visualizationId = $vars['visualizationId'];		
	} else {
        $visualizationId = $app->input->getInt('id');
    }

    //get visualization / template data
    $item = $ArtDataVisualizations->getItem($visualizationId);

    if (!$item) {
        $app->enqueueMessage('This is not a valid Art Data Visualization record');
        return false;
    }

    //if this user is in the correct user group to be able to view 
    $usergroups = $user->getAuthorisedGroups();
    if (in_array($item->access,$usergroups)) { //display the visualization

        //if this visualization is published
        if ($item->published == 1) { //display the visualization

            $template = $ArtDataVisualizations->getTemplate($item->template_id);
            $source = $ArtDataVisualizations->getSourceObj($item);

            if ($source->source_type == 'custom') {
                $data = $ArtDataVisualizations->getSourceData($source);
            } else {
                $dataset = $ArtDataVisualizations->getArtDataDataset($source->dataset);
                $data = json_decode($dataset->content);
            }
            
                //echo '<pre>';
                //var_dump($data);
                //echo '</pre>';

            //add visualization javascript resources
            $ArtDataVisualizations->addVisualizationScripts($item->type);

            //prepare the data source depending on data source type and visualization type
            if ($item->type == 'StaticTable' || $item->type == 'DynamicTable') {

                //art data table css modifiers
                $modifiers = json_decode($template->modifier_classes);
                $modifier_classes = array('art-data-table');
                if ($modifiers->condensed) {
                    $modifier_classes[] = 'art-data-table-condensed';
                }
                if ($modifiers->striped) {
                    $modifier_classes[] = 'art-data-table-striped';
                }
                if ($modifiers->hover) {
                    $modifier_classes[] = 'art-data-table-hover';
                }    

                //add css content
                $css = $ArtDataVisualizations->createTableCssContent($template->content);
                $document->addStyleDeclaration($css);

                if ($source->source_type == 'custom') { //table with custom data source

                    if (count($data->items) > 0) {
                        //get the name of the first column
                        $headers = $data->items[0];
                        reset($headers);
                        $first_column_name = key($headers);
                        $document->addScriptDeclaration('window.ArtDataFirstColumn'.$item->id.' = "'.$first_column_name.'";');

                        if ($item->convert_links_images == 3) { //don't convert

                        } else { //convert
                            $convertedDataItems = $ArtDataVisualizations->convertLinksImages($data->items,$item);
                            $data->items = $convertedDataItems;
                        }

                        //echo '<pre>';
                        //var_dump($data);
                        //echo '</pre>';

                        //construct javascript table search utility
                        $ArtDataVisualizations->buildTableJavascriptSearch($data->items,$item->id);
                    
                    } else {
                        $data = new stdClass;
                        $data->items = array();
                        $data->headers = array();
                        $app->enqueueMessage('Your custom data source doesn\'t have any records.');
                    }

                } else { //table using dataset

                    if ((is_array($data)) && (count($data))) { //we're using a dataset

                        $translatedData = $ArtDataVisualizations->translateTableDataset($data);

                        //echo '<pre>';
                        //var_dump($translatedData);
                        //echo '</pre>';

                        //get the name of the first column
                        $headers = $translatedData->items[0];
                        reset($headers);
                        $first_column_name = key($headers);
                        $document->addScriptDeclaration('window.ArtDataFirstColumn'.$item->id.' = "'.$first_column_name.'";');

                        if ($item->convert_links_images == 3) { //don't convert
                            $data = $translatedData;
                        } else { //convert
                            $data = $translatedData;
                            $convertedDataItems = $ArtDataVisualizations->convertLinksImages($translatedData->items,$item);
                            $data->items = $convertedDataItems;
                        }

                        //construct javascript table search utility
                        $ArtDataVisualizations->buildTableJavascriptSearch($data->items,$item->id);               
                    
                    } else {
                        $data = new stdClass;
                        $data->items = array();
                        $data->headers = array();                        
                        $app->enqueueMessage('Your dataset doesn\'t have any records.');
                    }

                }

                $document->addScriptDeclaration('window.ArtDataData'.$item->id.' = '.json_encode($data->items).';');

            } else { //this visualization is a chart

                if ($source->source_type == 'custom') { //chart with custom data type
                    
                    //this part of the software needs some attention
                    //TODO figure out the best way to use custom data in a chart
                    //data that is coming this way will be in an array of associative array
                    //where 'headers' are the keys of the associative arrays
                    //each associative array represents a row of data

                    if (count($data->items) > 0) {
                        //get the name of the first column
                        $headers = $data->items[0];
                        reset($headers);
                        $first_column_name = key($headers);
                        $document->addScriptDeclaration('window.ArtDataFirstColumn'.$item->id.' = "'.$first_column_name.'";');

                        $data = $ArtDataVisualizations->translateChartCustomData($data);
                    
                    } else {
                        $data = new stdClass;
                        $data->items = array();
                        $data->headers = array();                          
                        $app->enqueueMessage('Your custom data source doesn\'t have any records.');
                    }

                }     

            }

            $visualizationItem = $item;
            //unset any visualization properties that pertain to data source
            //they reveal a bit much to users looking at generated html page source
            //also they're just not needed in js
            unset($visualizationItem->data_source_db_type); //db type
            unset($visualizationItem->data_source_content); //remove query
            unset($visualizationItem->data_source_connection_details_db_host); //remove database creds
            unset($visualizationItem->data_source_connection_details_db_name); //remove database creds
            unset($visualizationItem->data_source_connection_details_db_user); //remove database creds
            unset($visualizationItem->data_source_connection_details_db_password); //remove database creds
            $document->addScriptDeclaration('window.ArtDataItem'.$item->id.' = '.json_encode($visualizationItem).';');
            
            $document->addScriptDeclaration('window.TemplateItem'.$item->id.' = '.json_encode($template).';');
            $document->addScriptDeclaration('window.ArtDataTemplateContent'.$item->id.' = '.$template->content.';');

        } else { //visualization unpublished notify user
            $app->enqueueMessage('The visualization that you are attempting to show on this page is unpublished. To publish the visualization please visit <a href="'.JURI::root().'administrator/index.php?option=com_artdata">'.JURI::root().'administrator/index.php?option=com_artdata</a>');
        }

    } else {

    }

}

/*
*
*  Build layout based on data above
*
*/

JHtml::_('jquery.framework'); //load jquery

$html = '';

//var_dump($user);
$usergroups = $user->getAuthorisedGroups();
if (in_array($item->access,$usergroups)) { //display the visualization

    //if this visualization is published
    if ($item->published == 1) { //display the visualization


		if ($item->show_title == 1) {
			$html .= '<h2>'.$item->name.'</h2>';
		}

		if ( $item->type == 'StaticTable' || $item->type == 'DynamicTable' ) {
		    //this is a table
		    //default css for tables
		    $document->addStyleSheet('components/com_artdata/assets/css/artdata.table.css','text/css',null,array('title'=>'art-data-table'));

		    if ( $item->type == 'DynamicTable' ) {

			    if (count($data) > 0) {
			    	$theadHtml = '';
			    	$tbodyHtml = '';

			    	$html .= '<div class="art-data-dynamic-table-app" data-artdataid="'.$item->id.'">'; //ng-app="ArtDataTable" 
			    	$html .= '<div ng-controller="ArtDataTableCtrl">'; 

			    	//if ($item->type == 'DynamicTable') {
				        $html .= '<div class="art-data-width-1-1 art-data-clearfix">';
			    			$html .= '<div id="art-data-search-bar-container">';
			        			//$html .= '<a class="art-data-button" id="art-data-button-preview">';
			        				//$html .= 'Search';
			        			//$html .= '</a>';
			        			$html .= '<input type="search" class="art-data-input" id="art-data-table-preview-search-bar" ng-model="searchText" placeholder="Search" ng-change="search()">';
			    			$html .= '</div>';
			    		$html .= '</div>';
			    	//}

			    	$html .= '<table class="'.implode(' ',$modifier_classes).'" id="art-data-table">';
			    	$html .= '<thead>';

					$theadHtml .= '<tr>';
					$tbodyHtml .= '<tr ng-repeat="item in ItemsByPage[currentPage] | orderBy:columnToOrder:!reverse">';
					foreach($data->headers as $value) {
						$columnName = $ArtDataVisualizations->camelize($value);
						$theadHtml .= '<th class="'.$columnName.'" ng-click="sort(\''.$columnName.'\',$event)">';
							$theadHtml .= '<a href="javascript:void(0);">'.$value.'</a>'; // ng-click="columnToOrder=\''.$columnName.'\';reverse=!reverse"
						$theadHtml .= '</th>';
						//$tbodyHtml .= '<td>{{item.'.$columnName.'}}</td>';//<span ng-bind="hello"></span>
						$tbodyHtml .= '<td><span ng-bind-html="item.'.$columnName.'">loading...</span></td>'; // ng-bind="item.'.$columnName.'" // ng-bind-html="item.'.$columnName.' | unsafe"
					}	
					$tbodyHtml .= '</tr>';
					$theadHtml .= '</tr>';

					$html .= $theadHtml;
				
					$html .= '</thead>';
					$html .= '<tbody>';
					$html .= $tbodyHtml;

			    	$html .= '</tbody>';
			    	

				    $html .= '<tfoot>';
				        $html .= '<tr>';
				            $html .= '<td colspan="5">';
				            	$html .= '<div class="uk-float-left uk-margin-top">';
				            		$html .= '<select class="art-data-input art-data-input-display-field" ng-model="pageSize" ng-change="changeLimit(pageSize)" convert-to-number>'; // ng-change="setPaginationLimit(this.value)"
				            				
				            			$options = explode(',',$item->pagination_limit_options);
				            			$paginationChoices = ($options && count($options) > 1) ? $options : array(5,10,15,20,50,100,200) ;
				            			$paginationLimit = (int) $item->pagination_limit;
				            			$paginationLimit = ($paginationLimit > 0) ? $paginationLimit : 10 ;
				            			foreach ($paginationChoices as $choice) {
				            				if ($choice == $paginationLimit) {
				            					$html .= '<option selected="selected" value="'.$choice.'">'.$choice.'</option>';
				            				} else {
				            					$html .= '<option value="'.$choice.'">'.$choice.'</option>';
				            				}
				            			}
				            		$html .= '</select>';
				            	$html .= '</div>'; 
				            	$html .= '<div class="uk-text-center uk-margin-top">';

                                    //current working pagination
				                	$html .= '<ul class="art-data-pagination">';
				                        //$html .= '<li class="art-data-disabled"><span><<</span></li>'; class="art-data-active" 
				                        $html .= '<li style="display:none !important;"><a href="javascript:void(0);" ng-click="firstPage($event)"><<</a></li>';
                                        $html .= '<li style="display:none !important;"><a href="javascript:void(0);" ng-click="prevPage($event)"><</a></li>';
                                        $html .= '<li class="art-data-active"><a href="javascript:void(0);" ng-click="firstPage($event)">1</a></li>';
										
                                        $html .= '<li style="display:none !important;"><span>...</span></li>'; //separator

                                        $html .= '<li ng-repeat="n in paginationRange" pagination-range="paginationRange" pagination-repeat-finished="currentPage"><a href="javascript:void(0);" ng-click="setPage($event)" ng-bind="n+1">1</a></li>'; //ng-repeat="n in range(ItemsByPage.length)"

										//<li ng-class="{active:0}" class="uk-active"><a href="javascript:void(0);" ng-click="firstPage()">1</a></li>
										//<li ng-repeat="n in range(ItemsByPage.length)"><a href="javascript:void(0);" ng-click="setPage($event)" ng-bind="n+1">1</a></li>
                                        $html .= '<li><a href="javascript:void(0);" ng-click="nextPage($event)">></a></li>';
				                        $html .= '<li><a href="javascript:void(0);" ng-click="lastPage($event)">>></a></li>';
				                    $html .= '</ul>';

				            	$html .= '</div>';
				            $html .= '</td>';
				        $html .= '</tr>';
				    $html .= '</tfoot>';


					$html .= '</table>';

					$html .= '</div>'; //end ArtDataTableCtrl
					$html .= '</div>'; //end ArtDataTable

			    } else {
			    	$html .= 'no data';
			    }
			} elseif ( $item->type == 'StaticTable' ) {

			    if (count($data->items) > 0) {
			    	$theadHtml = '';
			    	$tbodyHtml = '';

			    	$html .= '<table class="'.implode(' ',$modifier_classes).'" id="art-data-table">';
			    	
						$theadHtml .= '<tr>';
						foreach($data->headers as $value) {
							$theadHtml .= '<th>';
								$theadHtml .= $value; // ng-click="columnToOrder=\''.$columnName.'\';reverse=!reverse"
							$theadHtml .= '</th>';
						}	
						$theadHtml .= '</tr>';

						foreach($data->items as $key => $datum) {
							$tbodyHtml .= '<tr>';
							foreach ($datum as $columnName => $value) {
								$tbodyHtml .= '<td>'.$value.'</td>';
							}	
							$tbodyHtml .= '</tr>';				
						}

						$html .= '<thead>';	
							$html .= $theadHtml;
						$html .= '</thead>';

						$html .= '<tbody>';
							$html .= $tbodyHtml;
				    	$html .= '</tbody>';
			    	
					$html .= '</table>';

			    } else {
			    	$html .= 'no data';
			    }
			}

		} else {
		    //this is a chart
		    //default css
		    $document->addStyleSheet('components/com_artdata/assets/css/artdata.table.css');
		    $document->addScriptDeclaration('var ArtDataChartDefinition'.$item->id.' = '.json_encode($data).';');

		    $html .= '<div id="art-data-chart-app-'.$item->id.'" class="art-data-chart-app uk-width-1-1"  data-artdataid="'.$item->id.'"></div>';

		}

	}

}

?>