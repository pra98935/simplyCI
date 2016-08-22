<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	class Sendnotification extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('User_admin_model');
		
		}
        function index(){
		
		$result = $this->User_admin_model->getAllRecordsWhere('notification',array('status'=>0));
		if(!empty($result))
		{
			foreach($result as $row)
			{
				$this->notify($row);
				$status=array('status'=>'1');
				$where=array('id'=>$row['id']);
				$this->User_admin_model->updateRecords('notification',$status,$where);
			}
		}
         }
		public function notify($detail)
		{
			if(!empty($detail)){
                mail($detail['reciever'], 'Updates simply','<p>please use this coupon'.$detail["message"].'</p>');
			   
			}
		}

    }
    ?>
