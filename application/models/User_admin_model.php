<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
class User_admin_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function user_login($email, $pass){
    	$this->db->select('*');
    	$this->db->from('user');
    	$this->db->where('email', $email);
    	$this->db->where('password', md5($pass));
    	$this->db->where('role', '2');
        $this->db->where('status', '1');
    	$query = $this->db->get();
    	//$this->db->last_query(); die;
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
    }

    public function updateRecords($table, $data, $where){
        $this->db->update($table, $data, $where);
        //print_r($data);
        //echo $this->db->last_query(); die;
        return 1;
        
        
    }

    public function getSingleRecords($table, $where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->row(); 
    }

    public function getAllRecordsWhere($table,$where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0){
            return $query->result_array();    
        }
        
    }

    public function getAllRecordsGroupByWhere($table,$where,$group)
    {
        $this->db->select('*,sum(payment_gross) total');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->group_by($group); 
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0){
            return $query->result_array();    
        }
        
    }
}    
?>    