<?php
/**
 * @package		onWebChat.com Integration for Joomla!
 * @type		Plugin (System)
 * @filename	onwebchat.php
 * @folder		<root>/plugins/system/onwebchat
 * @version     1.1.0
 * @modified	17 August 2015
 * @author		onwebchat.com / onWebChat
 * @website		http://www.onwebchat.com
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @copyright (C) 2015 onwebchat.com
 *
 * This program can be used under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the License.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
**/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );

class  plgSystemOnWebchat extends JPlugin
{

	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}
	
	//Backward Compatibility with 1.5
	public function getParams(){
		if(version_compare(JVERSION,'2.5.0','ge')) return $this->params;
		$plugin = JPluginHelper::getPlugin('system', 'onwebchat');
		$params=class_exists('JParameter')? new JParameter($plugin->params) : new JRegistry($plugin->params);
		return $params;
	}
	
	public function onAfterRender() {
		$app =JFactory::getApplication();
		$doc =JFactory::getDocument();		
		if($app->isAdmin() || $doc->getType()!='html') return;
		
		$user = JFactory::getUser();
		$params=$this->getParams();	
		$buffer = JResponse::getBody();
		$chatid=JString::trim($params->get('chatid',''));
		if(empty($chatid)) return;
		
		$scripts=array();
		$scripts[]="<script type='text/javascript'>var onWebChat={ar:[], set: function(a,b){if (typeof onWebChat_==='undefined'){this.ar.push([a,b]);}else{onWebChat_.set(a,b);}},get:function(a){return(onWebChat_.get(a));},w:(function(){ var ga=document.createElement('script'); ga.type = 'text/javascript';ga.async=1;ga.src='//www.onwebchat.com/clientchat/".$chatid."';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})()}</script>";
		if(!$user->guest){
			$scripts[]='<script type="text/javascript">onWebChat.set("name","'.$user->name.'");onWebChat.set("email","'.$user->email.'");</script>';		
		}
		
		$buffer = str_replace("</body>",implode("\n",$scripts)."</body>",$buffer);
		JResponse::setBody($buffer);		
    }
}