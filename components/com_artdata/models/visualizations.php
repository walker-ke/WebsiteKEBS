<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting ArtData visualizations
 */
class ArtDataModelVisualizations extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to get single visualization record.
     *
     * @param $id
     * @return stdClass
     * @since   2.2.0
     */
    public function getItem($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_visualizations` WHERE `id`='".$db->escape($id)."'";
        $db->setQuery($sql);
        return $db->loadObject(); 
    }

    public function getTemplate($templateId) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_templates` WHERE `id`=".$templateId;
        $db->setQuery($sql);
        return $db->loadObject();         
    }

    public function getSourceObj($item) {

        $source = new stdClass;


        $source->source_type = $item->data_source_type;
        $source->dataset = $item->dataset_source;
        $source->type = $item->data_source;
        $source->csv = new stdClass;
        $source->csv->source = $item->data_source_csv_entry;
        $source->csv->delimiter = $item->data_source_csv_delimiter;
        $source->content = $item->data_source_content;
        $source->db = new stdClass;
        $source->db->type = $item->data_source_db_type;
        $source->db->host = $item->data_source_connection_details_db_host;
        $source->db->name = $item->data_source_connection_details_db_name;
        $source->db->username = $item->data_source_connection_details_db_user;
        $source->db->password = $item->data_source_connection_details_db_password;

        return $source;
    }

    public function getSourceData($source) {

        $data = new stdClass;
        $items = array();

        switch($source->type) {
            case 'sql':

                if ($source->content == "") {
                    JFactory::getApplication()->enqueueMessage('Please enter your sql query in the Art Data administrator for this visualization.');
                    return array();
                }

                if ($source->db->type == 'mysql-joomla') {

                    $db = JFactory::getDBO();
                    $db->setQuery($source->content);
                    $items = $db->loadAssocList();

                } else {  

                    if ($source->db->type == 'sqlite') {

                        $dbh = new PDO('sqlite:'.$source->db->name); // success
                        $rows = $dbh->query($source->content);
                        foreach ($rows as $row) {
                            $items[] = $row;
                        }

                    } elseif ($source->db->type == 'mssql') {

                        $link = mssql_connect($source->db->host,$source->db->username,$source->db->password);
                        if ($link) {
                            mssql_select_db ( $source->db->name, $link ) or JFactory::getApplication()->enqueueMessage("Cannot connect to database ".$source->db->name." on host ".$source->db->host);
                            $r = mssql_query ( $source->content, $link ) or JFactory::getApplication()->enqueueMessage("Query error");
                            while ($row = mssql_fetch_assoc($r)) {
                                $items[] = $row;
                            }
                        }

                    } elseif ($source->db->type == 'odbc') {

                        $link = odbc_connect($source->db->host,$source->db->username,$source->db->password);
                        if ($link) {
                            $result = odbc_exec($link, $source->content);
                            while( $row = odbc_fetch_array($result) ) {
                                $items[] = $row;
                            }
                        }

                    } elseif ($source->db->type == 'sqlsrv') {

                        $connectionInfo = array("UID" => $source->db->username, "PWD" => $source->db->password, "Database"=> $source->db->name);
                        $link = sqlsrv_connect($source->db->host, $connectionInfo);
                        if ($link) {
                            $result = sqlsrv_query($link, $source->content);
                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            $items[] = $row;
                            }
                            sqlsrv_free_stmt($result);
                            sqlsrv_close($link);
                        }

                    } else {      

                        //ado db needed here  
                        require_once JPATH_SITE.'/components/com_artdata/assets/libraries/adodb/adodb.inc.php';

                        if ($source->db->type == 'mysql-other') {
                            $dbType = 'mysql';
                        } elseif ($source->db->type == 'postgresql') {
                            $dbType = 'postgres';
                        } elseif ($source->db->type == 'foxpro') {
                            $dbType = 'vfp';
                        } elseif ($source->db->type == 'etezza') {
                            $dbType = 'netezza';
                        } else {
                            $dbType = $source->db->type;
                        }

                        $db = ADONewConnection($dbType);

                        $result = $db->Connect($source->db->host,$source->db->username,$source->db->password,$source->db->name);

                        if (!$db->IsConnected()) {
                            JFactory::getApplication()->enqueueMessage("Cannot connect to database ".$source->db->name." on host ".$source->db->host);
                            return array();                            
                        }
                        $db->SetFetchMode(2); //only return associative
                        if ($dbType == 'mysql') {
                            $db->EXECUTE("set names 'utf8'"); 
                        }

                        $rows = $db->getAll($source->content);

                        //var_dump($rows->fields);echo 'meow';

                        if (count($rows) > 0) {
                            foreach ($rows as $row) {
                                $items[] = $row;
                            }
                        }

                        if ($db->ErrorNo()) {
                            JFactory::getApplication()->enqueueMessage("Error executing query ".$source->content." : ".$db->ErrorMsg());
                            return array();
                        }

                        $db->Close();

                    }

                }

                $headers = array();
                if (count($items) > 0) {
                    foreach ($items[0] as $key => $value) {
                        $headers[] = $key;
                    }
                }

                break;
            case 'html':

                if ($source->content !="") {
                    $dom = new domDocument;
                    $dom->loadHTML($source->content);

                    $headers = array();
                    $nodes = $dom->getElementsByTagName('tr');
                    $counter1 = 0;
                    foreach ($nodes as $node) {
                        $row = array();
                        if ($counter1 == 0) { //header row
                            foreach ($node->childNodes as $element) {
                                if (trim($element->nodeValue)) { //make sure the header isn't just whitespace
                                    $headers[] = trim($element->nodeValue);
                                }
                            }
                        } else {
                            $counter2 = 0;
                            foreach ($node->childNodes as $element) {
                                if (trim($element->nodeValue)) { //make sure the td content isn't just whitespace
                                    $row[ ArtDataHelper::camelize($headers[$counter2]) ] = $element->nodeValue;
                                    $counter2++;
                                }
                            }
                        } 
                        if (count($row) > 0) {
                            $items[] = $row;
                        }  
                        $counter1++;
                    }

                } else {
                    JFactory::getApplication()->enqueueMessage('Please enter your html table content in the Art Data administrator for this visualization.');
                }


                break;
            case 'csv':

                if ($source->csv->source == "") {
                    JFactory::getApplication()->enqueueMessage('Please enter the path to your csv file content in the Art Data administrator for this visualization.');
                    return array();
                }

                if (strstr($source->csv->source, 'http')) {
                    $f = fopen($source->csv->source, 'r');
                } else {
                    $f = fopen(JPATH_SITE . DIRECTORY_SEPARATOR. str_replace('/', DIRECTORY_SEPARATOR, $source->csv->source), 'r');
                }
                if ($f) {
                    $counter1 = 0;
                    $headers = array();
                    while (!feof($f)) { 
                        $item = array();
                        $row = fgetcsv($f,0,$source->csv->delimiter);
                        if ($counter1 == 0){
                               
                            $columns = count($row);
                            if ($columns > 0) {
                                for ($counter2=0;$counter2<$columns;$counter2++) {

                                    $headers[] = trim($row[$counter2]);

                                }
                            }   
                            
                        } else {

                            if ($row) {
                                $columns = count($row);
                                if ($columns > 0) {
                                    for ($counter2=0;$counter2<$columns;$counter2++) {
       
                                        if (array_key_exists($counter2,$row)) {
                                            $item[ ArtDataHelper::camelize($headers[$counter2]) ] = trim($row[$counter2]);
                                        }
                                        
                                    }
                                }   
                            }

                        }



                        if (count($item) > 0) {
                            $items[] = $item;
                        }
                            
                        

                        $counter1++;
                    }
                }

                break;

            default:

                break;
        }

        //echo '<pre>'.json_encode($items).'</pre>'; //debug

        $data->items = $items;
        $data->headers = $headers;

        return $data;
    }

    public function translateTableDataset($data) {
        $dataObj = new stdClass;
        $items = array();
        $headers = array();
        if (count($data) > 0) {
            foreach ($data as $key1 => $datum) {
                $item = array();
                if ($key1 > 0) {
                    foreach($data[0] as $key2 => $header) {
                        $item[ ArtDataHelper::camelize($header) ] = trim($datum[$key2]);
                    }

                    $items[] = $item;
                } else {
                    foreach($datum as $header) {
                        $headers[] = $header;
                    }                    
                }
                
            }
        }

        $dataObj->items = $items;
        $dataObj->headers = $headers;

        return $dataObj;
    }

    /**
    * translate a array of associative arrays into a usable chart object
    * written for a query that returns single series data
    * TODO -> handling multi series data (is this even possible?)
    *
    */
    public function translateChartCustomData($data) {

        $dataset = new stdClass;
        $dataset->series = array();
        $categories = array('series');

        foreach ($data->items as $key1 => $row) {

            foreach ($row as $key2 => $value) {
                $datum = new stdClass;
                $datum->name = $key2;
                $datum->value = $value;
                $dataset->series[] = $datum;
            }
      
        }

        $graphDefinition = new stdClass;
        $graphDefinition->categories = $categories;
        $graphDefinition->dataset = $dataset;

        return $graphDefinition;
    }

    function isImagePath($fileName) {
        $extensions = array('.jpeg', '.jpg', '.gif', '.png', '.bmp', '.tiff', '.tif', '.ico', '.svg');
        $extension = substr($fileName, strrpos($fileName,"."));
        if (in_array(strtolower($extension), $extensions)) {
            return true;
        } 

        return false;
    }

    function convertLinksImages($data,$visualization) {
        
        if (count($data) > 0) {

            $convertedData = array();

            $linkRegex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';

            foreach ($data as $row) {
                $newRow = array();
                foreach ($row as $key => $cell) {

                    //if there are links in the cell and it's not an image
                    if ( (preg_match_all($linkRegex,$cell,$match)) && (!$this->isImagePath($cell)) ) {

                        if ($visualization->convert_links_images == 1) { //convert links automatically

                            $linkHtml = '';
                            $linkHtml .= '<a ';
                            if ($visualization->links_no_follow) {
                                $linkHtml .= ' rel="nofollow" ';
                            }
                            if ($visualization->links_new_window) {
                                $linkHtml .= ' target="_blank" ';
                            }
                            $linkHtml .= 'href="'.htmlspecialchars($cell).'">'.htmlspecialchars($cell).'</a>';
                            $cell = $linkHtml;

                        } elseif ($visualization->convert_links_images == 2) { //convert links by pattern

                            if ($visualization->links_pattern !="") {
                                $cDelimiter = str_replace('TITLE', '', $visualization->links_pattern);
                                $cDelimiter = str_replace('URL', '', $cDelimiter);
                                $cellArray = explode($cDelimiter, $cell);

                                $linkHtml = '';
                                $linkHtml .= '<a ';
                                if ($visualization->links_no_follow) {
                                    $linkHtml .= ' rel="nofollow" ';
                                }
                                if ($visualization->links_new_window) {
                                    $linkHtml .= ' target="_blank" ';
                                }
                                $linkHtml .= 'href="'.htmlspecialchars($cellArray[1]).'">'.htmlspecialchars($cellArray[0]).'</a>';
                                $cell = $linkHtml;
                            } else {
                                $linkHtml = '';
                                $linkHtml .= '<a ';
                                if ($visualization->links_no_follow) {
                                    $linkHtml .= ' rel="nofollow" ';
                                }
                                if ($visualization->links_new_window) {
                                    $linkHtml .= ' target="_blank" ';
                                }
                                $linkHtml .= 'href="'.htmlspecialchars($cell).'">'.htmlspecialchars($cell).'</a>';
                                $cell = $linkHtml;
                            }

                        }

                    } else {
                        if ($this->isImagePath($cell)) {
                            $cell = '<img src="'.htmlspecialchars($cell).'" alt="image"/>';
                        }                        
                    }

                    $newRow[$key] = $cell; //add cell to row
                }

                $convertedData[] = $newRow; //add row to items array
            }

            return $convertedData;
        }

        return false;
    }

    function getCSVdata($string, $separator=",") {

        $elements = explode($separator, $string);
        for ($i = 0; $i < count($elements); $i++) {
            $nquotes = substr_count($elements[$i], '"');
            if ($nquotes %2 == 1) {
                for ($j = $i+1; $j < count($elements); $j++) {
                    if (substr_count($elements[$j], '"') > 0) {
                        // Put the quoted string's pieces back together again
                        array_splice($elements, $i, $j-$i+1,
                        implode($separator, array_slice($elements, $i, $j-$i+1)));
                        break;
                    }
                }
            }
            if ($nquotes > 0) {
                // Remove first and last quotes, then merge pairs of quotes
                $qstr =& $elements[$i];
                $qstr = substr_replace($qstr, '', strpos($qstr, '"'), 1);
                $qstr = substr_replace($qstr, '', strrpos($qstr, '"'), 1);
                $qstr = str_replace('""', '"', $qstr);
            }
        }

        return $elements;
    }

    function getArtDataDataset($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_data` WHERE `id`=".$id;
        $db->setQuery($sql);
        return $db->loadObject();
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);

    		if(empty($ordering)) {
    			$ordering = 'a.ordering';
    		}

        // List state information.
        parent::populateState($ordering, $direction);
    }

    public function getItems() {
        return parent::getItems();
    }

    


}
