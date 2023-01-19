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
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Google Token Generator
 *
 * Thanks to @helen5106 and @tehmaestro and few other cool guys
 * at https://github.com/Stichoza/google-translate-php/issues/32
 */
class GoogleTokenGenerator {
	/**
	 * Plugin params
	 * 
	 * @access private
	 * @var object
	 */
	private $pluginParams;
	
	/**
	 * Generate and return a token
	 *
	 * @param string $source
	 *        	Source language
	 * @param string $target
	 *        	Target language
	 * @param string $text
	 *        	Text to translate
	 * @return mixed A token
	 */
	public function generateToken($text) {
		if(!class_exists('JPluginHelper')) {
			jimport('joomla.plugin.helper');
		}
		$plugin = JPluginHelper::getPlugin('system', 'screenreader');
		$this->pluginParams = json_decode($plugin->params);
		
		return $this->TL ( $text );
	}
	
	/**
	 * Generate a valid Google Translate TKK token
	 *
	 * @access private
	 * @return string
	 */
	private function staticTKK() {
		$a = 561666268;
		$b = 1526272306;
		return 406398 . '.' . ($a + $b);
	}
	
	/**
	 * Generate a valid Google Translate TKK token
	 *
	 * @access private
	 * @return string
	 */
	private function TKK() {
		$session = JFactory::getSession();
		if($sessionGoogleToken = $session->get('screenreader_engine_google_token')) {
			return $sessionGoogleToken;
		}
			
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
				"Mozilla/5.0 (compatible; MSIE 10.0; Macintosh; Intel Mac OS X 10_7_3; Trident/6.0)" );
		$ua = $userAgents [rand ( 0, count ( $userAgents ) - 1 )];
		
		// Format the request header array
		$headers = array (
				'Cache-Control' => 'max-age=0',
				'User-Agent' => $ua,
				'Accept' => 'text/html',
				'Referer' => 'https://translate.google.com/',
				'Accept-Language' => 'en-GB, en'
		);
		
		// Request API GET Transport wrapper
		$HTTPClient = new jscrHttp ();
		$HTTPResponse = $HTTPClient->get ( "https://translate.google.com", $headers );
		
		if($HTTPResponse->code == '200') {
			$bodyResponsePage = $HTTPResponse->body;
			preg_match('/TKK.*return\s?-?\d+/', $bodyResponsePage, $AandBArray);
			
			if(is_array($AandBArray) && $AandBArray[0]) {
				$periodsExploded = explode(';', $AandBArray[0]);
				
				// First var $a
				$aExploded = explode('\x3d', $periodsExploded[0]);
				$a = $aExploded[1];
				
				// Second var $b
				$bExploded = explode('\x3d', $periodsExploded[1]);
				$b = $bExploded[1];
				
				// Third var hours Unix elapsed
				$hoursExploded = explode('return', $periodsExploded[2]);
				$hoursElapsed = trim($hoursExploded[1]);
				
				// Fallback if not valid
				if(!$a || !$b || !$hoursElapsed) {
					$a = 561666268;
					$b = 1526272306;
					$hoursElapsed = 406398;
				}
			} else {
				// Fallback if not valid
				$a = 561666268;
				$b = 1526272306;
				$hoursElapsed = 406398;
			}
		} else {
			// Fallback if not valid
			$a = 561666268;
			$b = 1526272306;
			$hoursElapsed = 406398;
		}
		
		$session->set('screenreader_engine_google_token', $hoursElapsed . '.' . ($a + $b));

		return $hoursElapsed . '.' . ($a + $b);
	}
	
	/**
	 * Generate a valid Google Translate request token
	 *
	 * @param string $a
	 *        	text to translate
	 * @return string
	 */
	private function TL($a) {
		// Evaluate the token generator mode, static values are default, otherwise scrape dynamic values from Google Translate
		if(isset($this->pluginParams->engine_google_token_mode) && $this->pluginParams->engine_google_token_mode) {
			$tkk = explode('.', $this->TKK());
		} else {
			$tkk = explode('.', $this->staticTKK());
		}
		
		$b = $tkk[0];
		
		for($d = array (), $e = 0, $f = 0; $f < mb_strlen ( $a, 'UTF-8' ); $f ++) {
			$g = $this->charCodeAt ( $a, $f );
			if (128 > $g) {
				$d [$e ++] = $g;
			} else {
				if (2048 > $g) {
					$d [$e ++] = $g >> 6 | 192;
				} else {
					if (55296 == ($g & 64512) && $f + 1 < mb_strlen ( $a, 'UTF-8' ) && 56320 == ($this->charCodeAt ( $a, $f + 1 ) & 64512)) {
						$g = 65536 + (($g & 1023) << 10) + ($this->charCodeAt ( $a, ++ $f ) & 1023);
						$d [$e ++] = $g >> 18 | 240;
						$d [$e ++] = $g >> 12 & 63 | 128;
					} else {
						$d [$e ++] = $g >> 12 | 224;
						$d [$e ++] = $g >> 6 & 63 | 128;
					}
				}
				$d [$e ++] = $g & 63 | 128;
			}
		}
		$a = $b;
		for($e = 0; $e < count ( $d ); $e ++) {
			$a += $d [$e];
			$a = $this->RL ( $a, '+-a^+6' );
		}
		$a = $this->RL ( $a, "+-3^+b+-f" );
		$a ^= $tkk[1];
		if (0 > $a) {
			$a = ($a & 2147483647) + 2147483648;
		}
		$a = fmod ( $a, pow ( 10, 6 ) );
		return $a . "." . ($a ^ $b);
	}
	
	/**
	 * Generate "b" parameter
	 * The number of hours elapsed, since 1st of January 1970
	 *
	 * @return double
	 */
	private function generateB() {
		$start = new DateTime ( '1970-01-01' );
		$now = new DateTime ( 'now' );
		
		$diff = $now->diff ( $start );
		
		return $diff->h + ($diff->days * 24);
	}
	
	/**
	 * Process token data by applying multiple operations
	 *
	 * @param
	 *        	$a
	 * @param
	 *        	$b
	 * @return int
	 */
	private function RL($a, $b) {
		for($c = 0; $c < strlen ( $b ) - 2; $c += 3) {
			$d = $b {$c + 2};
			$d = $d >= 'a' ? $this->charCodeAt ( $d, 0 ) - 87 : intval ( $d );
			$d = $b {$c + 1} == '+' ? $this->shr32 ( $a, $d ) : $a << $d;
			$a = $b {$c} == '+' ? ($a + $d & 4294967295) : $a ^ $d;
		}
		return $a;
	}
	
	/**
	 * Crypto function
	 *
	 * @param
	 *        	$x
	 * @param
	 *        	$bits
	 * @return number
	 */
	private function shr32($x, $bits) {
		if ($bits <= 0) {
			return $x;
		}
		if ($bits >= 32) {
			return 0;
		}
		$bin = decbin ( $x );
		$l = strlen ( $bin );
		if ($l > 32) {
			$bin = substr ( $bin, $l - 32, 32 );
		} elseif ($l < 32) {
			$bin = str_pad ( $bin, 32, '0', STR_PAD_LEFT );
		}
		return bindec ( str_pad ( substr ( $bin, 0, 32 - $bits ), 32, '0', STR_PAD_LEFT ) );
	}
	
	/**
	 * Get the Unicode of the character at the specified index in a string
	 *
	 * @param string $str        	
	 * @param int $index        	
	 * @return null number
	 */
	private function charCodeAt($str, $index) {
		$char = mb_substr ( $str, $index, 1, 'UTF-8' );
		if (mb_check_encoding ( $char, 'UTF-8' )) {
			$ret = mb_convert_encoding ( $char, 'UTF-32BE', 'UTF-8' );
			$result = hexdec ( bin2hex ( $ret ) );
			return $result;
		}
		return null;
	}
}
