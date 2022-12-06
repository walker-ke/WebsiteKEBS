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
class ArtDataViewVisualizations extends JViewLegacy
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

		$this->state		= $this->get('State');
		//$this->settings = ArtDataHelper::getSettings();
		$this->items = $model->getListItems();
		//$this->items = array();


		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_artdata/assets/css/default-preview.css','text/css',null,array('title'=>'art-data-preview'));
		$document->addScriptDeclaration('window.VisualizationItems = '.json_encode($this->items).';');

		$this->chart_templates = ArtDataHelper::getChartTemplates(); 
        $document->addScriptDeclaration('window.ArtDataChartTemplates = '.json_encode($this->chart_templates).';'); 

        $this->table_templates = ArtDataHelper::getTableTemplates();
        $document->addScriptDeclaration('window.ArtDataTableTemplates = '.json_encode($this->table_templates).';'); 

        $this->datasets = ArtDataHelper::getDatasets();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
        $this->addUIkitJs();
		$this->addToolbar();
		$this->addArtDataScripts();

		//add the admin menu bar
		//echo ArtDataHelper::getArtDataAdminMenuBar();
        
        //$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add events javascript in body.
	 *
	 * @since	1.6
	 */
	protected function addArtDataScripts() {
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/visualizations.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/menu.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/art-accordion.js\"></script>\n";

		//table template manipulation
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/stylesheet-table.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/default-css.js\"></script>\n";
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
		JToolBarHelper::title(JText::_('Art Data by Artetics.com'), 'visualizations');

		$document->addStyleDeclaration('.icon-visualizations {background-image:url("components/com_artdata/assets/images/art-table-logo-14.png"); }');

		//get the menu bar and add it to dom
 		$artDataAdminMenuBar = 'var artDataAdminMenuBar = \''.ArtDataHelper::getArtDataAdminMenuBar('visualizations',true).'\';';
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
