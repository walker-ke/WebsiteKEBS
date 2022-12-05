<?php


class Poll{
    private $dbHost  = 'localhost';
    private $dbUser  = 'root';
    private $dbPwd   = '';
    private $dbName  = 'kebs_poll';            
    private $db      = false;
    private $pollTbl = 'polls';
    private $optTbl  = 'poll_options';
    private $voteTbl = 'poll_votes';
    private $memTbl = 'members';
    
    public function __construct(){
        if(!$this->db){ 
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPwd, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    /*
     * Runs query to the database
     * @param string SQL
     * @param string count, single, all
     */
    private function getQuery($sql,$returnType = ''){
        $result = $this->db->query($sql);
        if($result){
            switch($returnType){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                        }
                    }
            }
        }
        return !empty($data)?$data:false;
    }
    
     public function getRows($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->userTbl;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $result = $this->db->query($sql);
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $result->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Get polls data
     * Returns single or multiple poll data with respective options
     * @param string single, all
     */
    public function getPolls($pollType = 'single'){
        $pollData = array();
        $sql = "SELECT * FROM ".$this->pollTbl." WHERE status = '1' ORDER BY created DESC";
        $pollResult = $this->getQuery($sql, $pollType);
        if(!empty($pollResult)){
            if($pollType == 'single'){
                $pollData['poll'] = $pollResult;
                $sql2 = "SELECT * FROM ".$this->optTbl." WHERE poll_id = ".$pollResult['id']." AND status = '1'";
                $optionResult = $this->getQuery($sql2);
                $pollData['options'] = $optionResult;
            }else{
                $i = 0;
                foreach($pollResult as $prow){
                    $pollData[$i]['poll'] = $prow;
                    $sql2 = "SELECT * FROM ".$this->optTbl." WHERE poll_id = ".$prow['id']." AND status = '1'";
                    $optionResult = $this->getQuery($sql2);
                    $pollData[$i]['options'] = $optionResult;
                }
            }
        }
        return !empty($pollData)?$pollData:false;
    }
    
    /*
     * Submit vote
     * @param array of poll option data
     */
    public function vote($data = array()){
//        if(!isset($data['poll_id']) || !isset($data['poll_option_id']) || isset($_COOKIE[$data['poll_id']])) {
//            return false;
//        }else{
//            $sql = "SELECT * FROM ".$this->voteTbl." WHERE poll_id = ".$data['poll_id']." AND poll_option_id = ".$data['poll_option_id'];
//            $preVote = $this->getQuery($sql, 'count');
//            if($preVote > 0){
//                $query = "UPDATE ".$this->voteTbl." SET vote_count = vote_count+1 WHERE poll_id = ".$data['poll_id']." AND poll_option_id = ".$data['poll_option_id'];
//                $update = $this->db->query($query);
//            }else{
//                $query = "INSERT INTO ".$this->voteTbl." (poll_id,poll_option_id,vote_count) VALUES (".$data['poll_id'].",".$data['poll_option_id'].",1)";
//                $insert = $this->db->query($query);
//            }
//            return true;
//        }
        $query = "INSERT INTO ".$this->voteTbl." (poll_id,poll_option_id,vote_count) VALUES (".$data['poll_id'].",".$data['poll_option_id'].",1)";
                $insert = $this->db->query($query);
    }
    
    /*
     * Get poll result
     * @param poll ID
     */
    public function getResult($pollID){
        $resultData = array();
        if(!empty($pollID)){
            $sql = "SELECT p.subject, SUM(v.vote_count) as total_votes FROM ".$this->voteTbl." as v LEFT JOIN ".$this->pollTbl." as p ON p.id = v.poll_id WHERE poll_id = ".$pollID;
            $pollResult = $this->getQuery($sql,'single');
            if(!empty($pollResult)){
                $resultData['poll'] = $pollResult['subject'];
                $resultData['total_votes'] = $pollResult['total_votes'];
                $sql2 = "SELECT o.id, o.name, v.vote_count FROM ".$this->optTbl." as o LEFT JOIN ".$this->voteTbl." as v ON v.poll_option_id = o.id WHERE o.poll_id = ".$pollID;
                $optResult = $this->getQuery($sql2);
                if(!empty($optResult)){
                    foreach($optResult as $orow){
                        $resultData['options'][$orow['name']] = $orow['vote_count']; 
                    }
                }
            }
        }
        return !empty($resultData)?$resultData:false;
    }
    
    
     /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getMemberDetails($hrnum){
        //$resultMemberData = array();
        $sql = "SELECT firstname, lastname,vote_status FROM members WHERE hr_no = $hrnumber";
        
        $memberdetails =$this->db->query($sql);
        
        $count = mysqli_num_rows($memberdetails);
	if($count == "0"){
		$output = '<h2>No result found!</h2>';
	}else{
		while($row = mysqli_fetch_array($memberdetails)){
		$s = $row['firstname']; // Replace column_to_display with the column you want the results from
				$output .= '<h2>'.$s.'</h2><br>';
			}
		}
        //$sql = "SELECT * FROM $this->memTbl WHERE hr_no = $hrnum";
        //$membresult = $this->db->query($sql);
        //if(!empty($membresult)){
                  //$resultMemberData['firstname']=$membresult['firstname'];
                //}
                //return !empty($resultMemberData)?$resultMemberData:false;
    }
         
         
        
        
        
       
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created',$data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $columns .= $pre.$key;
                $values  .= $pre."'".$val."'";
                $i++;
            }
            $query = "INSERT INTO ".$this->userTbl." (".$columns.") VALUES (".$values.")";
            $insert = $this->db->query($query);
            return $insert?$this->db->insert_id:false;
        }else{
            return false;
        }
    }

    
}