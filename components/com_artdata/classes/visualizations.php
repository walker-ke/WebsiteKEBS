<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

//no direct access to this script
defined('_JEXEC') or die('Get thee gone!'); 

//error_reporting(E_ALL); //development

class ArtDataVisualizations {

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
 
    //renamed from getArtDataTemplate
    public function getTemplate($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_templates` WHERE `id`='".$db->escape($id)."'";
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

                //first check to see if query has {JOOMLAUSERID} anywhere
                if (strpos($source->content,'{JOOMLAUSERID}') !==false) {
                    $user = JFactory::getUser();
                    $source->content = str_replace('{JOOMLAUSERID}',$user->id,$source->content);
                
                    //echo $source->content.'<br /><br />';
                }
                    
                if ($source->db->type == 'mysql-joomla') {

                    $db = JFactory::getDBO();
                    $db->setQuery($source->content);
                    $items = $db->loadAssocList();

                    $headers = array();
                    $newItems = array();
                    if (count($items) > 0) {
                        $i = 0;
                        foreach ($items as $item) {
                            if ($i==0) {
                                foreach ($item as $key => $value) {
                                    $headers[] = $key;
                                }
                            }
                            $newRow = array();
                            foreach ($item as $key => $value) {
                                $newRow[ $this->camelize($key) ] = $value;
                            }
                            $newItems[] = $newRow;
                            $i++;
                        }
                    }
                    $items = $newItems;

                } else {  

                    if ($source->db->type == 'sqlite') {

                        $dbh = new PDO('sqlite:'.$source->db->name); // success
                        $rows = $dbh->query($source->content,PDO::FETCH_ASSOC);
                        foreach ($rows as $row) {
                            $items[] = $row;
                        }

                        $headers = array();
                        $newItems = array();
                        if (count($items) > 0) {
                            $i = 0;
                            foreach ($items as $item) {
                                if ($i==0) {
                                    foreach ($item as $key => $value) {
                                        $headers[] = $key;
                                    }
                                }
                                $newRow = array();
                                foreach ($item as $key => $value) {
                                    $newRow[ $this->camelize($key) ] = $value;
                                }
                                $newItems[] = $newRow;
                                $i++;
                            }
                        }
                        $items = $newItems;

                    } elseif ($source->db->type == 'mssql') {

                        $link = mssql_connect($source->db->host,$source->db->username,$source->db->password);
                        if ($link) {
                            mssql_select_db ( $source->db->name, $link ) or JFactory::getApplication()->enqueueMessage("Cannot connect to database ".$source->db->name." on host ".$source->db->host);
                            $r = mssql_query ( $source->content, $link ) or JFactory::getApplication()->enqueueMessage("Query error");
                            while ($row = mssql_fetch_assoc($r)) {
                                $items[] = $row;
                            }

                            $headers = array();
                            $newItems = array();
                            if (count($items) > 0) {
                                $i = 0;
                                foreach ($items as $item) {
                                    if ($i==0) {
                                        foreach ($item as $key => $value) {
                                            $headers[] = $key;
                                        }
                                    }
                                    $newRow = array();
                                    foreach ($item as $key => $value) {
                                        $newRow[ $this->camelize($key) ] = $value;
                                    }
                                    $newItems[] = $newRow;
                                    $i++;
                                }
                            }
                            $items = $newItems;

                        }

                    } elseif ($source->db->type == 'odbc') {

                        $link = odbc_connect($source->db->host,$source->db->username,$source->db->password);
                        if ($link) {
                            $result = odbc_exec($link, $source->content);
                            while( $row = odbc_fetch_array($result) ) {
                                $items[] = $row;
                            }

                            $headers = array();
                            $newItems = array();
                            if (count($items) > 0) {
                                $i = 0;
                                foreach ($items as $item) {
                                    if ($i==0) {
                                        foreach ($item as $key => $value) {
                                            $headers[] = $key;
                                        }
                                    }
                                    $newRow = array();
                                    foreach ($item as $key => $value) {
                                        $newRow[ $this->camelize($key) ] = $value;
                                    }
                                    $newItems[] = $newRow;
                                    $i++;
                                }
                            }
                            $items = $newItems;

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

                            $headers = array();
                            $newItems = array();
                            if (count($items) > 0) {
                                $i = 0;
                                foreach ($items as $item) {
                                    if ($i==0) {
                                        foreach ($item as $key => $value) {
                                            $headers[] = $key;
                                        }
                                    }
                                    $newRow = array();
                                    foreach ($item as $key => $value) {
                                        $newRow[ $this->camelize($key) ] = $value;
                                    }
                                    $newItems[] = $newRow;
                                    $i++;
                                }
                            }
                            $items = $newItems;

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

                        $headers = array();
                        if (count($rows) > 0) {
                            $i = 0;
                            foreach ($rows as $row) {
                                if ($i==0) {
                                    foreach ($row as $key => $value) {
                                        $headers[] = $key;
                                    }
                                }
                                $newRow = array();
                                foreach ($row as $key => $value) {
                                    $newRow[ $this->camelize($key) ] = $value;
                                }
                                $items[] = $newRow;
                                $i++;
                            }
                        }

                        if ($db->ErrorNo()) {
                            JFactory::getApplication()->enqueueMessage("Error executing query ".$source->content." : ".$db->ErrorMsg());
                            return array();
                        }

                        $db->Close();

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
                                    $row[ $this->camelize($headers[$counter2]) ] = $element->nodeValue;
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
                                            $item[ $this->camelize($headers[$counter2]) ] = trim($row[$counter2]);
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
                        $item[ $this->camelize($header) ] = trim($datum[$key2]);
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
    * this part of the software needs some attention
    * TODO 
    * not sure how this will behave with big select clauses (~line 456)
    * $datum->name = $values[0];
    * $datum->value = $values[1];
    */
    public function translateChartCustomData($data) {

        $dataset = new stdClass;
        $dataset->series = array();
        $categories = array('series');

        foreach ($data->items as $key1 => $row) {

            $values = array();
            foreach ($row as $key2 => $value) {
                $values[] = $value;
            }

            $datum = new stdClass;
            $datum->name = $values[0];
            $datum->value = $values[1];
            $dataset->series[] = $datum;
      
        }

        $graphDefinition = new stdClass;
        $graphDefinition->categories = $categories;
        $graphDefinition->dataset = $dataset;

        return $graphDefinition;
    }

    public function isImagePath($fileName) {
        $extensions = array('.jpeg', '.jpg', '.gif', '.png', '.bmp', '.tiff', '.tif', '.ico', '.svg');
        $extension = substr($fileName, strrpos($fileName,"."));
        if (in_array(strtolower($extension), $extensions)) {
            return true;
        } 

        return false;
    }

    public function convertLinksImages($data,$visualization) {
        
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

    public function getCSVdata($string, $separator=",") {

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

    public function getArtDataDataset($id) {
        $db = JFactory::getDBO();
        $sql = "SELECT * FROM `#__artdata_data` WHERE `id`=".$id;
        $db->setQuery($sql);
        return $db->loadObject();
    }

    public function addVisualizationScripts($type) {

        $document = JFactory::getDocument();
        if ($type == 'StaticTable' || $type == 'DynamicTable') {
            //this visualization is a tables
            //applying template styling to table 

            if ($type == 'DynamicTable') {//load angular js resources for dynamic table
                //echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/underscore.js\"></script>\n";
                //echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/angular.min.js\"></script>\n";    
                //echo "<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/visualizations.dynamictable.js\"></script>\n";   
                $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/underscore.js\"></script>");
                $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/angular.min.js\"></script>");
                $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/angular.sanitize.js\"></script>");            
                $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/visualizations.dynamictable.js\"></script>"); 
            }
        } else {
            //this visualization is a chart
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/d3/d3.js\"></script>");
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uvcharts/uvcharts.js\"></script>");         
            //download link stuff
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uvcharts/rgbcolor.js\"></script>");
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uvcharts/stackblur.js\"></script>");
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uvcharts/canvg.js\"></script>");
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/libraries/uvcharts/canvas-to-blob.js\"></script>");
            //Art Data charts.js
            $document->addCustomTag("<script type=\"text/javascript\" src=\"components/com_artdata/assets/js/charts.js\"></script>");             
        }

    }

    public function buildTableJavascriptSearch($data,$id) {

        $document = JFactory::getDocument();
        //build algo
        $searchAlgorithmContainer = array();
        foreach ($data as $key => $datum) {
            if ($key == 0) {
                foreach ($datum as $columnName => $columnValue) {
                    $columnNameCamel = $this->camelize($columnName);
                    //$columnNameCamel = ($columnNameCamel == 'id') ? $columnNameCamel.$this->rand : $columnNameCamel ;
                    if ($columnNameCamel == 'id') {
                        continue;
                    } else {
                        $searchAlgorithmContainer[] = 'item.'.$columnNameCamel.'.toLowerCase().indexOf(toSearch.toLowerCase()) > -1';
                    }
                    
                }
            }
        }

        //construct javascript search function
        $js = '';
        //$js .= '// Search Text in all 3 fields'; 
        $js .= 'function searchUtil'.$id.'(item, toSearch) {'; 
            $js .= 'return ('.implode(' || ',$searchAlgorithmContainer).') ? true : false;';
        $js .= '}'; 

        //add function to the head
        $document->addScriptDeclaration($js);

    }

    public function isValueNumeric($value) {
        if ($value == (string) (float) $value) {
            return (bool) is_numeric($value);
        }
        if ($value >= 0 && is_string($value) && !is_float($value)) {
            return (bool) ctype_digit($value);
        }
        return (bool) is_numeric($value);
    }

    public function camelize($str, $noStrip = array()) {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
    }

    public function createTableCssContent($json) {
        //$artDataTableCSSJson = '[{selector:".art-data-table",rules:[{property:"border-collapse",value:"collapse"},{property:"border-spacing",value:"0"},{property:"margin-bottom",value:"15px"},{property:"width",value:"100%"}]},{selector:"* + .art-data-table",rules:[{property:"margin-top",value:"15px"}]},{selector:".art-data-table th",rules:[{property:"padding",value:"8px 8px"},{property:"text-align",value:"left"},{property:"border-bottom",value:"1px solid #dddddd"},{property:"font-size",value:"14px"},{property:"font-weight",value:"bold"},{property:"color",value:"#444444"}]},{selector:".art-data-table td",rules:[{property:"padding",value:"8px 8px"},{property:"vertical-align",value:"top"},{property:"text-align",value:"left"},{property:"border-bottom",value:"1px solid #dddddd"}]},{selector:".art-data-table thead th",rules:[{property:"vertical-align",value:"bottom"}]},{selector:".art-data-table-middle, .art-data-table-middle td",rules:[{property:"vertical-align",value:"middle"}]},{selector:".art-data-table-striped tbody tr:nth-of-type(2n+1)",rules:[{property:"background",value:"#fafafa"}]},{selector:".art-data-table-condensed td",rules:[{property:"padding",value:"4px 8px"}]},{selector:".art-data-button",rules:[{property:"margin",value:"0"},{property:"border",value:"none"},{property:"overflow",value:"visible"},{property:"color",value:"#444444"},{property:"text-transform",value:"none"},{property:"display",value:"inline-block"},{property:"box-sizing",value:"border-box"},{property:"padding",value:"0 12px"},{property:"background",value:"#f5f5f5"},{property:"vertical-align",value:"middle"},{property:"line-height",value:"28px"},{property:"min-height",value:"30px"},{property:"font-size",value:"1rem"},{property:"text-decoration",value:"none"},{property:"text-align",value:"center"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"},{property:"border-radius",value:"4px"}]},{selector:".art-data-button:not(:disabled)",rules:[{property:"cursor",value:"pointer"}]},{selector:".art-data-button:hover, .art-data-button:focus",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#444444"},{property:"outline",value:"none"},{property:"text-decoration",value:"none"},{property:"border-color",value:"rgba(0, 0, 0, 0.16)"}]},{selector:".art-data-button:active, .art-data-button.art-data-active",rules:[{property:"background-color",value:"#eeeeee"},{property:"color",value:"#444444"}]},{selector:".art-data-button:disabled",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#999999"},{property:"border-color",value:"rgba(0, 0, 0, 0.06)"},{property:"box-shadow",value:"none"}]},{selector:".art-data-button-small",rules:[{property:"min-height",value:"25px"},{property:"padding",value:"0 10px"},{property:"line-height",value:"23px"},{property:"font-size",value:"12px"}]},{selector:".art-data-button-large",rules:[{property:"min-height",value:"40px"},{property:"padding",value:"0 15px"},{property:"line-height",value:"38px"},{property:"font-size",value:"0.001px"}]},{selector:".art-data-clearfix",rules:[{property:"clear",value:"both"}]},{selector:".art-data-width-1-1",rules:[{property:"width",value:"100%"}]},{selector:".art-data-form",rules:[{property:"margin",value:"0"}]},{selector:".art-data-input",rules:[{property:"vertical-align",value:"middle"},{property:"box-sizing",value:"border-box"},{property:"height",value:"30px"},{property:"width",value:"206px"},{property:"max-width",value:"100%"},{property:"padding",value:"4px 6px"},{property:"margin-bottom",value:"0"},{property:"border",value:"1px solid #dddddd"},{property:"background",value:"#ffffff"},{property:"color",value:"#444444"},{property:"transition",value:"all linear 0.2s"},{property:"border-radius",value:"4px"}]},{selector:".art-data-input:focus",rules:[{property:"border-color",value:"99baca"},{property:"outline",value:"0"},{property:"background",value:"#f5fbfe"},{property:"color",value:"#444444"}]},{selector:".art-data-input.art-data-input-large",rules:[{property:"height",value:"16px"},{property:"padding",value:"8px 6px"},{property:"font-size",value:"16px"}]},{selector:".art-data-input.art-data-input-small",rules:[{property:"height",value:"25px"},{property:"padding",value:"3px 3px"},{property:"font-size",value:"12px"}]},{selector:".art-data-input.art-data-input-display-field",rules:[{property:"width",value:"50px"}]},{selector:".art-data-pagination",rules:[{property:"padding",value:"0"},{property:"list-style",value:"none"},{property:"text-align",value:"center"},{property:"font-size",value:"16px"},{property:"border-radius",value:"5px"}]},{selector:".art-data-pagination:before, .art-data-pagination:after",rules:[{property:"content",value:"''"},{property:"display",value:"table"}]},{selector:".art-data-pagination:after",rules:[{property:"clear",value:"both"}]},{selector:".art-data-pagination > li",rules:[{property:"display",value:"inline-block"},{property:"font-size",value:"1rem"},{property:"vertical-align",value:"top"}]},{selector:".art-data-pagination > li:nth-child(n+2)",rules:[{property:"margin-left",value:"5px"}]},{selector:".art-data-pagination > li > a, .art-data-pagination > li > span",rules:[{property:"display",value:"inline-block"},{property:"min-width",value:"16px"},{property:"padding",value:"3px 5px"},{property:"line-height",value:"20px"},{property:"text-decoration",value:"none"},{property:"box-sizing",value:"content-box"},{property:"text-align",value:"center"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"},{property:"border-radius",value:"4px"}]},{selector:".art-data-pagination > li > a",rules:[{property:"background",value:"#f5f5f5"},{property:"color",value:"#444444"}]},{selector:".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#444444"},{property:"outline",value:"none"},{property:"border-color",value:"rgba(0, 0, 0, 0.16)"}]},{selector:".art-data-pagination > li > a:active",rules:[{property:"background-color",value:"#eeeeee"},{property:"color",value:"#444444"}]},{selector:".art-data-pagination > .art-data-active > span",rules:[{property:"background",value:"#00a8e6"},{property:"color",value:"#ffffff"},{property:"border-color",value:"transparent"},{property:"box-shadow",value:"inset 0 0 5px rgba(0, 0, 0, 0.05)"}]},{selector:".art-data-pagination > .art-data-disabled > span",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#999999"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"}]},{selector:".art-data-pagination-previous",rules:[{property:"float",value:"left"}]},{selector:".art-data-pagination-next",rules:[{property:"float",value:"right"}]},{selector:".art-data-pagination-left",rules:[{property:"text-align",value:"left"}]},{selector:".art-data-pagination-right",rules:[{property:"text-align",value:"right"}]}]';
        $CssDeclarations = json_decode($json);

        $CSS = "";

        foreach ($CssDeclarations as $declaration) {
            $CSS .= $declaration->selector."{\n";
            foreach ($declaration->rules as $rule) {
                $CSS .= $rule->property.":".$rule->value." !important;\n";
            }
            $CSS .= "}\n";
        }

        return $CSS;
    }

}
