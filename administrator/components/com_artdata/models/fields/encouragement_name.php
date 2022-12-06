<?php
/**
 * @version     1.0.0
 * @package     com_hello
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Claims <claims.resources.mobile@gmail.com> - http://claimsresources.com
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldEncouragement_name extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'encouragement_name';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();
        
        
		//Load user
		//$user_id = $this->value;
		//if ($user_id) {
			//$user = JFactory::getUser($user_id);
		//} else {
			//$user = JFactory::getUser();
			$html[] = '<input type="text" name="'.$this->name.'" value="" />';
		//}
		//$html[] = "<div>".$user->name." (".$user->username.")</div>";
        
		return implode($html);
	}
}