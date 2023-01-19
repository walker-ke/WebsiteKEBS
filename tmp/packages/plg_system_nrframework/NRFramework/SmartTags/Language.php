<?php

/**
 * @author          Tassos.gr
 * @link            http://www.tassos.gr
 * @copyright       Copyright © 2021 Tassos Marinos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
*/

namespace NRFramework\SmartTags;

USE Joomla\CMS\Language\Text;

defined('_JEXEC') or die('Restricted access');

class Language extends SmartTag
{
	/**
	 * Fetch specific translation string value
	 * 
	 * @param   string  $key
	 * 
	 * @return  string
	 */
	public function fetchValue($key)
	{
		$key = strtolower($key);
		$key_parts = explode('_', $key);

		switch ($key_parts[0])
		{
			case 'com':
				if (isset($key_parts[1]) && !empty($key_parts[1]))
				{
					$extension = 'com_' . $key_parts[1];
				}

				\JFactory::getLanguage()->load($extension, JPATH_ADMINISTRATOR);
				\JFactory::getLanguage()->load($extension, JPATH_SITE);
				break;

			case 'plg':
				if (isset($key_parts[1]) && !empty($key_parts[1]) && isset($key_parts[2]) && !empty($key_parts[2]))
				{
					$extension = implode('_', ['plg', $key_parts[1], $key_parts[2]]);
				}

				$path = implode(DIRECTORY_SEPARATOR, [JPATH_PLUGINS, $key_parts[1], $key_parts[2]]);

				\JFactory::getLanguage()->load($extension, $path);
				break;
		}

		return Text::_($key);
	}
}