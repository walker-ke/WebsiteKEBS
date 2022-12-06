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
 * ArtData visualizations Table class
 */
class ArtDataTableVisualizations extends JTable {

    var $id = null;
    var $name = null;   
    var $created = null; 
    var $modified = null; 
    var $modified_by = null; 
    var $published = null; 
    var $show_title = null; 
    var $access = null; 
    var $description = null; 
    var $type = null; 
    var $data_source_type = null;
    var $dataset_source = null;
    var $data_source = null; 
    var $data_source_csv_entry = null; 
    var $data_source_csv_delimiter = null; 
    var $data_source_content = null; 
    var $data_source_db_type = null; 
    var $data_source_connection_details_db_host = null; 
    var $data_source_connection_details_db_name = null; 
    var $data_source_connection_details_db_user = null; 
    var $data_source_connection_details_db_password = null; 
    var $template_id = null;
    var $convert_links_images = null;  
    var $links_pattern = null;  
    var $links_no_follow = null;  
    var $links_new_window = null; 
    var $config_graph_orientation = null; 
    var $config_meta_caption = null; 
    var $config_meta_subcaption = null; 
    var $config_meta_hlabel = null; 
    var $config_meta_hsublabel = null;  
    var $config_meta_vlabel = null; 
    var $config_meta_vsublabel = null;  
    var $config_meta_isDownloadable = null; 
    var $config_meta_downloadLabel = null;  
    var $pagination_limit = null; 
    var $pagination_limit_options = null; 

    /**
     * Constructor
     *
     * @param JDatabase A database connector object
     */
    public function __construct(&$db) {
        parent::__construct('#__artdata_visualizations', 'id', $db);
    }

}
