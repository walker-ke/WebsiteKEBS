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

jimport('joomla.application.component.controlleradmin');

/**
 * ArtData Visualizations list controller class.
 */
class ArtDataControllerVisualizations extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	Joomla 1.6
	 */
	public function getModel($name = 'Visualizations', $prefix = 'ArtDataModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

    /**
    * Method to initialize the saving of visualization data
    * @since ArtData v2.2.0
    */
    public function createNew() {
        $model = $this->getModel();
        $application = JFactory::getApplication();
        $model->store();
        $application->redirect('index.php?option=com_artdata&view=visualizations&action=visualization_created');         
    }

    /**
    * Method to initialize the saving of visualization data
    * @since ArtData v2.2.0
    */
    public function edit() {
        $model = $this->getModel();
        $application = JFactory::getApplication();
        $model->store();
        $application->redirect('index.php?option=com_artdata&view=visualizations&action=visualization_saved');         
    }

    /**
    * Method to initialize the removal of a visualization item
    * @since ArtData v2.2.0
    */
    public function remove() {
        $model = $this->getModel();
        $application = JFactory::getApplication();

        $model->removeItem( $application->input->getInt('art-data-item-id') );

        $application->redirect('index.php?option=com_artdata&view=visualizations&action=visualization_removed');

    }

    /**
    * Method to copy a record
    * @since ArtData v2.2.0
    */
    public function duplicate() {
        $model = $this->getModel();
        $application = JFactory::getApplication();
        //$id = $application->input->getString('art-data-duplicate-item-id');
        //die($id);

        $model->duplicate( $application->input->getInt('art-data-duplicate-item-id') );

        $application->redirect('index.php?option=com_artdata&view=visualizations&action=visualization_duplicated');

    }

    public function togglePublishing() {
        $model = $this->getModel();
        $application = JFactory::getApplication();

        $model->togglePublishing( $application->input->getInt('art-data-publishing-state'),$application->input->getInt('art-data-publishing-item-id') );

        $application->redirect('index.php?option=com_artdata&view=visualizations&action=visualization_saved');        
    }

    /**
    * Method to initialize the saving of settings data
    * @since 1.1
    */
    public function saveSettings() {
        $model = $this->getModel();
        $application = JFactory::getApplication();
        $model->saveSettings();
        $msg = JText::_('Your settings have been saved');
        $application->redirect('index.php?option=com_artdata&view=visualizations',$msg);   
    }


}