<?php
/**
 * @version	2.2.7
 * @package	Search Plugin for ArtData
 * @copyright Artetics.com Copyright (c) 2016
 * @license	GNU General Public License
 * @author	Mike Hill <info@artetics.com>
 * @url		http://artetics.com
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
* Art Data search method
*
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string matching option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
* @param mixed An array if the search it to be restricted to areas, null if search all
*/

class plgSearchArtDataSearch extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	
	/**
	 * @return array An array of search areas
	 */
	/*function onContentSearchAreas() {
		static $areas = array(
			'jomclassifieds' => 'Search Job Listings'
			);
			return $areas;
	} */
	
	function onContentSearch( $text, $phrase='', $ordering='', $areas=null )
	{
		/*if (is_array($areas)) {
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
				return array();
			}
		} */

		$db 		= JFactory::getDBO();
		$nullDate	= $db->getNullDate();
		$now 		= JFactory::getDate();

		$text = trim( $text );
		/*if ($text == '') {
			return array();
		} */

		$sql = "SELECT `id`,  
					   `name`,  
					   `description` 
				FROM `#__artdata_visualizations` 
				WHERE `name` 
				LIKE '%".$text."%'";

		$db->setQuery($sql);
		$searchResults = $db->loadObjectList();

		//var_dump($searchResults);die();
	/*	$menu = JSite::getMenu();
		$menuItem = $menu->getItems( 'menutype', 'Job Listings', true );
		$Itemid = $menuItem->id;*/

		$results = array();
		if (count($searchResults) > 0) {
			foreach($searchResults as $search) {
				$arr = array(
								'title' => $search->name,
							 	'text' => $search->description,
							 	'href' => 'index.php?option=com_artdata&view=visualizations&id='.$search->id,
							 );
				$results[] = (object)$arr;
			}
		}

		//var_dump($results);die();

		return $results;

	}
}
?>