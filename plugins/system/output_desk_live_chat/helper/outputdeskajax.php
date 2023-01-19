<?php
/*
 * @version   1.0.0
 * @package   Output Desk Chat
 * @author    Srimax
 * @copyright Copyright (C) srimax.com and all rights reserved.
 * @license   GPLv2
 */

define('_JEXEC', 1);

use Joomla\Registry\Registry;

$jpathbase = str_replace('/plugins/system/output_desk_live_chat/helper', '', dirname(__FILE__));
define('JPATH_BASE', $jpathbase . '/administrator');
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';
require_once JPATH_BASE . '/includes/helper.php';
require_once 'defineVars.php';

class outputdeskAjax extends JObject
{
	/**
	 * default function to call other functions.
	 * @since   3.4
	 */
	public function __construct($data = null)
	{
		$result = $this->getResponse();
	}

	/**
	 * Get the response and return output.
	 * @return JSON encode values.
	 * @since   3.4
	 */
	public function getResponse() 
	{
		$username = JRequest::getVar('username', "");
		$password = JRequest::getVar('password', "");
		$return	= array('success'=>true);
		if ($username != "" && $password != "") {
			$logindata   = array('username' => $username,"password" => $password);
			$response = $this->makeRequest(ODC_LOGIN_URL,$logindata);

			if (!empty($response)) {
				$loginresult = json_decode($response);
				if ( isset($loginresult->message) && strtolower($loginresult->message)=="fail"){
					$return['message']['error'][]	= "Username or Password did not match";
					$return['success']	= false;
				} else if (isset($loginresult->message) && strtolower($loginresult->message)=="success" && $loginresult){
					$return['result']	= $response;
				} else {
					$return['message']['error'][]	= "We can't reach Output Desk server";
					$return['success']	= false;
				}
			}
			else {
				$return['message']['error'][]	= "We can't reach Output Desk server";
				$return['success']	= false;
			}
		} else {
				$return['message']['error'][]	= "Could not logged in, check username and Password";
				$return['success']	= false;
		}
		echo json_encode($return, true);
		exit;
	}

	/**
	 * Call output desk server to get authentication using curl method.
	 * @return response get from output desck server.
	 * @since   3.4
	 */
	function makeRequest($url,$data){
		jimport('joomla.http.http');
		jimport('joomla.http.transport.curl');
		$reg = new Registry;
		$transport = new JHttpTransportCurl($reg);
		$http = new JHttp($reg, $transport);
		$response = $http->post($url,$data);
		if (!empty($response->body))
			return $response->body;
		else 
			return false;
	}
}
// Call class.
$outputdeskAjax		= new outputdeskAjax();
