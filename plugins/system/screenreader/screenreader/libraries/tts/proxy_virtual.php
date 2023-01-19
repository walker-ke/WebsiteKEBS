<?php
/**
 * Proxy della REST API di Google TTS
 * @package SCREENREADER::plugins::system
 * @subpackage screenreader
 * @subpackage libraries
 * @subpackage tts
 * @author Joomla! Extensions Store
 * @copyright (C) 2015 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html  
 */
ini_set ( 'display_errors', false );
// Joomla Init
define ( '_JEXEC', 1 );
defined ( '_JEXEC' ) or die ();
define ( 'JPATH_BASE', realpath ( '../../../../../../' ) );

if (file_exists(JPATH_BASE . '/defines.php')) {
	include_once JPATH_BASE . '/defines.php';
}

if (!defined('_JDEFINES')) {
	require_once JPATH_BASE.'/includes/defines.php';
}

require_once (JPATH_BASE . '/includes/framework.php');
$mainframe = JFactory::getApplication ( 'site' );

// testo
$text = preg_replace ( "/[" . PHP_EOL . "]+/", " ", ($GLOBALS['_' . strtoupper('get')] ['text']) );
// lingua
$lang = ($GLOBALS['_' . strtoupper('get')] ['lang']);
// security token same domain
$token = ($GLOBALS['_' . strtoupper('get')] ['token']);
// engine token if used by the engine
$engineToken = ($GLOBALS['_' . strtoupper('get')] ['engine_token']);

if ($token === md5 ( $_SERVER ['HTTP_HOST'] )) {
	// Lazy loading
	require_once '../http/http.php';
	if(!class_exists('JPluginHelper')) {
		jimport('joomla.plugin.helper');
	}
	$plugin = JPluginHelper::getPlugin('system', 'screenreader');
	$pluginParams = json_decode($plugin->params);
	$useSockets = (isset($pluginParams->reader_connection_usesockets) && $pluginParams->reader_connection_usesockets) ? true : false;
	
	// Random user agents DB
	$userAgents = array (
			"Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0",
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0",
			"Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0",
			"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0",
			"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36",
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1944.0 Safari/537.36",
			"Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36",
			"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A",
			"Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25",
			"Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
			"Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko",
			"Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)",
			"Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)",
			"Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/5.0)",
			"Mozilla/5.0 (compatible; MSIE 10.0; Macintosh; Intel Mac OS X 10_7_3; Trident/6.0)" 
	);
	$ua = $userAgents [rand ( 0, count ( $userAgents ) - 1 )];
	// Format the request header array
	$headers = array (
			'Host' => 'h-ir-ssd-1.acapela-group.com',
			'Cache-Control' => 'no-cache',
			'Connection' => 'keep-alive',
			'Pragma' => 'no-cache',
			'Range' => 'bytes=0-',
			'User-Agent' => $ua,
			'Accept' => '*/*',
			'Referer' => 'http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php',
			'Accept-Language' => 'en-US,en;q=0.8,de;q=0.6,es;q=0.4,fr;q=0.2,it;q=0.2,ru;q=0.2,ja;q=0.2,el;q=0.2,sk;q=0.2,nl;q=0.2,ar;q=0.2,sv;q=0.2' 
	);
	
	// Request API GET
	// Transport wrapper
	$HTTPClient = new jscrHttp ();
	
	// Mapped language to code
	$mappedLangCode = array (
			'ar-AR' => array('sonid0', 'Leila22k'),
			'ar-AE' => array('sonid0', 'Leila22k'),
			'ar-AA' => array('sonid0', 'Leila22k'),
			'ar' => array('sonid0', 'Leila22k'),
			'en-US' => array('sonid10', 'Karen22k'),
			'en-GB' => array('sonid9', 'Graham22k'),
			'en' => array('sonid9', 'Graham22k'),
			'fr-FR' => array('sonid15', 'Alice22k'),
			'fr' => array('sonid15', 'Alice22k'),
			'de-DE' => array('sonid16', 'Andreas22k'),
			'de' => array('sonid16', 'Andreas22k'),
			'es-ES' => array('sonid27', 'Maria22k'),
			'es' => array('sonid27', 'Maria22k'),
			'it-IT' => array('sonid18', 'fabiana22k'),
			'it' => array('sonid18', 'fabiana22k'),
			'nl-BE' => array('sonid4', 'Daan22k'),
			'nl-NL' => array('sonid5', 'Daan22k'),
			'nl' => array('sonid5', 'Daan22k'),
			'ca-ES' => array('sonid1', 'Laia22k'),
			'ca' => array('sonid1', 'Laia22k'),
			'cs-CZ' => array('sonid2', 'Eliska22k'),
			'cs' => array('sonid2', 'Eliska22k'),
			'da-DK' => array('sonid3', 'Mette22k'),
			'da' => array('sonid3', 'Mette22k'),
			'el-GR' => array('sonid17', 'Dimitris22k'),
			'el' => array('sonid17', 'Dimitris22k'),
			'ja-JP' => array('sonid19', 'Sakura22k'),
			'ja' => array('sonid19', 'Sakura22k'),
			'ko-KR' => array('sonid19', 'Minji22k'),
			'ko' => array('sonid19', 'Minji22k'),
			'nb-NO' => array('sonid22', 'Bente22k'),
			'nb' => array('sonid22', 'Bente22k'),
			'pl-PL' => array('sonid23', 'Ania22k'),
			'pl' => array('sonid23', 'Ania22k'),
			'pt-PT' => array('sonid25', 'Celia22k'),
			'pt-BR' => array('sonid24', 'Celia22k'),
			'pt' => array('sonid25', 'Celia22k'),
			'ru-RU' => array('sonid26', 'Alyona22k'),
			'ru' => array('sonid26', 'Alyona22k'),
			'sv-FI' => array('sonid29', 'Sanna22k'),
			'sv-SE' => array('sonid29', 'Sanna22k'),
			'sv' => array('sonid29', 'Sanna22k'),
			'tr-TR' => array('sonid33', 'Ipek22k'),
			'tr' => array('sonid33', 'Ipek22k'),
			
	);
	if(array_key_exists($lang, $mappedLangCode)) {
		$langNumericKey = $mappedLangCode[$lang][0];
		$langSelectedVoice = $mappedLangCode[$lang][1];
	} else {
		$langNumericKey = 'sonid9'; // Fallback always on english
	}
	
	// Make the first POST form request and get the HTML page including the MP3 link
	$qs = array (
			'myLanguages' => $langNumericKey,
			'MySelectedVoice' => $langSelectedVoice,
			'MyTextForTTS' => ($text),
			'SendToVaaS' => ''
	);
	
	// Remote POST using sockets or CURL lib
	if($useSockets) {
		$HTTPResponse = $HTTPClient->post ( "http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php", $qs, $headers );
	} else {
		$ch = curl_init();
		$url = "http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php";
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $qs);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$headers = array (
				'Cache-Control: no-cache',
				'Connection: keep-alive',
				'Pragma: no-cache',
				'Range: bytes=0-',
				'User-Agent' => $ua,
				'Accept: */*',
				'Referer: http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php',
				'Accept-Language: en-US,en;q=0.8,de;q=0.6,es;q=0.4,fr;q=0.2,it;q=0.2,ru;q=0.2,ja;q=0.2,el;q=0.2,sk;q=0.2,nl;q=0.2,ar;q=0.2,sv;q=0.2'
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		// execute post
		$HTTPResponse = new stdClass();
		$HTTPResponse->body = curl_exec ($ch);
		
		// close the connection
		curl_close ($ch);
	}
	
	// Now scrape the javascript var for the Mp3 file generated
	$mp3BinaryFile = preg_match("/(myPhpVar)\s=\s'(.*)'/i", $HTTPResponse->body, $matches);
	// Found a valid Mp3 file to play?
	if($mp3BinaryFile) {
		$opts = array(
				'http'=>array(
						'method'=>"GET",
						'header'=>"Accept-language: en\r\n" .
								  "Host: h-ir-ssd-1.acapela-group.com\r\n" .
								  "Cache-Control: no-cache\r\n" .
								  "Connection: keep-alive\r\n" .
								  "Pragma: no-cache\r\n" .
								  "Range: bytes=0-\r\n" .
								  "User-Agent: $ua\r\n" .
								  "Accept: */*\r\n" .
								  "Referer: http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php\r\n" .
								  "Accept-Language: en-US,en;q=0.8,de;q=0.6,es;q=0.4,fr;q=0.2,it;q=0.2,ru;q=0.2,ja;q=0.2,el;q=0.2,sk;q=0.2,nl;q=0.2,ar;q=0.2,sv;q=0.2'"
				)
		);
		
		$context = stream_context_create($opts);
		
		$binaryString = file_get_contents ($matches[2], false, $context );
		
		// If fopen is not enabled, fallback on the socket HTTP GET
		if(!$binaryString) {
			$socketHeadersArray = array("Accept-language" => "en",
					"Cache-Control" => "no-cache",
					"Connection" => "keep-alive",
					"Pragma" => "no-cache",
					"Range" => "bytes=0-",
					"User-Agent" => $ua,
					"Accept" => "*/*",
					"Referer" => "http://www.acapela-group.com/virtual-speaker/demo-tts/DemoHTML5Form_virtualspeakerV2.php",
					"Accept-Language" => "en-US,en;q=0.8,de;q=0.6,es;q=0.4,fr;q=0.2,it;q=0.2,ru;q=0.2,ja;q=0.2,el;q=0.2,sk;q=0.2,nl;q=0.2,ar;q=0.2,sv;q=0.2");
			$binaryString = $HTTPClient->get($matches[2], $socketHeadersArray)->body;
		}
		
		$download_size = strlen ( $binaryString );
	}
	
	
	// send the headers
	header ( "Pragma: public" ); // purge the browser cache
	header ( "Expires: 0" ); // ...
	header ( "Cache-Control:" ); // ...
	header ( "Cache-Control: public" ); // ...
	header ( "Content-Description: File Transfer" ); //
	header ( "Content-Type: audio/mpeg" ); // file type
	header ( "Content-Disposition: attachment; filename=tts.mp3" );
	header ( "Content-Transfer-Encoding: binary" ); // transfer method
	header ( "Content-Length: $download_size" ); // download length
	
	echo $binaryString;
}
exit ();?>