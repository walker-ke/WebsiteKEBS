<?php
/**  
 * JS APP renderer system plugin - opera con i parametri del componente
 * @package SCREENREADER::plugins::system
 * @author Joomla! Extensions Store 
 * @copyright (C) 2015 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html  
 */
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.plugin.plugin' );
jimport ( 'joomla.filesystem.file' );
class plgSystemScreenReader extends JPlugin {
	/**
	 * onAfterInitialise handler
	 *
	 * Aggiunge nel page document output la JS APP
	 *
	 * @access public
	 * @return null
	 */
	function onAfterDispatch() {
		$app = JFactory::getApplication ();
		// Execute solo nel frontend
		if (! $app->getClientId ()) {
			// Check for menu exclusion
			$menu = $app->getMenu ()->getActive ();
			if (is_object ( $menu )) {
				$menuItemid = $menu->id;
				$menuExcluded = $this->params->get ( 'screenreader_exclusions', 0 );
				if (is_array ( $menuExcluded ) && ! in_array ( 0, $menuExcluded, false ) && in_array ( $menuItemid, $menuExcluded )) {
					return;
				}
			}

			// load the language object and the translation accordingly
			$language = JFactory::getLanguage ();
			$langTag = $language->getTag ();
			
			// Check for language exclusion
			$excludedLanguages = $this->params->get ( 'excluded_languages', array() );
			if(in_array($langTag, $excludedLanguages)) {
				return;
			}
			
			if($this->params->get ( 'sef_lang_code', 1 )) {
				$explodedLangTag = explode ( '-', $langTag );
				$langCode = array_shift ( $explodedLangTag );
			} else {
				$langCode = $langTag;
			}
			
			$token = md5 ( $_SERVER ["HTTP_HOST"] );
			
			// Security safe
			if (! JFile::exists ( JPATH_SITE . '/plugins/system/screenreader/screenreader/languages/' . $langTag . '.js' )) {
				$langTag = 'en-GB';
			}
			
			$base = JURI::base ();
			// Ottenimento document
			$doc = JFactory::getDocument ();
			// Output JS APP nel Document
			if (class_exists ( 'JInput' )) {
				$tmplType = $app->input->get('tmpl');
			} else {
				$legacyRequestClass = 'J' . 'Request';
				$tmplType = $legacyRequestClass::getCmd ( 'tmpl' );
			}
			if ($doc->getType () !== 'html' || $tmplType === 'component') {
				return false;
			}
			JHTML::_ ( 'behavior.framework' );
			
			// Gestione params plugin php / options plugin js
			$pparams = new stdClass ();
			$pparams->volume_tts = $this->params->get ( 'volume_tts', 80 );
			$pparams->chunksize = $this->params->get ( 'chunksize', 80 );
			$pparams->position = $this->params->get ( 'corner_position', 'bottomright' );
			$pparams->template = $this->params->get ( 'template', 'main.css' );
			$pparams->scrolling = $this->params->get ( 'scrolling', 'fixed' );
			$pparams->target_appendto = $this->params->get ( 'target_appendto', 'html' );
			$pparams->target_append_mode = $this->params->get ( 'target_append_mode', 'bottom' );
			$pparams->hide_on_mobile = $this->params->get ( 'hide_on_mobile', 0 );
			$pparams->use_minimized_toolbar = $this->params->get ( 'use_minimized_toolbar', 0 );
			$pparams->preload = $this->params->get ( 'preload', 0 );
			$pparams->auto_background_color = $this->params->get ( 'auto_background_color', 1 );
			$pparams->read_page = $this->params->get ( 'read_page', 1 );
			$pparams->read_child_nodes = $this->params->get ( 'read_child_nodes', 1 );
			$pparams->exclude_scripts = $this->params->get ( 'exclude_scripts', 1 );
			$pparams->ie_highcontrast = $this->params->get ( 'ie_highcontrast', 1 );
			$pparams->ie_highcontrast_advanced = $this->params->get ( 'ie_highcontrast_advanced', 1 );
			
			$pparams->read_images = $this->params->get ( 'read_images', 0 );
			$pparams->read_images_attribute = $this->params->get ( 'read_images_attribute', 'alt' );
			$pparams->read_images_ordering = $this->params->get ( 'read_images_ordering', 'before' );
			
			$pparams->mainpage_selector = trim ( $this->params->get ( 'mainpage_selector', '*[name*=main], *[class*=main], *[id*=main], *[id*=container], *[class*=container]' ), ',' );
			$pparams->showlabel = $this->params->get ( 'showlabel', 1 );
			$pparams->screenreader = $this->params->get ( 'screenreader', 1 );
			$pparams->highcontrast = $this->params->get ( 'highcontrast', 1 );
			$pparams->highcontrast_alternate = $this->params->get ( 'highcontrast_alternate', 1 );
			$pparams->highcontrast_alternate_color_hue = $this->params->get ( 'highcontrast_alternate_color_hue', 180 );
			$pparams->highcontrast_alternate_color_brightness = $this->params->get ( 'highcontrast_alternate_color_brightness', 6 );
			$pparams->dyslexic_font = $this->params->get ( 'dyslexic_font', 1 );
			$pparams->fontsize = $this->params->get ( 'fontsize', 1 );
			$pparams->font_size_default = $this->params->get ( 'font_size_default', 80 );
			$pparams->font_size_min = $this->params->get ( 'font_size_min', 50 );
			$pparams->font_size_max = $this->params->get ( 'font_size_max', 200 );
			$pparams->fontsize_selector = trim ( $this->params->get ( 'fontsize_selector', '' ), ',' );
			$pparams->fontsize_selector_mode = $this->params->get ( 'fontsize_selector_mode', 1 );
			$pparams->fontsize_headers_increment = $this->params->get ( 'fontsize_headers_increment', 20 );
			$pparams->toolbar_bgcolor = $this->params->get ( 'toolbar_bgcolor', '#EEE' );
			$pparams->reader_engine = $this->params->get ( 'reader_engine', 'proxy_virtual' );
			$pparams->script_responsivevoice_loading = $this->params->get ( 'script_responsivevoice_loading', 'local' );
			// Check if mobile needs a separate reader engine
			$pparams->use_mobile_reader_engine = $this->params->get ( 'use_mobile_reader_engine', 0 );
			$pparams->mobile_reader_engine = $this->params->get ( 'mobile_reader_engine', 'proxy_virtual' );
			
			// Accessibility improvements
			$pparams->show_skip_to_contents = $this->params->get ( 'show_skip_to_contents', 0 );
			$pparams->skiptocontents_selector = $this->params->get ( 'skiptocontents_selector', '' );
			$pparams->enable_focus_outline = $this->params->get ( 'enable_focus_outline', 0 );
			$pparams->enable_focus_outline_color = $this->params->get ( 'enable_focus_outline_color', '#F00' );
			$pparams->enable_focus_outline_bordersize = $this->params->get ( 'enable_focus_outline_bordersize', '2px' );
			$pparams->remove_links_target = $this->params->get ( 'remove_links_target', 0 );
			
			// Accesskeys
			$pparams->accesskey_play = trim($this->params->get ( 'accesskey_play', 'P' ));
			$pparams->accesskey_pause = trim($this->params->get ( 'accesskey_pause', 'E' ));
			$pparams->accesskey_stop = trim($this->params->get ( 'accesskey_stop', 'S' ));
			$pparams->accesskey_increase = trim($this->params->get ( 'accesskey_increase', 'O' ));
			$pparams->accesskey_decrease = trim($this->params->get ( 'accesskey_decrease', 'U' ));
			$pparams->accesskey_reset = trim($this->params->get ( 'accesskey_reset', 'R' ));
			$pparams->accesskey_highcontrast = trim($this->params->get ( 'accesskey_highcontrast', 'H' ));
			$pparams->accesskey_highcontrast2 = trim($this->params->get ( 'accesskey_highcontrast2', 'J' ));
			$pparams->accesskey_highcontrast3 = trim($this->params->get ( 'accesskey_highcontrast3', 'K' ));
			$pparams->accesskey_dyslexic = trim($this->params->get ( 'accesskey_dyslexicfont', 'D' ));
			$pparams->accesskey_skiptocontents = trim($this->params->get ( 'accesskey_skiptocontents', 'C' ));
			$pparams->accesskey_minimized = trim($this->params->get ( 'accesskey_minimized', 'L' ));
			
			// Ensure that the chunk length is correct for Google
			if($pparams->reader_engine == 'proxy' && $pparams->chunksize > 100) {
				$pparams->chunksize = 90;
			}
			
			// Ensure that the chunk length is correct for Virtual Readers
			if($pparams->reader_engine == 'proxy_virtual' && $pparams->chunksize >= 300) {
				$pparams->chunksize = 280;
			}
			
			$jQueryInclusion = $this->params->get ( 'jquery_include', true );
			
			$doc->addStyleSheet ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/controller/css/' . $pparams->template );
			
			if ($jQueryInclusion) {
				if (version_compare ( JVERSION, '3.0', '>=' )) {
					JHtml::_ ( 'jquery.framework' );
				} else {
					$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/jquery/jquery.js' );
				}
			}
			
			if($this->params->get('force_jquery_deferred', 0)) {
				$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/jquery/jquery.js', 'text/javascript', true, false  );
			}
			$scriptLoading = $this->params->get('script_loading', 'deferred') == 'deferred' ? true : false;
			
			$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/languages/' . $langTag . '.js' );
			
			// Screen reader script
			$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/tts/soundmanager/soundmanager2.js' );
			
			// Async scripts to avoid jQuery prototype overriding
			$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/tts/tts.js', 'text/javascript', $scriptLoading, false );
			$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/controller/controller.js', 'text/javascript', $scriptLoading, false );
			
			// Add the responsivevoice script
			if($pparams->reader_engine == 'proxy_responsive' || ($pparams->use_mobile_reader_engine && $pparams->mobile_reader_engine == 'proxy_responsive')) {
				if($pparams->script_responsivevoice_loading == 'local') {
					$doc->addScript ( JURI::root ( true ) . '/plugins/system/screenreader/screenreader/libraries/tts/responsivevoice.js', 'text/javascript', $scriptLoading, false );
				} else {
					$doc->addScript ( 'https://code.responsivevoice.org/responsivevoice.js' );
				}
			}
			
			// Add focusable outline if enabled
			if($pparams->enable_focus_outline) {
				$doc->addStyleDeclaration(":focus{outline: $pparams->enable_focus_outline_bordersize solid $pparams->enable_focus_outline_color !important;}");
			}
			
			$doc->addScriptDeclaration ( "window.soundManager.url = '{$base}plugins/system/screenreader/screenreader/libraries/tts/soundmanager/swf/';
										  window.soundManager.debugMode = false;  
										  window.soundManager.defaultOptions.volume = $pparams->volume_tts;" );
			
			$doc->addScriptDeclaration ( "var screenReaderConfigOptions = {	baseURI: '$base',
																			token: '$token',
																			langCode: '$langCode',
																			chunkLength: $pparams->chunksize,
																			screenReaderVolume: '$pparams->volume_tts',
																			position: '$pparams->position',
																			scrolling: '$pparams->scrolling',
																			targetAppendto: '$pparams->target_appendto',
																			targetAppendMode: '$pparams->target_append_mode',
																			preload: $pparams->preload,
																			autoBackgroundColor: $pparams->auto_background_color,
																			readPage: $pparams->read_page,
																			readChildNodes: $pparams->read_child_nodes,
																			ieHighContrast: $pparams->ie_highcontrast,
																			ieHighContrastAdvanced: $pparams->ie_highcontrast_advanced,
																			excludeScripts: $pparams->exclude_scripts,
																			readImages: $pparams->read_images,
																			readImagesAttribute: '$pparams->read_images_attribute',
																			readImagesOrdering: '$pparams->read_images_ordering',
																			mainpageSelector: '$pparams->mainpage_selector',
																			showlabel: $pparams->showlabel,
																			screenreader: $pparams->screenreader,
																			highcontrast: $pparams->highcontrast,
																			highcontrastAlternate: $pparams->highcontrast_alternate,
																			colorHue: $pparams->highcontrast_alternate_color_hue,
																			colorBrightness: $pparams->highcontrast_alternate_color_brightness,
																			dyslexicFont: $pparams->dyslexic_font,
																			fontsize: $pparams->fontsize,
																			fontsizeDefault: $pparams->font_size_default,
																			fontsizeMin: $pparams->font_size_min,
																			fontsizeMax: $pparams->font_size_max,
																			fontsizeSelector: '$pparams->fontsize_selector',
																			fontSizeOverride: $pparams->fontsize_selector_mode,
																			fontSizeHeadersIncrement: $pparams->fontsize_headers_increment,
																			toolbarBgcolor: '$pparams->toolbar_bgcolor',
																			template: '$pparams->template',
																			accesskey_play: '$pparams->accesskey_play',
																			accesskey_pause: '$pparams->accesskey_pause',
																			accesskey_stop: '$pparams->accesskey_stop',
																			accesskey_increase: '$pparams->accesskey_increase',
																			accesskey_decrease: '$pparams->accesskey_decrease',
																			accesskey_reset: '$pparams->accesskey_reset',
																			accesskey_highcontrast: '$pparams->accesskey_highcontrast',
																			accesskey_highcontrast2: '$pparams->accesskey_highcontrast2',
																			accesskey_highcontrast3: '$pparams->accesskey_highcontrast3',
																			accesskey_dyslexic: '$pparams->accesskey_dyslexic',
																			accesskey_skiptocontents: '$pparams->accesskey_skiptocontents',
																			accesskey_minimized: '$pparams->accesskey_minimized',
																			readerEngine: '$pparams->reader_engine',
																			useMobileReaderEngine: $pparams->use_mobile_reader_engine,
																			mobileReaderEngine: '$pparams->mobile_reader_engine',
																			hideOnMobile: $pparams->hide_on_mobile,
																			useMinimizedToolbar: $pparams->use_minimized_toolbar,
																			showSkipToContents: $pparams->show_skip_to_contents,
																			skipToContentsSelector: '$pparams->skiptocontents_selector',
																			removeLinksTarget: $pparams->remove_links_target
																		};" );
		}
	}
}