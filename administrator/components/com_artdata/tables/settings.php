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
 * ArtData Settings Table class
 */
class ArtDataTableSettings extends JTable {

    var $api_client_id = null;
    var $api_user_id = null;   
    var $api_endpoint = null; 

    /**
     * Constructor
     *
     * @param JDatabase A database connector object
     */
    public function __construct(&$db) {
        parent::__construct('#__artdata_settings', 'id', $db);
    }

}
