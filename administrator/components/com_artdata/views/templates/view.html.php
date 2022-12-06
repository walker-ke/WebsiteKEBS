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
 * ArtData view class for a list of templates.
 */
class ArtDataViewTemplates extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 *
	 * @since   Joomla! 1.6s
	 */
	public function display($tpl = null)
	{
		$model = $this->getModel();
		$input = JFactory::getApplication()->input;
		$layout = $this->getLayout();

		$this->state		= $this->get('State');
		//$this->settings = ArtDataHelper::getSettings();
		$this->table_items = $model->getTableListItems();
		$this->chart_items = $model->getChartListItems();
		//$this->items = array();

		$document = JFactory::getDocument();
		//$document->addCustomTag('<link rel="stylesheet" type="text/css" href="components/com_artdata/assets/css/default-preview.css" title="art-data-preview" />');
		$document->addStyleSheet('components/com_artdata/assets/css/default-preview.css','text/css',null,array('title'=>'art-data-preview'));
		$document->addScriptDeclaration('window.TableTemplateItems = '.json_encode($this->table_items).';');
		$document->addScriptDeclaration('window.ChartTemplateItems = '.json_encode($this->chart_items).';');
		$document->addScriptDeclaration('window.ArtDataLayout = "'.$this->getLayout().'";');
		$document->addScriptDeclaration('window.JuriRoot = "'.JURI::root().'";');

		//if we're editing
		if ($input->getInt('id') > 0) {
			$this->item = $model->getTemplateItem( $input->getInt('id') );
			$document->addScriptDeclaration('window.ArtDataTemplateContent = '.$this->item->content.';');
			$document->addScriptDeclaration('window.TemplateItem = '.json_encode($this->item).';');
			$this->tmpl_content = json_decode($this->item->content);
		}

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
        $this->addUIkitJs();
		$this->addToolbar($layout);
		$this->addArtDataTemplateScripts($layout);
		
		parent::display($tpl);
	}

	/**
	 * Add javascript resources in body.
	 *
	 * @since	ArtData 2.2.0
	 */
	protected function addArtDataTemplateScripts($layout) {

		echo "<script src=\"components/com_artdata/assets/libraries/colorpicker/js/evol.colorpicker.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>\n";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css\">\n";
		echo "<link href=\"components/com_artdata/assets/libraries/colorpicker/css/evol.colorpicker.min.css\" rel=\"stylesheet\" type=\"text/css\">\n";

		if ($layout == 'default_new_table' || $layout == 'default_edit_table') {
			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/stylesheet-table.js\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/default-css.js\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/edit-table.js\"></script>\n";
		}
		if ($layout == 'default_new_chart' || $layout == 'default_edit_chart') {
			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/stylesheet-chart.js\"></script>\n";

			echo "<script type=\"text/javascript\" src=\"".JURI::root()."components/com_artdata/assets/libraries/d3/d3.js\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"".JURI::root()."components/com_artdata/assets/libraries/uvcharts/uvcharts.js\"></script>\n";

			echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/edit-chart.js\"></script>\n";
		}

		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/templates.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/menu.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/art-accordion.js\"></script>\n";

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
	 * @since   Joomla! 1.6
	 */
	protected function addToolbar($layout) {
		$document = JFactory::getDocument();
		JToolBarHelper::title(JText::_('Art Data by Artetics.com'), 'templates');

		if ( $layout == 'default_new_table' || 
		     $layout == 'default_new_chart' || 
		     $layout == 'default_edit_table' || 
		     $layout == 'default_edit_chart'  ) {

			//get the menu bar and add it to dom
 			$artDataAdminMenuBar = 'var artDataAdminMenuBar = \''.ArtDataHelper::getArtDataAdminMenuBar('templates',true,array('back','save','saveclose')).'\';';
		} else {
			//get the menu bar and add it to dom
 			$artDataAdminMenuBar = 'var artDataAdminMenuBar = \''.ArtDataHelper::getArtDataAdminMenuBar('templates',true,array('new')).'\';';
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
