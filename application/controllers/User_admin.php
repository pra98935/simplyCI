<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

   

    public function __construct(){
    	parent::__construct();
        $this->load->model('user_admin_model');
    	$this->load->library('form_validation');
    	$this->load->helper('cookie');
    	$this->load->helper('string');
    }

	public function index()
	{   
		//echo $this->session->userdata('register_login_email');
		//echo $this->session->userdata('front_login_email');

		if($this->check_user_sess()){
			redirect('user_admin/user_login_success_cntrl');
		}
		
		    $this->load->view('user/header');
            $this->load->view('user/login');
        	$this->load->view('user/footer');
		
        
	}

	Public function check_user_sess(){
		$sess_var = $this->session->userdata('email');
		if(!empty($sess_var)){
			return true;
		}else{
			return false;
		}
		
	}

	public function user_login_cntrl(){
    		$config = $this->custom_form_validation->Chk_validation(); 
    		foreach($config as $val) {
    			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
    		}
		    
		     //$this->form_validation->set_rules('email', 'Username', 'required');
            //$this->form_validation->set_rules('password', 'Password', 'required');
    		
    		if($this->form_validation->run()==FALSE){
    			$this->load->view('user/header');
                $this->load->view('user/login');
        	    $this->load->view('user/footer');
    		}else{
    			
            	$email     = $this->input->post('email');
	    		$pass      = $this->input->post('password');
	    		$remember  = $this->input->post('remember');


	    		if($remember==1){
                	$cookie = array(
					    'name'   => 'remember_me',
					    'value'  => $email.'/'.$pass,
					    'expire' => '1209600'  // Two weeks
					);

					$this->input->set_cookie($cookie);
				}

	    		
	    		$result = $this->user_admin_model->user_login($email, $pass);
                 
                if(!empty($result)) {
                	
                	$sess_email = $result['0']['email'];
                	$sess_uid   = $result['0']['id'];
		    		$admin_session = array(
		            	'email' =>  $sess_email,
		            	'id'    =>  $sess_uid,
		    		);
		    		$this->session->set_userdata($admin_session);
		    		redirect('user_admin/user_login_success_cntrl');

                }else{
                	$this->session->set_flashdata('error', 'You have entered some wrong');
                	redirect('user_admin');
                }

    		}

	}

	public function register(){
        $this->load->view('user/header');
	    $this->load->view('user/register');
		$this->load->view('user/footer'); 
    }

	public function register_cntrl(){
		$config = $this->custom_form_validation->user_register(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}
        
        if($this->form_validation->run()==FALSE){
        	$this->load->view('user/header');
            $this->load->view('user/register');
        	$this->load->view('user/footer');
        }else{
        	
        	$fname  =  $this->input->post('firstname');
        	$lname  =  $this->input->post('lastname');
            $phone  =  $this->input->post('phone');

        	$email  =  $this->input->post('email');
        	$pass   =  $this->input->post('password');
        	
        	$data1 =  array(
		        		'email'     =>  $email, 
		        		'password'  =>  md5($pass), 
		        		'status'    =>  '1',
		        		'role'      =>  '2'  
		        		);

        	
        	 $id = $this->user_admin_model->insertData("user",$data1);

             $data2 =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'phone'     =>  $phone,
		        		'uid'       =>  $id 
		        		);

            $result = $this->user_admin_model->insertData("personal_detail",$data2);

            if($result){
            	redirect('user_admin');   //redirect('user_admin/');
            }
        }	
	
	}

	
	// Public function check_user_sess(){
	// 	$sess_var = $this->session->userdata('email');
	// 	if(!empty($sess_var)){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
		
	// }

	public function user_login_success_cntrl(){
		
		if ($this->check_user_sess()) {
			redirect('user_admin/edit_acnt');
        }else{
        	redirect('user_admin');
        }
		
	}
    
    
    public function edit_acnt(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}
        
        $sess_id = $this->session->userdata('id');
        $where = array('uid' => $sess_id);
        $data['result'] = $this->user_admin_model->getSingleRecords('personal_detail',$where);
        
        $img_sess = array(
		            	'profile_image' =>  $data['result']->image,
		            );
		$this->session->set_userdata($img_sess);

		$this->load->view('user/header');
		$this->load->view('user/wel_dash');
		$this->load->view('user/sidebar');
        $this->load->view('user/edit_acnt',$data);
    	$this->load->view('user/footer');
	} 

	#update "edit your account information"
	public function userupdateacnt(){

        
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$config = $this->custom_form_validation->user_editacnt(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}


		if($this->form_validation->run()==FALSE){
        	$errorArr = array(
        		'firstname' => form_error('firstname'),
        		'lastname'  => form_error('lastname')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{
        	
            $firstname  = $this->input->post('firstname');
            $lastname   = $this->input->post('lastname');
            $phone      = $this->input->post('phone');
            $fax        = $this->input->post('fax');
            $hearabtus  = $this->input->post('hearabtus');
            $allergies  = $this->input->post('allergies');
            

            $allergiesno = count($allergies);
            $allergieval="";
            $a = $allergiesno-1;
            for ($i=0; $i < $allergiesno; $i++) { 
            	if($i!==$a)
            	{
            		$allergieval .= $allergies[$i].", ";
            	}else{
            		$allergieval .= $allergies[$i];
            	}
            	
            }

            // image upload code 
	            $f_name = $_FILES['image']['name'];
				$f_tmp  = $_FILES['image']['tmp_name'];
				$f_size = $_FILES['image']['size'];
				        
				if (!empty($f_name)) {
				    if ($_FILES['image']['type'] != 'image/jpeg' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/gif' && $_FILES['image']['type'] != 'image/png') {
				        echo "error";
				        return false;
				    }
				}
				        
				$f_extension = explode('.', $f_name); //To breaks the string into array
				$f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
				$f_newfile = "";
				        
				if ($f_name) {
				    $f_newfile = uniqid() . '.' . $f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name of both file.
				    $store     = "asset/user/uploads/profile_pic/". $f_newfile;
				    $image1    = move_uploaded_file($f_tmp, $store);
				}

				$img_session = array(
		            	'image' =>  $f_newfile,
		            );
				$this->session->set_userdata($img_session);

			// image upload code end
            
        	$data = array(
	           'firstname'  => $firstname,
			   'lastname'   => $lastname,
			   'phone'      => $phone,
			   'fax'        => $fax,
			   'hearabtus'  => $hearabtus,
			   'allergies'  => $allergieval,
			); 
             
            if($f_newfile){
	        $data = array(
	        		'image' => $f_newfile
	        	);
	        }

			$id = $this->session->userdata('id');
			$where = array('uid' => $id);
			$result = $this->user_admin_model->updateRecords('personal_detail', $data, $where);
			if($result){
			 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully '));
			}else{
			 	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}
        }
	} 

	public function billingaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$sess_id = $this->session->userdata('id');
        $where = array('uid' => $sess_id);
        $data['billingaddress'] = $this->user_admin_model->getSingleRecords('billing_address',$where);

		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/billingaddress', $data);
    	$this->load->view('user/footer');
	}

	public function updatebilling(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$config = $this->custom_form_validation->newaddress(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	$errorArr = array(
        		'firstname' => form_error('firstname'),
        		'lastname'  => form_error('lastname'),
        		'city'      => form_error('city'),
        		'zip'       => form_error('zip'),
        		'county'   => form_error('county')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{
			$firstname = $this->input->post('firstname');
			$lastname  = $this->input->post('lastname');
			$company   = $this->input->post('company');
			$phone     = $this->input->post('phone');
			$fax       = $this->input->post('fax');
			$address1  = $this->input->post('address1');
			$address2  = $this->input->post('address2');
			$city      = $this->input->post('city');
			$zip       = $this->input->post('zip');
			$county   = $this->input->post('county');
			$da        = $this->input->post('da');
			$uid       = $this->session->userdata('id');
            $addid = $this->session->userdata('addid');
            
			$data = array(
						'firstname' =>  $firstname, 
						'lastname'  =>  $lastname, 
						'company'   =>  $company, 
						'phone'     =>  $phone, 
						'fax'       =>  $fax, 
						'address1'  =>  $address1, 
						'address2'  =>  $address2, 
						'city'      =>  $city, 
						'zip'       =>  $zip, 
						'county'    =>  $county, 
						'state'     =>  'New Jersey',
					);

            $sess_id = $this->session->userdata('id');	
            $where = array(
	            	'uid' => $sess_id, 
	            );

            $result = $this->user_admin_model->updateRecords('billing_address', $data, $where);
			if($result){
			 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully '));
			}else{
			 	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}
		}
	}

	public function changepass(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/changepass');
    	$this->load->view('user/footer');
	}

	public function changepassAction(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}
        
        $config = $this->custom_form_validation->changepass(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}
        
        if($this->form_validation->run()==FALSE){
        	$errorArr = array(
        		'oldpass'     => form_error('oldpass'),
        		'newpass'     => form_error('newpass'),
        		'confirmpass' => form_error('confirmpass')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{
        	
        	$oldpass     = md5($this->input->post('oldpass'));
	        $newpass     = $this->input->post('newpass');
	        $confirmpass = $this->input->post('confirmpass');

	        $uid     = $this->session->userdata('id');
	        $where = array(
	         	'password' => $oldpass,
	         	'id'       =>  $uid
	         	);
	        $data['result'] = $this->user_admin_model->getSingleRecords('user', $where);
	        
	        if(!empty($data['result'])){
	        	//echo json_encode(array('type' => 'success', 'msg' => 'Password is correct'));
	        	$where = array(
	         		'id'       =>  $uid
	         	);

	         	$data = array(
	         			'password' => md5($newpass),
	         		);
	        	
	        	$result = $this->user_admin_model->updateRecords('user', $data, $where);
	        	
	        	if($result){
	        		echo json_encode(array('type' => 'success',  'msg' => 'Password update successfully'));
	        	}else{
	        		echo json_encode(array('type' => 'fail',  'msg' => 'Please try again'));
	        	}

	        }else{
	            echo json_encode(array('type' => 'failed',  'msg' => 'Please enter valid password'));
	        }
        }

        

        
		//$this->load->view('user/header');
		//$this->load->view('user/sidebar');
        //$this->load->view('user/changepass');
    	//$this->load->view('user/footer');
	} 

	public function modifyaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$uid = $this->session->userdata('id');
		$where = array('uid' => $uid,);
        
        $data['result'] = $this->user_admin_model->getAllRecordsWhere('user_address',$where);
        
		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/modifyaddress', $data);
    	$this->load->view('user/footer');
	}

	public function addnewaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/addnewaddress');
    	$this->load->view('user/footer');
	}

	public function insertnewadd(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$config = $this->custom_form_validation->newaddress(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	$errorArr = array(
        		'firstname' => form_error('firstname'),
        		'lastname'  => form_error('lastname'),
        		'city'      => form_error('city'),
        		'zip'       => form_error('zip'),
        		'county'   => form_error('county')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{
			$firstname = $this->input->post('firstname');
			$lastname  = $this->input->post('lastname');
			$company   = $this->input->post('company');
			$phone     = $this->input->post('phone');
			$fax       = $this->input->post('fax');
			$address1  = $this->input->post('address1');
			$address2  = $this->input->post('address2');
			$city      = $this->input->post('city');
			$zip       = $this->input->post('zip');
			$county   = $this->input->post('county');
			$da        = $this->input->post('da');
			
			$uid       = $this->session->userdata('id');

			$data = array(
						'firstname' => $firstname, 
						'lastname'  => $lastname, 
						'company'   => $company, 
						'phone'     => $phone, 
						'fax'       => $fax, 
						'address1'  => $address1, 
						'address2'  => $address2, 
						'city'      => $city, 
						'zip'       => $zip, 
						'county'   => $county, 
						'default_address'        => $da, 
						'uid'       => $uid, 
						'state'     => 'New Jersey',
					);

            $result = $this->user_admin_model->insertData('user_address', $data);
			if($result){
			 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Insert successfully '));
			}else{
			 	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}

		}


		// $this->load->view('user/header');
		// $this->load->view('user/sidebar');
  //       $this->load->view('user/addnewaddress');
  //   	$this->load->view('user/footer');
	}

	public function editaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}
        
        $id = $this->uri->segment(3);
        
        $addid_session = array(
		            	'addid' =>  $id,
		            );
		$this->session->set_userdata($addid_session);
        
        $where = array('id' => $id);
        $data['result'] = $this->user_admin_model->getSingleRecords('user_address', $where);
               
 		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/editaddress',$data);
        $this->load->view('user/footer');
	}

	public function deleteaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$addid = $this->uri->segment(3);
		$where = array('id' => $addid);
		$this->user_admin_model->deleteRecords('user_address', $where);
		$this->session->set_flashdata('delete','Record Successfully Deleted'); 
		redirect('user_admin/modifyaddress');
	}

	public function updateaddress(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$config = $this->custom_form_validation->newaddress(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	$errorArr = array(
        		'firstname' => form_error('firstname'),
        		'lastname'  => form_error('lastname'),
        		'city'      => form_error('city'),
        		'zip'       => form_error('zip'),
        		'county'   => form_error('county')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{
			$firstname = $this->input->post('firstname');
			$lastname  = $this->input->post('lastname');
			$company   = $this->input->post('company');
			$phone     = $this->input->post('phone');
			$fax       = $this->input->post('fax');
			$address1  = $this->input->post('address1');
			$address2  = $this->input->post('address2');
			$city      = $this->input->post('city');
			$zip       = $this->input->post('zip');
			$county   = $this->input->post('county');
			$da        = $this->input->post('da');
			$uid       = $this->session->userdata('id');
            $addid = $this->session->userdata('addid');
            
			$data = array(
						'firstname' => $firstname, 
						'lastname'  => $lastname, 
						'company'   => $company, 
						'phone'     => $phone, 
						'fax'       => $fax, 
						'address1'  => $address1, 
						'address2'  => $address2, 
						'city'      => $city, 
						'zip'       => $zip, 
						'county'   => $county, 
						'default_address' => $da, 
						'state'    => 'New Jersey',
					);

            
            $where = array(
	            	'uid' => $uid, 
	            	'id'  => $addid
            	);

            $result = $this->user_admin_model->updateRecords('user_address', $data, $where);
			if($result){
			 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully '));
			}else{
			 	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}
		}
	}
    
    public function allorder(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$sess_id = $this->session->userdata('id');
        $where = array('user_id' => $sess_id);
        $data['allorder'] = $this->user_admin_model->getAllRecordsGroupByWhere('payments',$where,'txn_id');

        // echo '<pre>';
        // print_r($data);
        // die;

		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/allorder', $data);
    	$this->load->view('user/footer');
	}

	public function orderdetail(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$paypalInfo = $this->input->get();
		$date = $paypalInfo['date'];
		
		$txn_id     = $this->uri->segment(3);
		$dlvry_id   = $this->uri->segment(4);
		$billing_id = $this->uri->segment(5);
		
		$where = array('txn_id' => $txn_id);

        $data['orderdetail'] = $this->user_admin_model->getAllRecordsWhere('payments',$where);

        $data['normalinfo'] = array(
        		'txn_id'     => $txn_id, 
        		'dlvry_id'   => $dlvry_id, 
        		'billing_id' => $billing_id,
        		'date'       => $date,
        	);


		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/orderdetail', $data);
    	$this->load->view('user/footer');
	}

	public function subscribe(){
		if(!$this->check_user_sess()){
			redirect('user_admin');
		}

		$uid     = $this->session->userdata('id');
		$where =  array(
			'uid' => $uid, 
			);
		$data['result' ] = $this->user_admin_model->getSingleRecords('personal_detail', $where);  

		$this->load->view('user/header');
		$this->load->view('user/sidebar');
        $this->load->view('user/subscribe', $data);
    	$this->load->view('user/footer');

	}

	public function newsletter(){

        if(!$this->check_user_sess()){
			redirect('user_admin');
		}

        $subsval = $this->input->post('subsval');

        $data    = array(
        	'newsletter' => $subsval, 
        	);
        
        $uid     = $this->session->userdata('id');

        $where = array(
        		'uid' => $uid, 
        	);

        $result = $this->user_admin_model->updateRecords('personal_detail', $data, $where);

        if($result){
		 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully '));
		}else{
		 	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
		}
	}

	public function user_logout_cntrl(){
		$this->session->unset_userdata($admin_session);
		//$this->session->unset_userdata($user_register_session);
		//$this->session->unset_userdata($front_login_session);
		$this->session->sess_destroy();
		redirect('user_admin');

	}

	public function forgotpass(){
		$this->load->view('user/header');
        $this->load->view('user/forgotpass');
        $this->load->view('user/footer');
	}

	public function forgotpassAction(){
				
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if($this->form_validation->run()==FALSE){
			$errorArr = array(
        		'email' => form_error('email')
        	);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
			
		}else{
			$email = $this->input->post('email');

            $where = array('email' => $email,); 
			
			$user_records = $this->user_admin_model->getSingleRecords('user', $where);

			if($user_records && $user_records->user_type=='1'){ // for registered user user type 1 and for guest 0
				$uid = $user_records->id;
				$token = random_string('alnum',10);
	           
				$data = array(
						'token' => $token, 
					);
				$result = $this->user_admin_model->updateRecords('user', $data, $where);
				
	            if($result){
	            	$msg = base_url().'user_admin/resetpassword/'.$uid.'/'.$token;
					$this->email->from('simplydeliciousdinners@outlook.com', 'Reset Password');
		            $this->email->to($email);
		            $this->email->subject('Reset Password');
		            $this->email->set_mailtype("html");
		            $this->email->message($msg);
		            
		            if ($this->email->send())
		            {
		                echo json_encode(array('type' => 'success', 'msg' => 'Your mail has been sent successfully'));
		            }
		            else
		            {
		                echo json_encode(array('type' => 'failed', 'msg' => 'Please try again later'));
		            }	
	            }
			}else{
				echo json_encode(array('type' => 'failed', 'msg' => 'You are not registered user'));	
			}				
				


		}
	    
    }

    public function resetpassword(){
    	$uid    = $this->uri->segment(3);	
    	$token  = $this->uri->segment(4);

    	$data['result'] = array(
    	 	'uid' => $uid, 
    	 	'token' => $token
    	);

    	$where = array(
    		'id' => $uid, 
    		);

        $result = $this->user_admin_model->getSingleRecords('user', $where);
        
	    if($uid && $token){
	        if($result->token){
	        	$this->load->view('user/header');
	        	$this->load->view('user/resetpassword', $data);
	        	$this->load->view('user/footer');	
	        }else{
	        	$this->load->view('user/header');
	        	$this->load->view('user/expirelink');
	        	$this->load->view('user/footer');	
	        }
	    }else{
	    	$this->load->view('user/header');
	        $this->load->view('user/404');
	        $this->load->view('user/footer');
	    }    
    }

    public function resetPasswordAction(){
    	$uid    = $this->uri->segment(3);	
    	$token  = $this->uri->segment(4);

    	$where = array(
    		'id' => $uid, 
    		);

        $result = $this->user_admin_model->getSingleRecords('user', $where);
    	
    	if($uid && $token){
	    	if($result->token){

		    	$this->form_validation->set_rules('password', 'Password', 'required');
				
				if($this->form_validation->run()==FALSE){
					$errorArr = array(
		        		'password' => form_error('password')
		        	);
		        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
					
				}else{
					$password = $this->input->post('password');
		            
					
		            $where = array(
		            	'id' => $uid,
		            );

		            $data = array(
		            	'password' => md5($password),
		            ); 

		            $result = $this->user_admin_model->updateRecords('user', $data, $where);

		            if($result){

	                    $where = array('id' => $uid,); 
						$data = array(
								'token' => '', 
							);
						$result = $this->user_admin_model->updateRecords('user', $data, $where);

		            	echo json_encode(array('type' => 'success', 'msg' => 'Password successfully updated'));
		            }else{
		            	echo json_encode(array('type' => 'failed', 'msg' => 'Please try again'));
		            }

				}
	  		}else{
	  			$this->load->view('user/header');
	        	$this->load->view('user/expirelink');
	        	$this->load->view('user/footer');
	  		}
  		}else{
  			$this->load->view('user/header');
	        $this->load->view('user/404');
	        $this->load->view('user/footer');
  		}	
    }
}