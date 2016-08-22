<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
class Admin_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function Admin_Login($email, $pass){
    	$this->db->select('*');
    	$this->db->from('user');
    	$this->db->where('email', $email);
    	$this->db->where('password', md5($pass));
    	$this->db->where('role', '1');
    	$query = $this->db->get();
    	//$this->db->last_query();
    	return $query->result_array(); 
    }

    public function insertData($table, $dataInsert)
    {
        $this->db->insert($table, $dataInsert);
        //echo $this->db->last_query();
        //die;
        return $this->db->insert_id();
    }

    public function getRecords($table)
    {
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0){
            return $query->result_array();    
        }
        
    }

    public function deleteRecords($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        //echo $this->db->last_query(); 
        return 1;
    }

    public function updateRecords($table, $data, $where){
        $this->db->update($table, $data, $where);
        //echo $this->db->last_query();
        //die;
        return 1;
        
        
    }

    public function getSingleRecords($table, $where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();
        //$this->db->last_query();
        return $query->row(); 
    }

    public function getConditionRecords($table, $where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();

        if ($query->num_rows() > 0){
            return $query->result_array();    
        }
    }

    public function changestatus($table,$where,$status){

       $sql = "UPDATE ".$table." SET status = ".$status." WHERE id = ".$where."";
       $this->db->query($sql);
       return 1;
    }

    public function changestatus0($table,$status,$where){
       $data = array('status' => $status);
       $this->db->where($where);
       $this->db->update($table, $data);
       //echo $this->db->last_query();
       return 1;
    }
     public function getAllRecordsWhere($table,$where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die;
        if ($query->num_rows() > 0){
            return $query->result_array();    
        }
        
    }
}    
?>    
