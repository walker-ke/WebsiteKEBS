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

jimport('joomla.application.component.view');

/**
 * Art Data Data raw view class
 */
class ArtDataViewData extends JViewLegacy
{
	protected $items;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$input = JFactory::getApplication()->input;
		$task = $input->getString('task');
		$whitelist = array('Search');

		JSession::checkToken() or die( 'Invalid Token' );

		//execute the task
		if (in_array($task,$whitelist)) {
			$this->$task($this->getModel(),$input);
		}
	}

	public function Search() {
		$model = JModelLegacy::getInstance('Data','ArtDataModel'); 
		$response = new stdClass;
		$model->populateState();
		$response->status = true;
		$response->items = $model->getListItems();
		echo json_encode($response);		
	}

}
