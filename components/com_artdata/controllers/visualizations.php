<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// No direct access.
defined('_JEXEC') or die;

//load and extend main controller class
require_once JPATH_COMPONENT.'/controller.php';

/**
 * Art Data visualizations dedicated controller class.
 */
class ArtDataControllerVisualizations extends ArtDataController
{

	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Visualizations', $prefix = 'ArtDataModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

 


}