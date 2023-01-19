<?php
/*
 * @version   1.0.1
 * @package   Output Desk Chat
 * @author    Srimax
 * @copyright Copyright (C) srimax.com and all rights reserved.
 * @license   GPLv2
 */

require_once 'defineVars.php';

class JFormFieldOutputdeskAccount extends JFormField {

	/**
	 * Get the Input response.
	 * @since   3.4
	 */
	public function getInput() {

		$params = new Params($this->form->getFieldset());
		$msg	= $params->get('message');
		$name	= $params->get('name');
		if (empty($msg) && empty($name)) {
			return $this->showInput();
		}
		else {
			return $this->showOdesk($name);
		}
	}

	/**
	 * Show Output desk live chat details.
	 *
	 * @param   string  $name  Username.
	 * @return HTML code to show.
	 * @since   3.4
	 */
	public function showOdesk($name) {
		$html = '
			<table cellspacing="5" cellpadding="10" align="left" style="width:100%; padding:10px;" id="after_screen">
		        <tbody>
					<tr >
			          <td style="text-align:left;padding:10px; " ><p style="margin:0 0  50px 0;color:#58c2d5;font-size:28px;font-weight:bold;">'.JText::sprintf("PLG_OUTPUT_DESK_LIVE_CHAT_WELCOME", $name).'</p></td>
			        </tr>
					<tr >
			          <td style="text-align:left;padding:10px;" ><p style="margin:0 0  20px 0;font-weight:normal;font-size:18px; color:#444;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_LAUNCH_ODESK").'</p></td>
			        </tr>
					<tr >
			          <td style="font-weight:normal;font-size:18px;text-align:left;padding:10px;" >
						<p style="white-space:nowrap;font-size:12px;line-height:2.5;text-align:left;margin:0 0  50px 0">
						<a href="'.ODC_DASHBOARD_LINK.'?username='.$name.'" target="_blank" style="text-decotation:none; font-weight: bold; width: 86px;  padding: 6px; font-size: 18px; background: rgb(88, 194, 213) none repeat scroll 0% 0%; color: rgb(255, 255, 255); border: medium none;text-align:center; border-radius: 3px;text-shadow: none;margin-right: 10px;" class="btn">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_LAUNCH").'</a>
<span style="font-size:14px;margin:0px; color:#444; font-weight:normal;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_OPEN_TAB_MSG").'</span>
						</p>
					</td>
			        </tr>
					<tr >
			          <td style="text-align:left;padding:10px;" >
						<p style="white-space:nowrap;font-size:14px;margin:0px; color:#444; font-weight:normal; ">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_HAVING_ISSUES").'</p>
					</td>
			        </tr>
					<tr >
			          <td style="text-align:left;padding:10px;" >
						<p style="margin:0px; color:#444; font-weight:normal; font-size:14px;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_HELP_LINK").'</p>
					</td>
			        </tr>
				</tbody>
			</table>';
		return $html;
	}

	/**
	 * Show Output desk live chat input form.
	 *
	 * @return HTML code to show.
	 * @since   3.4
	 */
	public function showInput() {

		$uri = str_replace("/", "/", str_replace(JPATH_SITE, JURI::base(), dirname(__FILE__)));
		$uri = str_replace("/administrator/", "", $uri);

		JHTML::script($uri."/outputdesk.js", false, true);
		$html = '<script type="text/javascript" >
			var url="' . $uri . '/outputdeskajax.php' . '";
			</script>';
		$html.= '<style>#style-form .form-horizontal .controls { margin-left: 0px; }</style>';
		$html.= '
			<div class="ostatus" id="ostatus"></div>
			<table cellspacing="5" cellpadding="5" align="center" style="width:100%; color:#444;" id="before_screen">
            <tbody><tr >
              <td style="text-align:center; padding:15px 10px;" ><p style="margin:0px; color:#444;font-weight:bold;font-size:21px;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_WELCOME_SCREEN").'</p></td>
            </tr>
            <tr >
              <td style="text-align:center; padding:5px;"><img src="'.$uri.'/icon.png"></td>
            </tr>
            <tr >
              <td style="text-align:center;padding:5;" ><p style="margin:0px; font-weight:bold;font-size:25px;color:#58c2d5;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_CONGRATULATIONS").'</p></td>
            </tr>
            <tr >
              <td style="text-align:center; padding:20px 10px;"><p style="margin:0px; font-weight:bold;font-size:18px;color:#444;padding-bottom: 15px;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_SUCCESS_INSTALLED").'</p></td>
            </tr>
            <tr >
              <td style="text-align:center;padding:0;" ><p style="margin:0px; font-weight:bold;font-size:18px;color:#444;padding-bottom: 15px;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_LINK_UR_ACCOUNT").'</p></td>
            </tr>
			<tr >
			<td style="font-weight:bold;font-size:18px;text-align:center;" >
					 <table cellspacing="5" cellpadding="10" align="center" style="width:40%;border:1px solid;background:#58c2d5;color:#fff;border-style:dotted; padding:5px;">
							<tbody><tr >
							  <td style="width:38%;text-align:right; padding:15px 10px;"><p style="margin:0px; font-weight:bold;font-size:14px;color:#fff;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_USERNAME").'</p></td>
							  <td align="left" style="padding: 15px 10px;font-weight:bold;"><input size="40" type="text" id="username" name="username" placeholder="'.JText::_("PLG_OUTPUT_DESK_LIVE_PHOLDER_USERNAME").'" value="" style="font-weight:bold;"/></td>
							</tr>
							<tr >
							  <td style="width:38%;text-align:right;padding:15px 10px;"><p style="margin:0px; font-weight:bold;font-size:14px;color:#fff;">'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_PASSWORD").'</p></td>
							  <td align="left" style="padding: 15px 10px;font-weight:bold;"><input type="password" id="password" placeholder="'.JText::_("PLG_OUTPUT_DESK_LIVE_PHOLDER_PASSWORD").'" name="password" value=""  style="font-weight:bold;" /></td>
							</tr>
							  <tr>
								<td align="center" colspan="2"  style="padding: 15px 10px;">
									<input type="button" onclick="outputdesk_call();" onkeydown = "if (event.keyCode == 13) outputdesk_call(); "  value="'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_BTN").'" class="btn" style="font-weight:bold; color: #555;"/>
							</td>
							</tr>
							<tr>
							<td align="center" colspan="2"  style="padding: 15px 10px; padding-top:0px;"><p style="margin:0px; font-weight:bold;font-size:14px;color:#fff;">
								'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_SIGNUP").'</p>
							</td>
							</tr>
							<tr>
							  <td style="font-weight:bold;font-size:12px;text-align:center;padding:15px 10px;padding-top:0px;" align="center" colspan="2" >'.JText::_("PLG_OUTPUT_DESK_LIVE_CHAT_CHATBOX_MSG").'</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		<hr />';

		return $html;
	}

	public function fetchElement($name, $value, &$node, $control_name) {
		return $this->getInput();
	}
}

/**
 * Helper class to get plugin param values.
 *
 * @since   3.4
 */
class Params {

   private $fields;
        
   public function __construct($fields) {
      $this->fields = $fields;
   }
   
   public function get($param) {
         
      foreach($this->fields as $field) {
         if ( $field->name == 'jform[params]['.$param.']' || $field->name == 'jform[params]['.$param.'][]' ) {
            return $field->value;
         }
      }
      
   }
   
}
