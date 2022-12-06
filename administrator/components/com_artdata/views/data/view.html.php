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
 * ArtData view class for a list of visualizations.
 */
class ArtDataViewData extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$model = $this->getModel();
		$input = JFactory::getApplication()->input;

		$this->state = $this->get('State');
		$this->items = $model->getListItems();

		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_artdata/assets/libraries/handsontable/handsontable.full.css');
		$document->addStyleSheet('components/com_artdata/assets/css/default-preview.css');

		//get a single record for editing
        if ($input->getInt('id')) {
        	$this->item = $model->getDataset($input->getInt('id'));
        	$document->addScriptDeclaration('window.ArtDataDataset = '.json_encode($this->item).';'); 
        }

		//check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
        $this->addUIkitJs();
		$this->addToolbar();
		$this->addArtDataScripts();

		parent::display($tpl);
	}

	/**
	 * Add events javascript in body.
	 *
	 * @since	1.6
	 */
	protected function addArtDataScripts() {
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/data.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/menu.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/art-accordion.js\"></script>\n";

		if ($this->getLayout() == 'default_new') {
			$document = JFactory::getDocument();
			$document->addScript('components/com_artdata/assets/libraries/handsontable/handsontable.full.js');
			echo "<script type=\"text/javascript\" src=\"".JURI::root()."components/com_artdata/assets/libraries/d3/d3.js\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"".JURI::root()."components/com_artdata/assets/libraries/uvcharts/uvcharts.js\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/edit-dataset.js\"></script>\n";
		}

	}

	/**
	* Method to add UIkit main js file to body of document
	* We're going to utilize j3x core jquery version to run this UI
	*
	*/
	protected function addUIkitJs() {
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uikit/js/uikit.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uikit/js/components/tooltip.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"//code.jquery.com/ui/1.11.4/jquery-ui.js\"></script>\n";
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		$document = JFactory::getDocument();
		JToolBarHelper::title(JText::_('Art Data by Artetics.com'), 'data');

		$document->addStyleDeclaration('.icon-data {background-image:url("components/com_artdata/assets/images/art-table-logo-14.png"); }');

		//get the menu bar and add it to dom
		if ($this->getLayout() == 'default_new') {
			$artDataAdminMenuBar = 'var artDataAdminMenuBar = \''.ArtDataHelper::getArtDataAdminMenuBar('data',true,array('back','save','saveclose')).'\';';
		} else {
			$artDataAdminMenuBar = 'var artDataAdminMenuBar = \''.ArtDataHelper::getArtDataAdminMenuBar('data',true).'\';';
		}
 		$document->addScriptDeclaration($artDataAdminMenuBar);
        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.checked_out' => JText::_('COM_ARTCALENDAR_MESSAGES_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_ARTCALENDAR_MESSAGES_CHECKED_OUT_TIME'),
		'a.created_by' => JText::_('COM_ARTCALENDAR_MESSAGES_CREATED_BY'),
		);
	}

    
}
