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
 * ArtData Templates main model.
 */
class ArtDataModelTemplates extends JModelAdmin
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
     * @return  mixed   Object on success, false on failure.
     * @since   ArtData 2.2.0
     */
    public function getTemplateItem($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_templates` WHERE `id`=".$id;
        $db->setQuery($sql);
        return $db->loadObject();
    }   

    function getTableListItems() {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_templates` WHERE `type`='table'";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }

    function getChartListItems() {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_templates` WHERE `type`='chart'";
        $db->setQuery($sql);
        return $db->loadObjectList();
    }

    /**
     * Populate user state requests
     */
    function populateState(){

        $app = JFactory::getApplication();

        //limits states
        $limit = $app->getUserStateFromRequest('artidcomlogapi_transmissions_limit','artidcomlogapi_transmissions_limit',10);
        $limitstart = $app->getUserStateFromRequest('artidcomlogapi_transmissions_limitstart','artidcomlogapi_transmissions_limitstart',0);

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0) ? (floor($limitstart / $limit) * $limit) : 0;
                
        //set states
        $this->setState('artidcomlogapi_transmissions_limit', $limit);
        $this->setState('artidcomlogapi_transmissions_limitstart', $limitstart);
        
    }

    public function store() {

        $input = JFactory::getApplication()->input;
        $data = array();

        //Load templates table class
        $table = JTable::getInstance('Templates','ArtDataTable');        

        if ($input->getInt('art-data-edit-id') > 0) {
            $table->load($input->getInt('art-data-edit-id'));
            $data['id'] = $input->getInt('art-data-edit-id');
        }

        //template name
        $data['name'] = $input->getString('art-data-new-template-name-value');

        //dates
        $now = date('Y-m-d H:i:s');
        $data['created'] = $now;
        $data['modified'] = $now;

        //template type
        $data['type'] = $input->getString('art-data-new-template-type');

        //template content
        $data['content'] = $input->getString('art-data-new-template-content');

        //modifier classes
        $modifiers = new stdClass;
        $modifiers->condensed = $input->getInt('art-data-new-template-condensed-value');
        $modifiers->striped = $input->getInt('art-data-new-template-striped-value');
        $modifiers->hover = $input->getInt('art-data-new-template-hover-value');
        $data['modifier_classes'] = json_encode($modifiers);

        $data['published'] = 1;

        // Bind the data to the table
        if (!$table->bind($data)) {
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

        if ($input->getInt('art-data-edit-id')) {
            return $input->getInt('art-data-edit-id');
        } else {
            $db = $table->getDBO();
            return $db->insertid();
        }
        
    }

    public function removeItem($templateId) {
        $db = JFactory::getDBO();
        $sql = "DELETE FROM `#__artdata_templates` WHERE `id`=".$templateId;
        $db->setQuery($sql);
        $db->execute();
        return true;
    }

    public function duplicate($templateId) {

        $db = JFactory::getDBO();
        $sql = "SELECT `name`,
                       `type`,
                       `content`,
                       `modifier_classes`,
                       `published`
                FROM `#__artdata_templates` WHERE `id`=".$templateId;
        $db->setQuery($sql);
        $template = $db->loadObject();
        $template->name = $template->name.' (copy)';
        $template->created = date('Y-m-d H:i:s');
        $template->modified = date('Y-m-d H:i:s');

        //Load visualizations table class
        $table = JTable::getInstance('Templates','ArtDataTable');  

        // Bind the data to the table
        if (!$table->bind($template)) {
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