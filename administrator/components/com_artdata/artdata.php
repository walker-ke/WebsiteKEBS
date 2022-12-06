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

// Access check: is this user allowed to access the backend of this component?
if (!JFactory::getUser()->authorise('core.manage', 'com_artdata')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

//include dependencies
jimport('joomla.application.component.controller');

//require artcalendar main helper file
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/artdata.php';

//add global styles
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_artdata/assets/libraries/uikit/css/uikit.almost-flat.min.css'); //add uikit
$document->addStyleSheet('components/com_artdata/assets/libraries/uikit/css/components/tooltip.almost-flat.css'); //add tooltips
$document->addStyleSheet('components/com_artdata/assets/css/artdata.css'); //add base component css



//add artetics.com branding font stylesheets
$document->addStyleSheet('https://fonts.googleapis.com/css?family=Righteous');
$document->addStyleSheet('https://fonts.googleapis.com/css?family=Lato');

$controller	= JControllerLegacy::getInstance('ArtData');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
