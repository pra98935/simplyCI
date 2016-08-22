<?php
function getCategoryItemById($id){
	$CI =& get_instance();
	$CI->db->select('*');
    $CI->db->from('catering_item');
    $CI->db->where('cat_id',$id);
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->result_array();    
    }
}


function getCalender($county=''){
	$CI =& get_instance();
	$CI->db->select('*');
	
    $CI->db->from('calendar');
    if(!empty($county)){
     $CI->db->where('county',$county);
    }
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->result_array();    
    }else{
	return false;
	}
}
function getLocations(){
	$CI =& get_instance();
	$CI->db->select('*');
    $CI->db->from('locations');
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->result_array();    
    }else{
	return false;
	}
}




function getUserAddressById($id){
	$CI =& get_instance();
	$CI->db->select('*');
    $CI->db->from('user_address');
    $CI->db->where('id',$id);
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->row();    
    }
}

function getbillingAddressById($id){
	$CI =& get_instance();
	$CI->db->select('*');
    $CI->db->from('billing_address');
    $CI->db->where('id',$id);
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->row();    
    }	
}
function insertSubscribers($details){
	$sub = getsubcriber($details['email']); 
	//print_r($sub); die;
	$CI =& get_instance();
	$data = array(
   'name' => $details['name'] ,
   'email' => $details['email']
	);
	if(empty($sub)){
	$CI->db->insert('subscribers', $data); 
	return true;
	}else{
	return false;
	}
}

function getsubcriber($id){ 
	$CI =& get_instance();
	$CI->db->select('*');
    $CI->db->from('subscribers');
    $CI->db->where('email',$id);
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0){
        return $query->row();    
    }	
}

