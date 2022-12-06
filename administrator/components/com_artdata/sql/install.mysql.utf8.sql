CREATE TABLE IF NOT EXISTS `#__artdata_visualizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  `show_title` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `data_source_type` varchar(255) NOT NULL,
  `dataset_source` int(11) NOT NULL,
  `data_source` varchar(255) NOT NULL,
  `data_source_csv_entry` varchar(255) NOT NULL,
  `data_source_csv_delimiter` varchar(255) NOT NULL,
  `data_source_content` text NOT NULL,
  `data_source_db_type` varchar(255) NOT NULL,
  `data_source_connection_details_db_host` varchar(255) NOT NULL,
  `data_source_connection_details_db_name` varchar(255) NOT NULL,
  `data_source_connection_details_db_user` varchar(255) NOT NULL,
  `data_source_connection_details_db_password` varchar(255) NOT NULL,
  `template_id` int(11) NOT NULL,
  `convert_links_images` int(11) NOT NULL,
  `links_pattern` varchar(255) NOT NULL,
  `links_no_follow` int(11) NOT NULL,
  `links_new_window` int(11) NOT NULL,
  `config_graph_orientation` varchar(255) NOT NULL,
  `config_meta_caption` varchar(255) NOT NULL,
  `config_meta_subcaption` varchar(255) NOT NULL,
  `config_meta_hlabel` varchar(255) NOT NULL,
  `config_meta_hsublabel` varchar(255) NOT NULL,
  `config_meta_vlabel` varchar(255) NOT NULL,
  `config_meta_vsublabel` varchar(255) NOT NULL,
  `config_meta_isDownloadable` int(11) NOT NULL,
  `config_meta_downloadLabel` varchar(255) NOT NULL,
  `pagination_limit` int(11) NOT NULL,
  `pagination_limit_options` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__artdata_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modifier_classes` text NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__artdata_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




