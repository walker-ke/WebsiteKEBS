<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

require_once JPATH_COMPONENT.'/helpers/artdata.php'; //artdata main helper file
require_once JPATH_COMPONENT.'/classes/visualizations.php'; //visualizations class

//require the sublayout view class
if (!class_exists('ArteticsView')) {
	require_once JPATH_COMPONENT.'/helpers/view.php';
}

// Execute the task.
$controller	= JControllerLegacy::getInstance('ArtData');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
