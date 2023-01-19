<?php
/*
 * @version   1.0.1
 * @package   Output Desk Chat
 * @author    Srimax
 * @copyright Copyright (C) srimax.com and all rights reserved.
 * @license   GPLv2
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemOutput_desk_live_chat extends JPlugin
{
	function onAfterRender()
	{
		$app	= JFactory::getApplication();
		$format	= JRequest::getCmd('format');
		$tmpl	= JRequest::getCmd('tmpl');

		if ($app->isAdmin() || $format == 'raw' || $tmpl == 'component') {
			return;
		}

		$code = $this->params->get('code', '');
		if (empty($code)) 
			return;

		$body_content = JResponse::getBody();
		$body_content = str_replace ("</body>","<script language='javascript' type='text/javascript'>".$code."</script></body>", $body_content);

		JResponse::setBody($body_content);
		return true;
	}
}
