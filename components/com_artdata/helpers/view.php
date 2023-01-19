<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// no direct access
defined('_JEXEC') or die; 

/**
 * Artetics view helper.
 */
class ArteticsView {

    /**
    * render html content from a layout
    * @param $layout (string) - the name of the file (without extension) to load from /layouts
    * @param $vars (array) - any extra data values that are needed for the layout
    */
    public function render($layout,$vars) {
        $whitelist = array('visualization');
        if (in_array($layout,$whitelist)) { //if this layout is whitelisted 
            $override = $this->getSubLayoutOverride($layout);   
            if ($override) { //the override exists so let's load
                //load layout html     

                //return $this->getSubLayoutContents($override);

                include($override);  
                return $html;              
            } else { //no override, load from layouts folder
                //load layout html     
                include(JPATH_SITE.'/components/com_artdata/layouts/'.$layout.'.php');
                //return $this->getSubLayoutContents(JPATH_SITE.'/components/com_artdata/layouts/'.$layout.'.php');
                return $html;      
            }
        } else {
            return 'No Layout Found';
        }
    }

    /**
    * add needed js and css resources to document head
    * @param $scripts (array of objects) - like this [{src:'',type:''}] src = path to script, type = how to load: addCustomTag or addScript
    * @param $stylesheets (array) - list of paths to stylesheets
    *
    */
    public function loadResources($scripts,$stylesheets) {

        //load styles and script resources
        $document = JFactory::getDocument();
        if (count($scripts) > 0) {
            foreach ($scripts as $script) {
                if ($script->type == 'addCustomTag') {
                    $document->addCustomTag('<script type="text/javascript" src="'.$script->src.'"></script>');
                } elseif ($script->type == 'addScript') {
                    $document->addScript($script->src);
                } elseif ($script->type == 'raw') {
                    echo '<script type="text/javascript" src="'.$script->src.'"></script>'."\n";
                }
            }
        }
        if (count($stylesheets) > 0) {
            foreach ($stylesheets as $stylesheet) {
                $document->addStyleSheet($stylesheet);
            }
        }  

    }

    private function getSubLayoutOverride($layout) {
        $path = $this->getTemplateOverridePath();
        $override = $path.$layout.'.php';
        if (file_exists($override)) {
            return $override;
        } else {
            return false;
        }
    }

    private function getTemplateOverridePath() {
        return JPATH_SITE.'/templates/'.JFactory::getApplication()->getTemplate().'/html/com_eb/sublayouts/';
    }

    private function getSubLayoutContents($layout) {
        ob_start();
        include $layout;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

}
