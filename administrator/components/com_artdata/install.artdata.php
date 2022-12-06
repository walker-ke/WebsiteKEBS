<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
/**
 * Script file of ArtData component
 */
class Com_ArtDataInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		$ArtDataInstallation = new ArtDataInstallation();

		/*
		* First handle creation and population of base data structure
		*/

		//does the visualizations table exist?
		if ($ArtDataInstallation->doesVisualizationsTableExist()) {
			//table exists
		} else {
			$ArtDataInstallation->createVisualizationsTable(); //create table
		}

		//does the data table exist?
		if ($ArtDataInstallation->doesDataTableExist()) {
			//table exists
		} else {
			$ArtDataInstallation->createDataTable(); //create table
		}

		//does the template table exist?
		if ($ArtDataInstallation->doesTemplateTableExist()) {
			if ($ArtDataInstallation->isTemplateTablePopulated()) {
				//table already populated so don't do anything
			} else {	
				$ArtDataInstallation->populateTemplateTable(); //populate table
			}
		} else {
			$ArtDataInstallation->createTemplateTable(); //create table
			$ArtDataInstallation->populateTemplateTable(); //populate table
		}

		/*
		* Second lets add any columns that might be missing for users that are installing as an update
		* plus any population of missing columns for update users
		*/

		//pagination limit column is new to 2.2.9
		$ArtDataInstallation->addVisualizationsPaginationLimitColumn();

		//pagination limit options column in new to 2.2.9
		$ArtDataInstallation->addVisualizationsPaginationLimitOptionsColumn();
		$ArtDataInstallation->populateVisualizationsPaginationLimitOptionsColumn(); //pagination limit options
		$ArtDataInstallation->populateVisualizationsDefaultPaginationLimitColumn(); //default pagination limit

		$ArtDataInstallation->updateTableTemplateSelectors(); //update template content to new 2.2.9 version

		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_artdata');
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_ARTDATA_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		$ArtDataInstallation = new ArtDataInstallation();

		/*
		* First handle creation and population of base data structure
		*/

		//does the visualizations table exist?
		if ($ArtDataInstallation->doesVisualizationsTableExist()) {
			//table exists
		} else {
			$ArtDataInstallation->createVisualizationsTable(); //create table
		}

		//does the data table exist?
		if ($ArtDataInstallation->doesDataTableExist()) {
			//table exists
		} else {
			$ArtDataInstallation->createDataTable(); //create table
		}

		//does the template table exist?
		if ($ArtDataInstallation->doesTemplateTableExist()) {
			if ($ArtDataInstallation->isTemplateTablePopulated()) {
				//table already populated so don't do anything
			} else {	
				$ArtDataInstallation->populateTemplateTable(); //populate table
			}
		} else {
			$ArtDataInstallation->createTemplateTable(); //create table
			$ArtDataInstallation->populateTemplateTable(); //populate table
		}

		/*
		* Second lets add any columns that might be missing for users that are installing as an update
		* plus any population of missing columns for update users
		*/

		//pagination limit column is new to 2.2.9
		$ArtDataInstallation->addVisualizationsPaginationLimitColumn();

		//pagination limit options column in new to 2.2.9
		$ArtDataInstallation->addVisualizationsPaginationLimitOptionsColumn();
		$ArtDataInstallation->populateVisualizationsPaginationLimitOptionsColumn(); //pagination limit options
		$ArtDataInstallation->populateVisualizationsDefaultPaginationLimitColumn(); //default pagination limit

		$ArtDataInstallation->updateTableTemplateSelectors(); //update template content to new 2.2.9 version

		// $parent is the class calling this method
		//echo '<p>' . JText::sprintf('COM_ARTDATA_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
		$parent->getParent()->setRedirectURL("index.php?option=com_artdata");
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		//echo '<p>' . JText::_('COM_ARTDATA_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		//echo '<p>' . JText::_('COM_ARTDATA_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}


class ArtDataInstallation {

	public function doesVisualizationsTableExist() {
		$db = JFactory::getDBO();
		$sql = "SHOW TABLES LIKE '".$db->getPrefix()."artdata_visualizations'";
		$db->setQuery($sql);
		$records = $db->loadObjectList();
		if (count($records) > 0) {
			return true;
		} else {
			return false;
		}		
	}

	public function createVisualizationsTable() {
		$db = JFactory::getDBO();

		//create the visualizations table
		$sql = "CREATE TABLE IF NOT EXISTS `#__artdata_visualizations` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(255) NOT NULL,
				  `created` datetime NOT NULL,
				  `modified` datetime NOT NULL,
				  `modified_by` int(11) NOT NULL,
				  `published` int(11) NOT NULL,
				  `show_title` int(11) NOT NULL,
				  `access` int(11) NOT NULL,
				  `description` text NOT NULL,
				  `type` varchar(255) NOT NULL,
				  `data_source_type` varchar(255) NOT NULL,
				  `dataset_source` int(11) NOT NULL,
				  `data_source` varchar(255) NOT NULL,
				  `data_source_csv_entry` varchar(255) NOT NULL,
				  `data_source_csv_delimiter` varchar(255) NOT NULL,
				  `data_source_content` text NOT NULL,
				  `data_source_db_type` varchar(255) NOT NULL,
				  `data_source_connection_details_db_host` varchar(255) NOT NULL,
				  `data_source_connection_details_db_name` varchar(255) NOT NULL,
				  `data_source_connection_details_db_user` varchar(255) NOT NULL,
				  `data_source_connection_details_db_password` varchar(255) NOT NULL,
				  `template_id` int(11) NOT NULL,
				  `convert_links_images` int(11) NOT NULL,
				  `links_pattern` varchar(255) NOT NULL,
				  `links_no_follow` int(11) NOT NULL,
				  `links_new_window` int(11) NOT NULL,
				  `config_graph_orientation` varchar(255) NOT NULL,
				  `config_meta_caption` varchar(255) NOT NULL,
				  `config_meta_subcaption` varchar(255) NOT NULL,
				  `config_meta_hlabel` varchar(255) NOT NULL,
				  `config_meta_hsublabel` varchar(255) NOT NULL,
				  `config_meta_vlabel` varchar(255) NOT NULL,
				  `config_meta_vsublabel` varchar(255) NOT NULL,
				  `config_meta_isDownloadable` int(11) NOT NULL,
				  `config_meta_downloadLabel` varchar(255) NOT NULL,
				  `pagination_limit` int(11) NOT NULL,
				  `pagination_limit_options` text NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		$db->setQuery($sql);
		$db->execute();		
	}

	public function doesDataTableExist() {
		$db = JFactory::getDBO();
		$sql = "SHOW TABLES LIKE '".$db->getPrefix()."artdata_data'";
		$db->setQuery($sql);
		$records = $db->loadObjectList();
		if (count($records) > 0) {
			return true;
		} else {
			return false;
		}		
	}

	public function createDataTable() {
		$db = JFactory::getDBO();

		//create the templates table
		$sql = "CREATE TABLE IF NOT EXISTS `#__artdata_data` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(255) NOT NULL,
				  `created` datetime NOT NULL,
				  `modified` datetime NOT NULL,
				  `type` varchar(255) NOT NULL,
				  `series` varchar(255) NOT NULL,
				  `content` text NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		$db->setQuery($sql);
		$db->execute();		
	}

	public function doesTemplateTableExist() {
		$db = JFactory::getDBO();
		$sql = "SHOW TABLES LIKE '".$db->getPrefix()."artdata_templates'";
		//echo $sql;
		$db->setQuery($sql);
		$records = $db->loadObjectList();
		//var_dump($records);die();
		if (count($records) > 0) {
			//echo 'template table exists';die();
			return true;
		} else {
			//echo 'template table does not exist';die();
			return false;
		}		
	}

	public function isTemplateTablePopulated() {
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM `#__artdata_templates`";
		$db->setQuery($sql);
		$records = $db->loadObjectList();
		if (count($records) > 0) { //if there are records
			//echo 'template table is populated';die();
			return true;
		} else {
			//echo 'template table is not populated';die();
			return false;
		}
	}

	public function createTemplateTable() {
		$db = JFactory::getDBO();

		//create the templates table
		$sql = "CREATE TABLE IF NOT EXISTS `#__artdata_templates` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(255) NOT NULL,
				  `created` datetime NOT NULL,
				  `modified` datetime NOT NULL,
				  `type` varchar(255) NOT NULL,
				  `content` text NOT NULL,
				  `modifier_classes` text NOT NULL,
				  `published` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		$db->setQuery($sql);
		$db->execute();		
	}

	public function populateTemplateTable() {

		$db = JFactory::getDBO();

		//insert the table templates
		$sql = "INSERT INTO `#__artdata_templates` (`id`, `name`, `created`, `modified`, `type`, `content`, `modifier_classes`, `published`) VALUES
				(1, 'Default Table', '2015-11-13 19:45:58', '2015-11-13 19:45:58', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"},{\"property\":\"font-size\",\"value\":\"14px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#fafafa\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"none\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"1px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":0,\"striped\":0,\"hover\":0}', 1),
				(2, 'Condensed Table', '2015-11-13 19:59:55', '2015-11-13 19:59:55', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"},{\"property\":\"font-size\",\"value\":\"14px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#fafafa\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"none\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"1px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":1,\"striped\":0,\"hover\":0}', 1),
				(3, 'Striped Table', '2015-11-13 20:00:17', '2015-11-13 20:00:17', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"},{\"property\":\"font-size\",\"value\":\"14px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#fafafa\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"none\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"1px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":0,\"striped\":1,\"hover\":0}', 1),
				(4, 'Modern Table', '2015-11-13 20:03:18', '2015-11-13 20:03:18', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"2px solid #dddddd\"},{\"property\":\"font-size\",\"value\":\"15px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"2px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#fafafa\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"2px solid #dddddd\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"2px solid #dddddd\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"2px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":0,\"striped\":0,\"hover\":0}', 1),
				(5, 'Blue Striped Table', '2016-02-23 20:30:31', '2016-02-23 20:30:31', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #00a8e6\"},{\"property\":\"font-size\",\"value\":\"14px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#95b3d7\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"1px solid \"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid \"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"1px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#00a8e6\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":0,\"striped\":1,\"hover\":1}', 1),
				(6, 'Orange Condensed Table', '2015-11-13 20:14:14', '2015-11-13 20:14:14', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"},{\"property\":\"font-size\",\"value\":\"15px\"},{\"property\":\"font-weight\",\"value\":\"normal\"},{\"property\":\"color\",\"value\":\"#f79646\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"1px solid #dddddd\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#eeece1\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"none\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"1px solid #dddddd\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#eeece1\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f79646\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":1,\"striped\":1,\"hover\":0}', 1),
				(7, 'Lavendar Modern Table', '2015-11-15 17:11:57', '2015-11-15 17:11:57', 'table', '[{\"selector\":\".art-data-table\",\"rules\":[{\"property\":\"border-collapse\",\"value\":\"collapse\"},{\"property\":\"border-spacing\",\"value\":\"0\"},{\"property\":\"margin-bottom\",\"value\":\"15px\"},{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\"* + .art-data-table\",\"rules\":[{\"property\":\"margin-top\",\"value\":\"15px\"}]},{\"selector\":\".art-data-table th\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"2px solid #b2a2c7\"},{\"property\":\"font-size\",\"value\":\"14px\"},{\"property\":\"font-weight\",\"value\":\"bold\"},{\"property\":\"color\",\"value\":\"#5f497a\"}]},{\"selector\":\".art-data-table td\",\"rules\":[{\"property\":\"padding\",\"value\":\"8px 8px\"},{\"property\":\"vertical-align\",\"value\":\"top\"},{\"property\":\"text-align\",\"value\":\"left\"},{\"property\":\"border-bottom\",\"value\":\"2px solid #b2a2c7\"}]},{\"selector\":\".art-data-table thead th\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"bottom\"}]},{\"selector\":\".art-data-table-middle, .art-data-table-middle td\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle !important\"}]},{\"selector\":\".art-data-table-striped tbody tr:nth-of-type(2n+1)\",\"rules\":[{\"property\":\"background\",\"value\":\"#e5e0ec\"}]},{\"selector\":\".art-data-table-condensed td\",\"rules\":[{\"property\":\"padding\",\"value\":\"4px 8px\"}]},{\"selector\":\".art-data-button\",\"rules\":[{\"property\":\"margin\",\"value\":\"0\"},{\"property\":\"border\",\"value\":\"2px solid #b2a2c7\"},{\"property\":\"overflow\",\"value\":\"visible\"},{\"property\":\"color\",\"value\":\"#b2a2c7\"},{\"property\":\"text-transform\",\"value\":\"none\"},{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"padding\",\"value\":\"0 12px\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"line-height\",\"value\":\"28px\"},{\"property\":\"min-height\",\"value\":\"30px\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"2px solid #b2a2c7\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-button:not(:disabled)\",\"rules\":[{\"property\":\"cursor\",\"value\":\"pointer\"}]},{\"selector\":\".art-data-button:hover, .art-data-button:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-button:active, .art-data-button.art-data-active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-button:disabled\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.06)\"},{\"property\":\"box-shadow\",\"value\":\"none\"}]},{\"selector\":\".art-data-button-small\",\"rules\":[{\"property\":\"min-height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"0 10px\"},{\"property\":\"line-height\",\"value\":\"23px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-button-large\",\"rules\":[{\"property\":\"min-height\",\"value\":\"40px\"},{\"property\":\"padding\",\"value\":\"0 15px\"},{\"property\":\"line-height\",\"value\":\"38px\"},{\"property\":\"font-size\",\"value\":\"0.001px\"}]},{\"selector\":\".art-data-clearfix\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-width-1-1\",\"rules\":[{\"property\":\"width\",\"value\":\"100%\"}]},{\"selector\":\".art-data-form\",\"rules\":[{\"property\":\"margin\",\"value\":\"0 !important\"}]},{\"selector\":\".art-data-input\",\"rules\":[{\"property\":\"vertical-align\",\"value\":\"middle\"},{\"property\":\"box-sizing\",\"value\":\"border-box\"},{\"property\":\"height\",\"value\":\"30px\"},{\"property\":\"width\",\"value\":\"206px\"},{\"property\":\"max-width\",\"value\":\"100%\"},{\"property\":\"padding\",\"value\":\"4px 6px\"},{\"property\":\"margin-bottom\",\"value\":\"0 !important\"},{\"property\":\"border\",\"value\":\"2px solid #b2a2c7\"},{\"property\":\"background\",\"value\":\"#ffffff\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"transition\",\"value\":\"all linear 0.2s\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-input:focus\",\"rules\":[{\"property\":\"border-color\",\"value\":\"99baca\"},{\"property\":\"outline\",\"value\":\"0\"},{\"property\":\"background\",\"value\":\"#f5fbfe\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-input.art-data-input-large\",\"rules\":[{\"property\":\"height\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"8px 6px\"},{\"property\":\"font-size\",\"value\":\"16px\"}]},{\"selector\":\".art-data-input.art-data-input-small\",\"rules\":[{\"property\":\"height\",\"value\":\"25px\"},{\"property\":\"padding\",\"value\":\"3px 3px\"},{\"property\":\"font-size\",\"value\":\"12px\"}]},{\"selector\":\".art-data-input.art-data-input-display-field\",\"rules\":[{\"property\":\"width\",\"value\":\"50px !important\"}]},{\"selector\":\".art-data-pagination\",\"rules\":[{\"property\":\"padding\",\"value\":\"0\"},{\"property\":\"list-style\",\"value\":\"none\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"font-size\",\"value\":\"16px\"},{\"property\":\"border-radius\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination:before, .art-data-pagination:after\",\"rules\":[{\"property\":\"content\",\"value\":\"\"},{\"property\":\"display\",\"value\":\"table\"}]},{\"selector\":\".art-data-pagination:after\",\"rules\":[{\"property\":\"clear\",\"value\":\"both\"}]},{\"selector\":\".art-data-pagination > li\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"font-size\",\"value\":\"1rem\"},{\"property\":\"vertical-align\",\"value\":\"top\"}]},{\"selector\":\".art-data-pagination > li:nth-child(n+2)\",\"rules\":[{\"property\":\"margin-left\",\"value\":\"5px\"}]},{\"selector\":\".art-data-pagination > li > a, .art-data-pagination > li > span\",\"rules\":[{\"property\":\"display\",\"value\":\"inline-block\"},{\"property\":\"min-width\",\"value\":\"16px\"},{\"property\":\"padding\",\"value\":\"3px 5px\"},{\"property\":\"line-height\",\"value\":\"20px\"},{\"property\":\"text-decoration\",\"value\":\"none\"},{\"property\":\"box-sizing\",\"value\":\"content-box\"},{\"property\":\"text-align\",\"value\":\"center\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"},{\"property\":\"border-radius\",\"value\":\"4px\"}]},{\"selector\":\".art-data-pagination > li > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#f5f5f5\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#444444\"},{\"property\":\"outline\",\"value\":\"none\"},{\"property\":\"border-color\",\"value\":\"rgba(0, 0, 0, 0.16)\"}]},{\"selector\":\".art-data-pagination > li > a:active\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#eeeeee\"},{\"property\":\"color\",\"value\":\"#444444\"}]},{\"selector\":\".art-data-pagination > .art-data-active > a\",\"rules\":[{\"property\":\"background\",\"value\":\"#b2a2c7\"},{\"property\":\"color\",\"value\":\"#ffffff\"},{\"property\":\"border-color\",\"value\":\"transparent\"},{\"property\":\"box-shadow\",\"value\":\"inset 0 0 5px rgba(0, 0, 0, 0.05)\"}]},{\"selector\":\".art-data-pagination > .art-data-disabled > a\",\"rules\":[{\"property\":\"background-color\",\"value\":\"#fafafa\"},{\"property\":\"color\",\"value\":\"#999999\"},{\"property\":\"border\",\"value\":\"1px solid rgba(0, 0, 0, 0.06)\"}]},{\"selector\":\".art-data-pagination-previous\",\"rules\":[{\"property\":\"float\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-next\",\"rules\":[{\"property\":\"float\",\"value\":\"right\"}]},{\"selector\":\".art-data-pagination-left\",\"rules\":[{\"property\":\"text-align\",\"value\":\"left\"}]},{\"selector\":\".art-data-pagination-right\",\"rules\":[{\"property\":\"text-align\",\"value\":\"right\"}]}]', '{\"condensed\":0,\"striped\":0,\"hover\":0}', 1);";
		$db->setQuery($sql);
		$db->execute();

		//insert the charts
		$sql = "INSERT INTO `#__artdata_templates` (`id`, `name`, `created`, `modified`, `type`, `content`, `modifier_classes`, `published`) VALUES
				(8, 'Default Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#7E6DA1\",\"#C2CF30\",\"#FF8900\",\"#FE2600\",\"#E3003F\",\"#8E1E5F\",\"#FE2AC2\",\"#CCF030\",\"#9900EC\",\"#3A1AA8\",\"#3932FE\",\"#3276FF\",\"#35B9F6\",\"#42BC6A\",\"#91E0CB\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(9, 'Plain Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#B1EB68\",\"#B1B9B5\",\"#FFA16C\",\"#9B64E7\",\"#CEE113\",\"#2F9CFA\",\"#CA6877\",\"#EC3D8C\",\"#9CC66D\",\"#C73640\",\"#7D9532\",\"#B064DC\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(10, 'Android Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#33B5E5\",\"#AA66CC\",\"#99CC00\",\"#FFBB33\",\"#FF4444\",\"#0099CC\",\"#9933CC\",\"#669900\",\"#FF8800\",\"#CC0000\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(11, 'Soft Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#9ED8D2\",\"#FFD478\",\"#F16D9A\",\"#A8D59D\",\"#FDC180\",\"#F05133\",\"#EDED8A\",\"#F6A0A5\",\"#9F218B\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(12, 'Simple Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#FF8181\",\"#FFB081\",\"#FFE081\",\"#EFFF81\",\"#BFFF81\",\"#90FF81\",\"#81FFA2\",\"#81FFD1\",\"#9681FF\",\"#C281FF\",\"#FF81DD\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(13, 'Egypt Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#3A3E04\",\"#784818\",\"#FCFCA8\",\"#C03C0C\",\"#F0A830\",\"#A8783C\",\"#FCFCFC\",\"#FCE460\",\"#540C00\",\"#C0C084\",\"#3C303C\",\"#1EA34A\",\"#606C54\",\"#F06048\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(14, 'Olive Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#18240C\",\"#3C6C18\",\"#60A824\",\"#90D824\",\"#A8CC60\",\"#789C60\",\"#CCF030\",\"#B4CCA8\",\"#D8F078\",\"#40190D\",\"#E4F0CC\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(15, 'Candid Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#AF5E14\",\"#81400C\",\"#E5785D\",\"#FEBFBF\",\"#A66363\",\"#C7B752\",\"#EFF1A7\",\"#83ADB7\",\"#528F98\",\"#BCEDF5\",\"#446B3D\",\"#8BD96F\",\"#E4FFB9\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(16, 'Sulphide Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#594440\",\"#0392A7\",\"#FFC343\",\"#E2492F\",\"#007257\",\"#B0BC4A\",\"#2E5493\",\"#7C2738\",\"#FF538B\",\"#A593A1\",\"#EBBA86\",\"#E2D9CA\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1),
				(17, 'Lint Chart', '2015-11-08 00:00:00', '2015-11-08 00:00:00', 'chart', '{\"meta\":{\"position\":\"#uv-div-donut\",\"caption\":\"Some Graphical Data\",\"subcaption\":\"Displayed for Chart Template Preview\",\"hlabel\":\"Data\",\"vlabel\":\"Years\"},\"graph\":{\"custompalette\":[\"#A8A878\",\"#F0D89C\",\"#60909C\",\"#242418\",\"#E49C30\",\"#54483C\",\"#306090\",\"#C06C00\",\"#C0C0C0\",\"#847854\",\"#6C3C00\",\"#9C3C3C\",\"#183C60\",\"#FCCC00\",\"#840000\",\"#FCFCFC\"],\"bgcolor\":\"#ffffff\",\"opacity\":1},\"dimension\":{\"width\":400,\"height\":400},\"axis\":{\"strokecolor\":\"#000000\",\"ticks\":8,\"padding\":5}}', '', 1);";
		$db->setQuery($sql);
		$db->execute();

	}

	/**
	* create column for pagination limit in visualizations table
	* @since v2.2.9
	*
	*
	**/
	public function addVisualizationsPaginationLimitColumn() {
		$db = JFactory::getDBO();
		//add color event column if it doesn't exist
		if (!$this->checkForPaginationLimit()) {
			//add the column it's missing
			$sql = "ALTER TABLE `#__artdata_visualizations` ADD COLUMN `pagination_limit` int(11) NOT NULL";
			$db->setQuery($sql);
			$db->execute();
		}
	}

	/**
	* check for pagination limit column in visualizations table
	* @since v2.2.9
	*
	*
	**/
	public function checkForPaginationLimit() {
		$db = JFactory::getDBO();
		$sql = "SHOW COLUMNS FROM `#__artdata_visualizations` LIKE 'pagination_limit'";
		$db->setQuery($sql);
		if ($db->loadObjectList()) {
			return true;
		} else {
			return false;
		}			
	}

	/**
	* create column for pagination limit options in visualizations table
	* @since v2.2.9
	*
	*
	**/
	public function addVisualizationsPaginationLimitOptionsColumn() {
		$db = JFactory::getDBO();
		//add color event column if it doesn't exist
		if (!$this->checkForPaginationLimitOptions()) {
			//add the column it's missing
			$sql = "ALTER TABLE `#__artdata_visualizations` ADD COLUMN `pagination_limit_options` text NOT NULL";
			$db->setQuery($sql);
			$db->execute();
		}
	}

	/**
	* check for pagination limit options column in visualizations table
	* @since v2.2.9
	*
	*
	**/
	public function checkForPaginationLimitOptions() {
		$db = JFactory::getDBO();
		$sql = "SHOW COLUMNS FROM `#__artdata_visualizations` LIKE 'pagination_limit_options'";
		$db->setQuery($sql);
		if ($db->loadObjectList()) {
			return true;
		} else {
			return false;
		}			
	}

	/**
	* populate pagination limit options if the column is empty
	* @since v2.2.9
	*
	*
	**/
	public function populateVisualizationsPaginationLimitOptionsColumn() {
		$db = JFactory::getDBO();
		$sql = "UPDATE `#__artdata_visualizations` 
				SET `pagination_limit_options`='5,10,15,20,50,100,200' 
				WHERE (`type`='StaticTable' OR `type`='DynamicTable') 
				AND `pagination_limit_options`=''";
		$db->setQuery($sql);
		$db->execute();		
	}

	/**
	* populate pagination limit if the column is empty
	* @since v2.2.9
	*
	*
	**/
	public function populateVisualizationsDefaultPaginationLimitColumn() {
		$db = JFactory::getDBO();
		$sql = "UPDATE `#__artdata_visualizations` 
				SET `pagination_limit`=10 
				WHERE (`type`='StaticTable' OR `type`='DynamicTable') 
				AND `pagination_limit`=0";
		$db->setQuery($sql);
		$db->execute();		
	}

	/**
	* @since v2.2.9
	* necessary for users upgrading from v2.2.8 or less
	* css changes have been made to table template selectors
	* iterate over existing template content data
	* and make the necesary changes
	*/
	public function updateTableTemplateSelectors() {

		$db = JFactory::getDBO();
		$sql = "SELECT * FROM `#__artdata_templates` WHERE `type`='table'";
		$db->setQuery($sql);
		$templates = $db->loadObjectList();

		if (count($templates) > 0) {
			foreach ($templates as $template) {

				$CssDeclarations = json_decode($template->content);
				$declarationsContainer = array();
				$changes = false;
		        foreach ($CssDeclarations as $declaration) {

		        	//reset the selectors that have been changed
		        	if ($declaration->selector == '.art-data-pagination > .art-data-disabled > span') {
		        		$declaration->selector = '.art-data-pagination > .art-data-disabled > a';
		        		$changes = true;
		        	}
		        	//reset the selectors that have been changed
		        	if ($declaration->selector == '.art-data-pagination > .art-data-active > span') {
		        		$declaration->selector = '.art-data-pagination > .art-data-active > a';
		        		$changes = true;
		        	}
		        	//exclude the two selectors that were removed
		        	if ($declaration->selector != '.art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus' &&
		                $declaration->selector != '.art-data-pagination > li > a:active') {

		        		$declarationsContainer[] = $declaration;

		        	} else {
		        		//its one of the excluded selectors
		        		//don't add it to container
		        		//set changes to true so that container is
		        		//written to template content in database 
		        		$changes = true;
		        	}

		        }

		        if ($changes) {
			        $content = json_encode($declarationsContainer);
			        $sql = "UPDATE `#__artdata_templates` SET `content`='".$content."' WHERE `id`=".$template->id;
					$db->setQuery($sql);
					$db->execute();
		        }

			}
		}

	}

}


?>