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
class ArtDataModelData extends JModelAdmin
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
    public function getTable($type = 'Data', $prefix = 'ArtDataTable', $config = array())
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
        $sql = "SELECT d.* 
                FROM `#__artdata_data` AS d";

        if ($this->getState('search')) {
            $sql .= " WHERE d.name LIKE '%".$this->getState('search')."%'";
        }

        $db->setQuery($sql);
        return $db->loadObjectList();
    }

    function getDataset($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_data` WHERE `id`='".$db->escape($id)."'";
        $db->setQuery($sql);
        return $db->loadObject();
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

    public function store() {

        $dataset = array();
        $input = JFactory::getApplication()->input;

        //Load visualizations table class
        $table = JTable::getInstance('Data','ArtDataTable');        

        if ($input->getInt('art-data-dataset-item-id') > 0) { //we're editing
            $table->load($input->getInt('art-data-dataset-item-id'));
            $dataset['id'] = $input->getInt('art-data-dataset-item-id');  

            $dataset['modified'] = date('Y-m-d H:i:s');

        } else { //we're creating new
            $dataset['created'] = date('Y-m-d H:i:s');
            $dataset['modified'] = date('Y-m-d H:i:s');
        }

        $dataset['name'] = $input->getString('art-data-dataset-name');
        $dataset['type'] = $input->getString('art-data-dataset-visualization-type');
        $dataset['series'] = $input->getString('art-data-dataset-series');
        $dataset['content'] = $input->getString('art-data-dataset-content');


        // Bind the data to the table
        if (!$table->bind($dataset)) {
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


        if ($input->getInt('art-data-dataset-item-id') > 0) { //we're editing
            return $input->getInt('art-data-dataset-item-id');
        } else {
            return $table->id;
        }

        return true;

    }

    public function removeItem($dataId) {
        $db = JFactory::getDBO();
        $sql = "DELETE FROM `#__artdata_data` WHERE `id`=".$dataId;
        $db->setQuery($sql);
        $db->execute();
        return true;
    }

    public function duplicate($dataId) {

        $db = JFactory::getDBO();
        $sql = "SELECT `name`,
                       `created`,
                       `modified`,
                       `type`,
                       `series`,
                       `content`
                FROM `#__artdata_data` WHERE `id`=".$dataId;
        $db->setQuery($sql);
        $dataset = $db->loadObject();
        $dataset->name = $dataset->name.' (copy)';
        $dataset->created = date('Y-m-d H:i:s');
        $dataset->modified = date('Y-m-d H:i:s');

        //Load visualizations table class
        $table = JTable::getInstance('Data','ArtDataTable');  

        // Bind the data to the table
        if (!$table->bind($dataset)) {
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