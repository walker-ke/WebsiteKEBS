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

jimport('joomla.application.component.modeladmin');

/**
 * ArtData Visualizations main model.
 */
class ArtDataModelVisualizations extends JModelAdmin
{

    /**
     * Returns a reference to the Table object, always creating it.
     *
     * @param   type    The table type to instantiate
     * @param   string  A prefix for the table class name. Optional.
     * @param   array   Configuration array for model. Optional.
     * @return  JTable  A database object
     * @since   1.6
     */
    public function getTable($type = 'Visualizations', $prefix = 'ArtDataTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array   $data       An optional array of data for the form to interogate.
     * @param   boolean $loadData   True if the form is to load its own data (default case), false if not.
     * @return  JForm   A JForm object on success, false on failure
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Initialise variables.
        $app    = JFactory::getApplication();

        // Get the form.
        $form = $this->loadForm('com_artdata.edit', 'edit', array('control' => 'jform', 'load_data' => $loadData));
        
        
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed   The data for the form.
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_artdata.edit.edit.data', array());

        if (empty($data)) {
            $data = $this->getItem();
            
        }

        return $data;
    }

    /**
     * Method to get a single record.
     *
     * @param   integer The id of the primary key.
     *
     * @return  mixed   Object on success, false on failure.
     * @since   1.6
     */
    public function getItem($pk = null)
    {
        if ($item = parent::getItem($pk)) {

            //Do any procesing on fielDIRECTORY_SEPARATOR here if needed

        }

        return $item;
    }  

    function getListItems() {
        $db = JFactory::getDBO();
        $sql = "SELECT v.*, ug.title AS usergroup, t.name AS template_name, d.name AS dataset_source_name 
                FROM `#__artdata_visualizations` AS v
                LEFT JOIN `#__usergroups` AS ug ON ug.id=v.access
                LEFT JOIN `#__artdata_templates` AS t ON t.id=v.template_id
                LEFT JOIN `#__artdata_data` as d ON d.id=v.dataset_source";

        if ($this->getState('search')) {
            $sql .= " WHERE v.name LIKE '%".$this->getState('search')."%'";
        }

        $sql .= " ORDER BY v.name ASC";

        $db->setQuery($sql);
        return $db->loadObjectList();
    }

    /**
     * Populate user state requests
     */
    function populateState(){

        $app = JFactory::getApplication();

        //limits states
        //$limit = $app->getUserStateFromRequest('limit','limit',10);
        //$limitstart = $app->getUserStateFromRequest('limitstart','limitstart',0);
        $search = $app->getUserStateFromRequest('art-data-search','art-data-search',0);

        // In case limit has been changed, adjust it
        //$limitstart = ($limit != 0) ? (floor($limitstart / $limit) * $limit) : 0;
                
        //set states
        //$this->setState('artidcomlogapi_transmissions_limit', $limit);
        //$this->setState('artidcomlogapi_transmissions_limitstart', $limitstart);
        $this->setState('search', $search);
        
    }

    public function getVisualizationRequestData($data,$edit=false) {
        $visualization = array();
        $chartConfig = $this->getChartConfig();
        $user = JFactory::getUser();
        $app = JFactory::getApplication();
        if ($edit) {
            $visualizationType = $app->input->getString('art-data-edit-type');
            if (count($data) > 0) {
                foreach($data as $datum) {

                    if ($datum->name == 'art-data-edit-type') {
                        $visualization['type'] = $datum->value;
                    } elseif ($datum->name == 'art-data-edit-visualization-table-template-id') {
                        if ( $visualizationType == 'StaticTable' || $visualizationType == 'DynamicTable' ) {
                            if ($datum->value !="") {
                                $visualization['template_id'] = $datum->value;

                                //echo 'table template_id = '.$datum->value.'<br />';
                            }
                        }
                    } elseif ($datum->name == 'art-data-edit-visualization-chart-template-id') {
                        
                        if ($visualizationType != 'StaticTable' && $visualizationType != 'DynamicTable') {
                            if ($datum->value !="") {
                                $visualization['template_id'] = $datum->value;

                                //echo 'chart template_id = '.$datum->value.'<br />';
                            }
                        }

                    } else {
                        $propertyName = str_replace('art-data-edit-visualization-','',$datum->name);
                        $propertyName = str_replace('-','_',$propertyName);
                        
                        if (in_array($propertyName,$chartConfig['inputNames'])) { //this is a chart config item
                            $chartConfig['inputNames'][$propertyName] = $datum->value;
                        } else { 
                            if ( ($datum->value !="") || ($datum->value==0) ) { 

                                $visualization[$propertyName] = $datum->value;
                                /*if ($propertyName == 'template_id') {
                                    echo 'template_id = '.$datum->value;
                                    echo '<pre>';
                                    var_dump($visualization);
                                    echo '</pre>';

                                }*/
                            }                            
                        }
                    }

                }
            }
            $visualization['modified'] = date('Y-m-d H:i:s');
            $visualization['modified_by'] = $user->id;     

            /*echo '<pre>';
            var_dump($visualization);
            echo '</pre>';
            die();*/

        } else {
            if (count($data) > 0) {
                $visualizationType = $app->input->getString('art-data-type');
                foreach($data as $datum) {

                    if ($datum->name == 'art-data-type') {
                        $visualization['type'] = $datum->value;
                    } elseif ($datum->name == 'art-data-new-visualization-table-template-id') {
                        if ( $visualizationType == 'StaticTable' || $visualizationType == 'DynamicTable' ) {
                            if ($datum->value !="") {
                                $visualization['template_id'] = $datum->value;

                                //echo 'table template_id = '.$datum->value.'<br />';
                            }
                        }
                    } elseif ($datum->name == 'art-data-new-visualization-chart-template-id') {
                        
                        if ($visualizationType != 'StaticTable' && $visualizationType != 'DynamicTable') {
                            if ($datum->value !="") {
                                $visualization['template_id'] = $datum->value;

                                //echo 'chart template_id = '.$datum->value.'<br />';
                            }
                        }

                    } else {
                        $propertyName = str_replace('art-data-new-visualization-','',$datum->name);
                        $propertyName = str_replace('-','_',$propertyName);
                        
                        if (in_array($propertyName,$chartConfig['inputNames'])) { //this is a chart config item
                            $chartConfig['inputNames'][$propertyName] = $datum->value;
                        } else {
                            if ($datum->value !="") { 
                                $visualization[$propertyName] = $datum->value;
                            }                            
                        }
                    }

                }
            }
            $visualization['created'] = date('Y-m-d H:i:s');
            $visualization['modified'] = date('Y-m-d H:i:s');
            $visualization['modified_by'] = $user->id;
        }

        //if this is a chart lets organize the chart config stuff
        if ( ($visualization['type'] !='DynamicTable') && ($visualization['type'] !='StaticTable') ) {
            foreach ($chartConfig['inputNames'] as $key => $value) {
                $configName = str_replace('config_','',$key);
                $configNameParts = explode('_',$configName);
                $chartConfig['values']->$configNameParts[0]->$configNameParts[1] = $value;
            }

            $visualization['chart_config'] = json_encode($chartConfig['values']);
        }    
        
            /*echo '<pre>';
            var_dump($visualization);
            echo '</pre>';
            die();*/

        return $visualization;
    }

    public function getChartConfig() {
        $values = new stdClass;
        $values->graph = new stdClass;
        $values->graph->orientation = 'Horizontal';
        $values->meta = new stdClass;
        $values->meta->caption = '';
        $values->meta->subcaption = '';
        $values->meta->hlabel = '';
        $values->meta->hsublabel = '';
        $values->meta->vlabel = '';
        $values->meta->vsublabel = '';
        $values->meta->isDownloadable = 'true';
        $values->meta->downloadLabel = 'Download';

        return array(
                       'inputNames' => array(
                                                'config_graph_orientation' => 'Horizontal',
                                                'config_meta_caption' => '',
                                                'config_meta_subcaption' => '',
                                                'config_meta_hlabel' => '',
                                                'config_meta_hsublabel' => '',
                                                'config_meta_vlabel' => '',
                                                'config_meta_vsublabel' => '',
                                                'config_meta_isDownloadable' => 'true',
                                                'config_meta_downloadLabel' => 'Download'
                                            ),
                       'values' => $values
                    );        
    }

    public function populateChartConfigObj() {

    }

    public function getHtmlInput($inputName) {
        $inputOptions = JFilterInput::getInstance(
            array(
                'img','p','a','u','i','b','strong','span','div','ul','li','ol','h1','h2','h3','h4','h5',
                'table','tr','td','th','tbody','theader','tfooter','br'
            ),
            array(
                'src','width','height','alt','style','href','rel','target','align','valign','border','cellpading',
                'cellspacing','title','id','class'
            )
        );

        $postData = new JInput($_POST, array('filter' => $inputOptions));

        return $postData->get($inputName, '', 'HTML');
    }

    public function store() {

        $input = JFactory::getApplication()->input;

        //Load visualizations table class
        $table = JTable::getInstance('Visualizations','ArtDataTable');        


        if ($input->getInt('art-data-edit-item-id') > 0) { //we're editing
            $table->load($input->getInt('art-data-edit-item-id'));
            $data = json_decode($input->getString('art-data-edit-visualization-structure'));
            $visualization = $this->getVisualizationRequestData($data,true);
            $visualization['id'] = $input->getInt('art-data-edit-item-id');  

            /*echo '<pre>';
            var_dump($visualization);
            echo '</pre>';
            die();*/

        } else { //we're creating new
            $data = json_decode($input->getString('art-data-new-visualization-structure'));
            $visualization = $this->getVisualizationRequestData($data);
        }

        if ($visualization['data_source'] == 'html') {

            $inputName = ($input->getInt('art-data-edit-item-id') > 0) ? 'art-data-edit-html-content' : 'art-data-html-content' ;
            $visualization['data_source_content'] = $this->getHtmlInput($inputName);

            //echo $visualization['data_source_content'];die();
        } elseif ($visualization['data_source'] == 'sql') {

            $inputName = ($input->getInt('art-data-edit-item-id') > 0) ? 'art-data-edit-html-content' : 'art-data-html-content' ;
            $visualization['data_source_content'] = $input->get($inputName,'','RAW');
            
        }

        // Bind the data to the table
        if (!$table->bind($visualization)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$table->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
     
        // Store the web link table to the database
        if (!$table->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;

    }

    public function removeItem($visualizationId) {
        $db = JFactory::getDBO();
        $sql = "DELETE FROM `#__artdata_visualizations` WHERE `id`=".$visualizationId;
        $db->setQuery($sql);
        $db->execute();
        return true;
    }

    public function togglePublishing($state,$visualizationId) {
        $db = JFactory::getDBO();
        $sql = "UPDATE `#__artdata_visualizations` SET `published`='".$state."' WHERE `id`=".$visualizationId;
        $db->setQuery($sql);
        $db->execute();
        return true;
    }

    public function duplicate($visualizationId) {

        //die($visualizationId);

        $user = JFactory::getUser();
        $db = JFactory::getDBO();
        $sql = "SELECT `name`,
                       `published`,
                       `show_title`,
                       `access`,
                       `description`,
                       `type`,
                       `data_source_type`,
                       `dataset_source`,
                       `data_source`,
                       `data_source_csv_entry`,
                       `data_source_csv_delimiter`,
                       `data_source_content`,
                       `data_source_db_type`,
                       `data_source_connection_details_db_host`,
                       `data_source_connection_details_db_name`,
                       `data_source_connection_details_db_user`,
                       `data_source_connection_details_db_password`,
                       `template_id`,
                       `convert_links_images`,
                       `links_pattern`,
                       `links_no_follow`,
                       `links_new_window`,
                       `config_graph_orientation`,
                       `config_meta_caption`,
                       `config_meta_subcaption`,
                       `config_meta_hlabel`,
                       `config_meta_hsublabel`,
                       `config_meta_vlabel`,
                       `config_meta_vsublabel`,
                       `config_meta_isDownloadable`,
                       `config_meta_downloadLabel`
                FROM `#__artdata_visualizations` WHERE `id`=".$visualizationId;
        $db->setQuery($sql);
        $visualization = $db->loadObject();
        $visualization->name = $visualization->name.' (copy)';
        $visualization->created = date('Y-m-d H:i:s');
        $visualization->modified = date('Y-m-d H:i:s');
        $visualization->modified_by = $user->id;

        //Load visualizations table class
        $table = JTable::getInstance('Visualizations','ArtDataTable');  

        // Bind the data to the table
        if (!$table->bind($visualization)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$table->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
     
        // Store the web link table to the database
        if (!$table->store()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }


}