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
class ArtDataControllerData extends JControllerAdmin
{
	/**
	 * Proxy for getModel.
	 * @since	Joomla 1.6
	 */
	public function getModel($name = 'Data', $prefix = 'ArtDataModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

    /**
    * Method to initialize the saving of dataset data
    * @since ArtData v2.2.0
    */
    public function save() {
        $model = $this->getModel();
        $app = JFactory::getApplication();

        //echo $app->input->getString('art-data-dataset-content');die();

        $id = $model->store();

        if ($app->input->getInt('art-data-dataset-after-processing-action') == 1) {
            $app->redirect('index.php?option=com_artdata&view=data&layout=default_new&id='.$id.'&action=dataset_saved');  
        } else {
            $app->redirect('index.php?option=com_artdata&view=data&action=dataset_saved');  
        }

               
    }

    /**
    * Method to initialize the removal of a visualization item
    * @since ArtData v2.2.0
    */
    public function remove() {
        $model = $this->getModel();
        $application = JFactory::getApplication();

        $model->removeItem( $application->input->getInt('art-data-item-id') );

        $application->redirect('index.php?option=com_artdata&view=data&action=dataset_removed');

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

        $application->redirect('index.php?option=com_artdata&view=data&action=dataset_duplicated');

    }



}