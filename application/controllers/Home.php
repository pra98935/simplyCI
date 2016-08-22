<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->model('homemodel');
    	$this->load->library('form_validation');
    	$this->load->library("pagination");
    	$this->load->library('cart');
    	$this->load->library('paypal_lib');



    }

	public function index()
	{
		
        $this->get_header();
		$this->load->view('template/front');
		$this->get_footer();

    }

    public function get_header(){
    	$where = array('main_menu' => 1, );
    	$data['result'] = $this->homemodel->getAllRecordsWhere('static_pages', $where);
		$this->load->view('template/header', $data);
    }

    public function get_footer(){
    	$where = array('main_menu' => 0, );
    	$data['result_footer'] = $this->homemodel->getAllRecordsWhere('static_pages', $where);
    	//print_r($data);
		$this->load->view('template/footer', $data);
    }

    // contact page
    public function contact()
	{
	    $this->get_header();
		$this->load->view('template/contact');
		$this->get_footer();
	}

	#review page
    public function review()
	{
	    $countrow = $this->homemodel->record_count('customer_review');

	    $config = array();
        $config["base_url"] = base_url() . "home/review";
        $config["total_rows"] = $countrow;
        $config["per_page"] = 2;
        $config['display_pages'] = FALSE;
        $config['attributes'] = array('class' => 'pagi_rvw');
        

        if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}
		else{
			$page = 0;
		}

        $this->pagination->initialize($config);

        $data["result"] = $this->homemodel->get_record_pagination($config["per_page"], $page, 'customer_review');
        $data["links"] = $this->pagination->create_links();

	    $this->get_header();
		$this->load->view('template/review', $data);
		$this->get_footer();
		//$this->load->view('template/footer');
    }

    #order my meals
    public function order_my_meal(){

        $currentmonth = date('F'); 
        $currentyear  = date('Y'); 
        $where = array(
        		'add_menu_month' => $currentmonth, 
        		'add_menu_year'  => $currentyear,
        		'status'         => 1
        	);
        $data['result'] = $this->homemodel->getAllRecordsWhere('menu_meals',$where);  

    	$this->get_header();
		$this->load->view('template/order_my_meal',$data);
		$this->get_footer();
    }

    #menu function
    public function menu(){
        
        $currentmonth = date('F'); 
        $currentyear  = date('Y'); 
        $where = array(
        		'add_menu_month' => $currentmonth, 
        		'add_menu_year'  => $currentyear,
        		'status'         => 1
        	);
        $data['result'] = $this->homemodel->getAllRecordsWhere('menu_meals',$where);


        $nextmonth = date('F', strtotime('+1 month')); 
        $where1 = array(
        		'add_menu_month' => $nextmonth, 
        		'add_menu_year'  => $currentyear,
        		'status'         => 1
        	);
        $data['nextmonthmenu'] = $this->homemodel->getAllRecordsWhere('menu_meals',$where1);
        
    	$this->get_header();
		$this->load->view('template/menu', $data);
		$this->get_footer();
    }

    #display next month menu
    public function nextmonthmenu(){
        
        $currentyear  = date('Y'); 
        $nextmonth = date('F', strtotime('+1 month')); 
        $where = array(
        		'add_menu_month' => $nextmonth, 
        		'add_menu_year'  => $currentyear,
        		'status'         => 1
        	);
        $data['result'] = $this->homemodel->getAllRecordsWhere('menu_meals',$where);
        
    	$this->get_header();
		$this->load->view('template/next_month_menu', $data);
		$this->get_footer();
    }

    #send form process at contact page
    public function sendform()
	{

		$config = $this->custom_form_validation->submitmail(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
			$errorArr = array(
        		'firstname' => form_error('firstname'),
        		'lastname'  => form_error('lastname'),
        		'email'  => form_error('email')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
			
		}else{
			$firstname = $this->input->post('firstname');
			$lastname  = $this->input->post('lastname');
			$email     = $this->input->post('email');
			$phone     = $this->input->post('phone');
			$message   = $this->input->post('message');

			$data = array(
				'firstname' => $firstname, 
				'lastname'  => $lastname, 
				'email'     => $email, 
				'phone'     => $phone, 
				'message'   => $message, 
				);

			
			$msg = '<table>
						<thead>
							<tr>
								<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> First Name </th>
								<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Last Name </th>
								<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Email </th>
								<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Phone </th>
								<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Message </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="background-color:#c7c7c7; color:white; border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$firstname.'</td>
								<td style="background-color:#c7c7c7; color:white; border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$lastname.'</td>
								<td style="background-color:#c7c7c7; color:white; border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$email.'</td>
								<td style="background-color:#c7c7c7; color:white; border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$phone.'</td>
								<td style="background-color:#c7c7c7; color:white; border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$message.'</td>
							</tr>
						</tbody>
					</table>';

			$result = $this->homemodel->insertData('contcat_us', $data);

			if($result){
				$this->email->from($email, 'Contact Us');
	            $this->email->to('pra98935@gmail.com');
	            $this->email->subject('custom subject');
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
			}else{
				echo json_encode(array('type' => 'failed', 'msg' => 'Please try again later'));
			}

            // ===================
			
            // ==================


		}
	    
    }

    #call pages dynamically
    public function pages(){
	   $pagetitlestr = $this->uri->segment(3);
	   
       $search = array('_', 'and');
       $replace = array(' ', '&');
       $title = str_replace($search, $replace, $pagetitlestr);


	   $where = array('title' => $title);

	   $data['result'] = $this->homemodel->getSingleRecords('static_pages', $where);
	   
       $this->get_header();
	   $this->load->view('template/layout', $data);
	   $this->get_footer();
	   
       
	}

	# catering section at frondend
	public function catering(){
       
      $data['catering'] = $this->homemodel->getRecords('catering');
	  $this->get_header();
	  $this->load->view('template/catering', $data);
	  $this->get_footer();
	}

	#functionality of add to cart
	public function addtocart(){
        
        $pro_id    = $this->input->post('curent_id');
        $pro_qty   = $this->input->post('curent_qty');
        $pro_price = $this->input->post('curent_price');
        $pro_name  = $this->input->post('curent_name');
        $servings  = $this->input->post('otherinfo');
        $traytype  = $this->input->post('traytype');
        $img       = $this->input->post('img');
        $link      = $this->input->post('link');

        $data = array(
		        'id'      => $pro_id,
		        'qty'     => $pro_qty,
		        'price'   => $pro_price,
		        'name'    => $pro_name,
		        'options' => array('Servings' => $servings, 'Tray' => $traytype, 'Image' => $img, 'Link' => $link)
		);
        

		if($this->cart->insert($data))
		{
			$result = 1;
			if($result){
			 	echo json_encode(array('type' => 'success', 'msg' => 'Record Add successfully'));
			}
		}
	}

	public function addtocartAjax(){

		$total = $this->cart->format_number($this->cart->total());
		foreach ($this->cart->contents() as  $value) {
		 	$cartdata[] = $value;
		 	//echo '<pre>';	
		 	//print_r($cartdata);
		}
		echo json_encode(array('type' => 'returndata', 'msg' => $cartdata, 'total' => $total));
	}

	#cartpage section
	public function cartpage(){
    	    #update cart page
			if ($this->input->post('update_cart'))
			{
				unset($_POST['update_cart']);
				$contents = $this->input->post();
				
				foreach ($contents as $content)
				{
					$info = array(
				   		'rowid' => $content['rowid'],
				   		'qty'   => $content['qty']
					 );

					$this->cart->update($info);

				}
			}

			#clear cart page
			if ($this->input->post('clear_cart'))
			{
				unset($_POST['clear_cart']);
				$contents = $this->input->post();
				
				foreach ($contents as $content)
				{
					$info = array(
				   		'rowid' => $content['rowid'],
				   		'qty'   => 0
					 );

					$this->cart->update($info);

				}
			}

			$email = $this->session->userdata('email');
			$data['records'] = $this->homemodel->isEmailExist($email);

			if(count($this->cart->contents())==0){
				
				$array_items = array(
							'coupon_code'   , 
							'offer'         ,
							'exp_date'      ,
							'discount_price'
						);
				$this->session->unset_userdata($array_items);

			}

   			$this->get_header();
			$this->load->view('template/cartpage', $data);
			$this->get_footer();
    }

   	#delete individual product from cart page
    public function daletecart(){
        $rowid = $this->uri->segment(3); 

		$info = array(
	   		'rowid' => $rowid,
	   		'qty'   => 0
		 );

		if($this->cart->update($info)){
			$result = 1;
			if($result){
			 	echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Deleted successfully'));
			}
		}

	}

	#individual product detail page
	public function productdetail(){
		$pro_name = $this->uri->segment(3);

        $pro_newname = str_replace("_", " ", $pro_name); 

		$where = array(
					'title' => $pro_newname, 
				 );

        $data['result'] = $this->homemodel->getSingleRecords('menu_meals', $where);
        
		$this->get_header();
		$this->load->view('template/productdetail', $data);
		$this->get_footer();
	}

	#load register view
	public function register(){
		$this->get_header();
		$this->load->view('template/register');
		$this->get_footer();
	}

	#registration process
	#data will save in 3 table 
	#user table, personal_detail table, user_address table
	public function registerAction(){
		$config = $this->custom_form_validation->user_register(); 
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}
        
        if($this->form_validation->run()==FALSE){
        	
        	$errorArr = array(
        		'firstname'    =>  form_error('firstname'),
        		'lastname'     =>  form_error('lastname'),
        		'email'        =>  form_error('email'),
        		'password'     =>  form_error('password'),
        		'confirmpass'  =>  form_error('confirmpass'),
        		'address1'     =>  form_error('address1'),
        		'county'       =>  form_error('county'),
        		'city'         =>  form_error('city'),
        		//'state'        =>  form_error('state'),
        		'zip'          =>  form_error('zip')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
        }else{

        	
        	
        	$email  =  $this->input->post('email');
        	$pass   =  $this->input->post('password');

        	$fname      =  $this->input->post('firstname');
        	$lname      =  $this->input->post('lastname');
        	$phone      =  $this->input->post('phone');
            $fax        =  $this->input->post('fax');
            $aboutus    =  $this->input->post('hearabtus');
            $allergies  =  $this->input->post('allergies');

            // save allergies in db with ,
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



            $company    =  $this->input->post('company');
            $address1   =  $this->input->post('address1');
            $address2   =  $this->input->post('address2');
            $county     =  $this->input->post('county');
            $city       =  $this->input->post('city');
            $state      =  $this->input->post('state');
            $zip        =  $this->input->post('zip');
        	        	
        	$data_user =  array(
		        		'email'     =>  $email, 
		        		'password'  =>  md5($pass), 
		        		'status'    =>  '1',
		        		'role'      =>  '2'  
		        		);
        	$id = $this->homemodel->insertData("user",$data_user); //this query will return last insert id
            
            $data_personaldetail =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'hearabtus' =>  $aboutus,
		        		'allergies' =>  $allergieval,
		        		'uid'       =>  $id //last insert id by above query 
		        		);
            $result_personaldetail = $this->homemodel->insertData("personal_detail", $data_personaldetail);
            
            $data_user_address =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'company'   =>  $company,
		        		'address1'  =>  $address1,
		        		'address2'  =>  $address2,
		        		'county'    =>  $county,
		        		'city'      =>  $city,
		        		'state'     =>  'New Jersey',
		        		'zip'       =>  $zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            $result_user_address = $this->homemodel->insertData("user_address", $data_user_address);

            $data_billing_address =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'email'     =>  $email,
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'company'   =>  $company,
		        		'address1'  =>  $address1,
		        		'address2'  =>  $address2,
		        		'county'    =>  $county,
		        		'city'      =>  $city,
		        		'state'     =>  'New Jersey',
		        		'zip'       =>  $zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            $result_billing_address = $this->homemodel->insertData("billing_address", $data_billing_address);
            
            if($result_personaldetail && $result_user_address && $result_billing_address){
             	echo json_encode(array('type' => 'success', 'msgs' => 'Registration successfully'));
            }else{
            	echo json_encode(array('type' => 'failed', 'msgs' => 'Please try again'));
            }
        }	
	
	}

	#This function will call when user will registration from billing page
	#registration process
	#data will save in 3 table 
	#user table, personal_detail table, user_address table
	#$id_segment = 0 -> if delivery address is different, 
	#$id_segment = 1 -> if delivery address is same

	public function billingRegisterAction(){

		$id_segment = $this->uri->segment(3); 
		
		if($id_segment==1){
			$config = $this->custom_form_validation->user_register(); 
			foreach($config as $val) {
				$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
			}
		}else{
			$config = $this->custom_form_validation->billing_user_register(); 
			foreach($config as $val) {
				$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
			}
		}
        
        if($this->form_validation->run()==FALSE){
        	
	        if($id_segment==1){
	        	$errorArr = array(
		        		'firstname'    =>  form_error('firstname'),
		        		'lastname'     =>  form_error('lastname'),
		        		'email'        =>  form_error('email'),
		        		'password'     =>  form_error('password'),
		        		'confirmpass'  =>  form_error('confirmpass'),
		        		'address1'     =>  form_error('address1'),
		        		'county'       =>  form_error('county'),
		        		'city'         =>  form_error('city'),
		        		'zip'          =>  form_error('zip')
	        		);
	        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
	        }else{

	        	
	        	$errorArr = array(
		        		'firstname'    =>  form_error('firstname'),
		        		'lastname'     =>  form_error('lastname'),
		        		'email'        =>  form_error('email'),
		        		'password'     =>  form_error('password'),
		        		'confirmpass'  =>  form_error('confirmpass'),
		        		'address1'     =>  form_error('address1'),
		        		'county'       =>  form_error('county'),
		        		'city'         =>  form_error('city'),
		        		'zip'          =>  form_error('zip'),

		        		'dlvryfirstname'    =>  form_error('dlvryfirstname'),
		        		'dlvrylastname'     =>  form_error('dlvrylastname'),
		        		'dlvryaddress1'     =>  form_error('dlvryaddress1'),
		        		'dlvrycounty'       =>  form_error('dlvrycounty'),
		        		'dlvrycity'         =>  form_error('dlvrycity'),
		        		'dlvryzip'          =>  form_error('dlvryzip')
	        		);
	        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));

	        }	
        
        }else{

        	
        	
        	$email  =  $this->input->post('email');
        	$pass   =  $this->input->post('password');

        	$fname      =  $this->input->post('firstname');
        	$lname      =  $this->input->post('lastname');
        	$phone      =  $this->input->post('phone');
            $fax        =  $this->input->post('fax');
            $aboutus    =  $this->input->post('hearabtus');
            $allergies  =  $this->input->post('allergies');

            // save allergies in db with ,
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



            $company    =  $this->input->post('company');
            $address1   =  $this->input->post('address1');
            $address2   =  $this->input->post('address2');
            $county     =  $this->input->post('county');
            $city       =  $this->input->post('city');
            $state      =  $this->input->post('state');
            $zip        =  $this->input->post('zip');
        	        	
        	$data_user =  array(
		        		'email'     =>  $email, 
		        		'password'  =>  md5($pass), 
		        		'status'    =>  '1',
		        		'role'      =>  '2'  
		        		);
        	$id = $this->homemodel->insertData("user",$data_user); //this query will return last insert id
            
            $data_personaldetail =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'hearabtus' =>  $aboutus,
		        		'allergies' =>  $allergieval,
		        		'uid'       =>  $id //last insert id by above query 
		        		);
            $result_personaldetail = $this->homemodel->insertData("personal_detail", $data_personaldetail);
            
            if($id_segment==1){ // if address is same
            	$data_user_address =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'company'   =>  $company,
		        		'address1'  =>  $address1,
		        		'address2'  =>  $address2,
		        		'county'    =>  $county,
		        		'city'      =>  $city,
		        		'state'     =>  'New Jersey',
		        		'zip'       =>  $zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            	$result_user_address = $this->homemodel->insertData("user_address", $data_user_address);
            }else{ // if address is different 

	            $dlvryfname      =  $this->input->post('dlvryfirstname');
	        	$dlvrylname      =  $this->input->post('dlvrylastname');
	        	$dlvryphone      =  $this->input->post('dlvryphone');
	            $dlvryfax        =  $this->input->post('dlvryfax');
				$dlvrycompany    =  $this->input->post('dlvrycompany');
	            $dlvryaddress1   =  $this->input->post('dlvryaddress1');
	            $dlvryaddress2   =  $this->input->post('dlvryaddress2');
	            $dlvrycounty     =  $this->input->post('dlvrycounty');
	            $dlvrycity       =  $this->input->post('dlvrycity');
	            $dlvrystate      =  $this->input->post('dlvrystate');
	            $dlvryzip        =  $this->input->post('dlvryzip');

            	$data_user_address =  array(
		        		'firstname' =>  $dlvryfname, 
		        		'lastname'  =>  $dlvrylname, 
		        		'phone'     =>  $dlvryphone,
		        		'fax'       =>  $dlvryfax,
		        		'company'   =>  $dlvrycompany,
		        		'address1'  =>  $dlvryaddress1,
		        		'address2'  =>  $dlvryaddress2,
		        		'county'    =>  $dlvrycounty,
		        		'city'      =>  $dlvrycity,
		        		'state'     =>  'New Jersey',
		        		'zip'       =>  $dlvryzip,
		        		'uid'       =>  $id //last insert id 
		        		);
            	$result_user_address = $this->homemodel->insertData("user_address", $data_user_address);
            }

            

            $data_billing_address =  array(
		        		'firstname' =>  $fname, 
		        		'lastname'  =>  $lname, 
		        		'email'     =>  $email,
		        		'phone'     =>  $phone,
		        		'fax'       =>  $fax,
		        		'company'   =>  $company,
		        		'address1'  =>  $address1,
		        		'address2'  =>  $address2,
		        		'county'    =>  $county,
		        		'city'      =>  $city,
		        		'state'     =>  'New Jersey',
		        		'zip'       =>  $zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            $result_billing_address = $this->homemodel->insertData("billing_address", $data_billing_address);
            
            if($result_personaldetail && $result_user_address && $result_billing_address){
             	
            	// send mail when user will registered

            	$msg = '<table style="width:100%;">
							<tbody>
								<tr>
									<td>Welcome and thank you for registering at Simply Delicious Dinners!</td>
								</tr>

								<tr>
									<td>Your account has now been created and you can log in by using your email address and password by visiting our website or at the following URL:</td>
								</tr>

								<tr>
									<td><a href="'.base_url('user_admin').'" target="_blank">'.base_url('user_admin').'</a></td>
								</tr>

								<tr>
									<td>Upon logging in, you will be able to access other services</td>
								</tr>
							</tbody>
						</table>';	

				$this->email->from('simplydeliciousdinners@outlook.com', 'Welcome');
	            $this->email->to($email);
	            $this->email->subject('Welcome '.$fname);
	            $this->email->set_mailtype("html");
	            $this->email->message($msg);
	            $this->email->send();

            	// end code of send mail when user will registered

             	// after registeration user will login
            	$result  = $this->homemodel->user_login($email, $pass);
				$admin_session = array(
					'email' =>  $email,
					'id'	=>  $id,
				);
				$this->session->set_userdata($admin_session);


             	echo json_encode(array('type' => 'success', 'msgs' => 'Registration successfully you will redirect to billing page within 2 seconds'));
            }else{
            	echo json_encode(array('type' => 'failed', 'msgs' => 'Please try again'));
            }
        }	
	
	}

	#set session for registered user
	public function setUserSession(){
		$checkbox_value = $this->uri->segment(3); 
		$billing_id     = $this->uri->segment(4); 
		$dlvry_id       = $this->uri->segment(5); 
		$uid            = $this->session->userdata('id');

		if($checkbox_value==1){ //1 -> if delivery address is same
			
			$where = array(
						'uid' => $uid, 
						'id'  => $billing_id, 
					 );
			$data = $this->homemodel->getAllRecordsWhere('billing_address', $where);
			
			$register_billing_id        = $data[0]['id'];
            $register_billing_uid       = $data[0]['uid'];
            $register_billing_firstname = $data[0]['firstname'];
            $register_billing_lastname  = $data[0]['lastname'];
            $register_billing_email     = $data[0]['email'];
            $register_billing_company   = $data[0]['company'];
            $register_billing_phone     = $data[0]['phone'];
            $register_billing_fax       = $data[0]['fax'];
            $register_billing_address1  = $data[0]['address1'];
            $register_billing_address2  = $data[0]['address2'];
            $register_billing_city      = $data[0]['city'];
            $register_billing_state     = $data[0]['state'];
            $register_billing_zip       = $data[0]['zip'];
            $register_billing_county    = $data[0]['county'];
			
			// set session
			$registered_user_session = array(
					'register_billing_id'        => $register_billing_id,
					'register_billing_uid'		 =>	$register_billing_uid,
					'register_billing_firstname' => $register_billing_firstname,
					'register_billing_lastname'  => $register_billing_lastname,
					'register_billing_email'     => $register_billing_email,
					'register_billing_company'   => $register_billing_company,
					'register_billing_phone'     => $register_billing_phone,
					'register_billing_fax'       => $register_billing_fax,
					'register_billing_address1'  => $register_billing_address1,
					'register_billing_address2'  => $register_billing_address2,
					'register_billing_city'      => $register_billing_city,
					'register_billing_state'     => $register_billing_state,
					'register_billing_zip'       => $register_billing_zip,
					'register_billing_county'    => $register_billing_county,
					'register_dlvry_id'          => '',

					'checkbox_value'             => $checkbox_value,
				);
			$this->session->set_userdata($registered_user_session);

			if($this->session->userdata('register_billing_id')){
				echo json_encode(array('type' => 'success', 'msgs' => 'Shortly you will redirect to order summary page'));
			}else{
				echo json_encode(array('type' => 'failed', 'msgs' => 'Something is going wrong'));	
			}
			

		}else{ //0 -> if delivery address is different

			$where = array(
						'uid' => $uid, 
						'id'  => $billing_id, 
					 );
			$data = $this->homemodel->getAllRecordsWhere('billing_address', $where);
			
			$register_billing_id        = $data[0]['id'];
            $register_billing_uid       = $data[0]['uid'];
            $register_billing_firstname = $data[0]['firstname'];
            $register_billing_lastname  = $data[0]['lastname'];
            $register_billing_email     = $data[0]['email'];
            $register_billing_company   = $data[0]['company'];
            $register_billing_phone     = $data[0]['phone'];
            $register_billing_fax       = $data[0]['fax'];
            $register_billing_address1  = $data[0]['address1'];
            $register_billing_address2  = $data[0]['address2'];
            $register_billing_city      = $data[0]['city'];
            $register_billing_state     = $data[0]['state'];
            $register_billing_zip       = $data[0]['zip'];
            $register_billing_county    = $data[0]['county'];

            // get delivery address detail 
            $where = array(
						'uid' => $uid, 
						'id'  => $dlvry_id, 
					 );
			$data_dlvry = $this->homemodel->getAllRecordsWhere('user_address', $where);

			$register_dlvry_id        = $data_dlvry[0]['id'];
            $register_dlvry_uid       = $data_dlvry[0]['uid'];
            $register_dlvry_firstname = $data_dlvry[0]['firstname'];
            $register_dlvry_lastname  = $data_dlvry[0]['lastname'];
            $register_dlvry_company   = $data_dlvry[0]['company'];
            $register_dlvry_phone     = $data_dlvry[0]['phone'];
            $register_dlvry_fax       = $data_dlvry[0]['fax'];
            $register_dlvry_address1  = $data_dlvry[0]['address1'];
            $register_dlvry_address2  = $data_dlvry[0]['address2'];
            $register_dlvry_city      = $data_dlvry[0]['city'];
            $register_dlvry_state     = $data_dlvry[0]['state'];
            $register_dlvry_zip       = $data_dlvry[0]['zip'];
            $register_dlvry_county    = $data_dlvry[0]['county'];



            // set session
            $registered_user_session = array(
					'register_billing_id'        => $register_billing_id,
					'register_billing_uid'		 =>	$register_billing_uid,
					'register_billing_firstname' => $register_billing_firstname,
					'register_billing_lastname'  => $register_billing_lastname,
					'register_billing_email'     => $register_billing_email,
					'register_billing_company'   => $register_billing_company,
					'register_billing_phone'     => $register_billing_phone,
					'register_billing_fax'       => $register_billing_fax,
					'register_billing_address1'  => $register_billing_address1,
					'register_billing_address2'  => $register_billing_address2,
					'register_billing_city'      => $register_billing_city,
					'register_billing_state'     => $register_billing_state,
					'register_billing_zip'       => $register_billing_zip,
					'register_billing_county'    => $register_billing_county,
					
					'checkbox_value'             => $checkbox_value,

					'register_dlvry_id'        => $register_dlvry_id,
					'register_dlvry_uid'	   => $register_dlvry_uid,	 
					'register_dlvry_firstname' => $register_dlvry_firstname,
					'register_dlvry_lastname'  => $register_dlvry_lastname,
					'register_dlvry_company'   => $register_dlvry_company, 
					'register_dlvry_phone'     => $register_dlvry_phone,
					'register_dlvry_fax'       => $register_dlvry_fax,
					'register_dlvry_address1'  => $register_dlvry_address1,
					'register_dlvry_address2'  => $register_dlvry_address2,
					'register_dlvry_city'      => $register_dlvry_city,
					'register_dlvry_state'     => $register_dlvry_state,
					'register_dlvry_zip'       => $register_dlvry_zip,
					'register_dlvry_county'    => $register_dlvry_county,


				);
			$this->session->set_userdata($registered_user_session);

			if($this->session->userdata('register_billing_id')){
				echo json_encode(array('type' => 'success', 'msgs' => 'Shortly you will redirect to order summary page'));
			}else{
				echo json_encode(array('type' => 'failed', 'msgs' => 'Something is going wrong'));	
			}

		}
	}

	#send product enquiry on mail for Registered user
	public function BillingRegisteredUserEmail(){

		//$this->load->library('email');

		$sess_reg_billing_email            =  $this->session->userdata('register_billing_email');
		$sess_reg_billing_first_name       =  $this->session->userdata('register_billing_firstname');
		$sess_reg_billing_last_name        =  $this->session->userdata('register_billing_lastname');
		$sess_reg_billing_fax              =  $this->session->userdata('register_billing_fax');
		$sess_reg_billing_phone            =  $this->session->userdata('register_billing_phone');
		$sess_reg_billing_company          =  $this->session->userdata('register_billing_company');
		$sess_reg_billing_adderss1         =  $this->session->userdata('register_billing_address1');
		$sess_reg_billing_address2         =  $this->session->userdata('register_billing_address2');
		$sess_reg_billing_county           =  $this->session->userdata('register_billing_county');
		$sess_reg_billing_city             =  $this->session->userdata('register_billing_city');
		$sess_reg_billing_state            =  $this->session->userdata('register_billing_state');
		$sess_reg_billing_zip              =  $this->session->userdata('register_billing_zip');

		$checkbox_value                    =  $this->session->userdata('checkbox_value'); // it will contain 0 or 1

		
		$sess_reg_dlvry_first_name =  $this->session->userdata('register_dlvry_firstname');
		$sess_reg_dlvry_last_name  =  $this->session->userdata('register_dlvry_lastname');
		$sess_reg_dlvry_fax        =  $this->session->userdata('register_dlvry_fax');
		$sess_reg_dlvry_phone      =  $this->session->userdata('register_dlvry_phone');
		$sess_reg_dlvry_company    =  $this->session->userdata('register_dlvry_company');
		$sess_reg_dlvry_adderss1   =  $this->session->userdata('register_dlvry_address1');
		$sess_reg_dlvry_address2   =  $this->session->userdata('register_dlvry_address2');
		$sess_reg_dlvry_county     =  $this->session->userdata('register_dlvry_county');
		$sess_reg_dlvry_city       =  $this->session->userdata('register_dlvry_city');
		$sess_reg_dlvry_state      =  $this->session->userdata('register_dlvry_state');
		$sess_reg_dlvry_zip        =  $this->session->userdata('register_dlvry_zip');	


		// mail function for Registered User 
		

				$msg = '<br/><br/>';

				if($checkbox_value==1){
					$msg .= '<table style="width:100%;">
					<thead>
						<tr>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Billing Address </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Shipping Address </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_reg_billing_first_name. " ".$sess_reg_billing_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Email </strong>".$sess_reg_billing_email.", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_reg_billing_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_reg_billing_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_reg_billing_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_reg_billing_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_reg_billing_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_reg_billing_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_reg_billing_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_reg_billing_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_reg_billing_state.", ".'</td></tr>
								</table>
							</td>

							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_reg_billing_first_name. " ".$sess_reg_billing_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_reg_billing_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_reg_billing_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_reg_billing_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_reg_billing_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_reg_billing_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_reg_billing_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_reg_billing_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_reg_billing_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_reg_billing_state.", ".'</td></tr>
								</table>
							</td>
						</tr>
					</tbody>
				    </table>';
				}else{
				$msg .=	'<table style="width:100%;">
					<thead>
						<tr>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Billing Address </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Shipping Address </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
								    <tr><td>'."<strong>Name </strong>".$sess_reg_billing_first_name. " ".$sess_reg_billing_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Email </strong>".$sess_reg_billing_email.", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_reg_billing_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_reg_billing_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_reg_billing_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_reg_billing_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_reg_billing_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_reg_billing_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_reg_billing_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_reg_billing_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_reg_billing_state.", ".'</td></tr>
								</table>
							</td>

							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_reg_dlvry_first_name. " ". $sess_reg_dlvry_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_reg_dlvry_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_reg_dlvry_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_reg_dlvry_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_reg_dlvry_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_reg_dlvry_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_reg_dlvry_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_reg_dlvry_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_reg_dlvry_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_reg_dlvry_state.", ".'</td></tr>
									
								</table>
							</td>
						</tr>
					</tbody>
				    </table>';
				}

				$msg .= '<br/><br/>';

				// =======================

				$msg .=	'<table style="width:100%;">
							<thead>
								<tr>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Name </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Types Of Product</th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> quantity </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Price </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> subtotal </th>
								</tr>
							</thead>

							<tbody>';


						// ===============
						$totalamonut = $this->cart->format_number($this->cart->total());	
                     	$i = 1; 
						foreach ($this->cart->contents() as $items){

							$msg .= '<tr>';

								foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
						             if($option_name == 'Link' && $option_value){ 
						             	 $msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['name']. '</td>';
						             }elseif($option_name == 'Link' && $option_value == ''){
						                 $msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['name']. '</td>';
						       		 } 
					         	}

					            
					            if ($this->cart->has_options($items['rowid']) == TRUE){
									foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
							            if(($option_name == 'Servings' || $option_name == 'Tray') && $option_value){ 
							            	$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left"> '.$option_name. " - ". $option_value. '</td>';
							            } 
						            }
								}
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['qty']. '</td>';
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'."$".$items['price']. '</td>';
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'."$".$items['subtotal']. '</td>';

							$msg .= '</tr>';

							$i++;
						}
						// ============	

						$msg .= '<tr> <td colspan="5" style="text-align:right;"><strong>Total</strong>: ' ."$".$totalamonut. '</td> </tr>';

						$msg .=	'</tbody>
						</table>';
				
				// ==========================

				//echo $sess_reg_billing_email;		
				//echo $msg;
						
				$this->email->from('simplydeliciousdinners@outlook.com', 'Order Summary');
	            $this->email->to($sess_reg_billing_email);
	            $this->email->subject('Order Summary');
	            $this->email->set_mailtype("html");
	            $this->email->message($msg);
	            $this->email->send();

	            // if($this->email->send()){
	            // 	echo "mail send";
	            // }else{
	            	
	            // }

		// end mail function for registered user
	}

	#This function will call when user will purchase product as a guest
	#data will save in 3 table 
	#user table, personal_detail table, user_address table
	#$id_segment = 0 -> if delivery address is different, 
	#$id_segment = 1 -> if delivery address is same

	public function billingGuestAction(){

		$id_segment = $this->uri->segment(3); 

		
		if($id_segment==1){ //$id_segment = 1 -> if delivery address is same
			$config = $this->custom_form_validation->guest_billing(); 
			foreach($config as $val) {
				$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
			}
		}else{ //$id_segment = 0 -> if delivery address is different, 
			$config = $this->custom_form_validation->guest_billing_n_delivery(); 
			foreach($config as $val) {
				$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
			}
		}
        
        if($this->form_validation->run()==FALSE){
        
		        if($id_segment==1){ //$id_segment = 1 -> if delivery address is same
		        	$errorArr = array(
			        		'firstname'    =>  form_error('firstname'),
			        		'lastname'     =>  form_error('lastname'),
			        		'email'        =>  form_error('email'),
			        		'address1'     =>  form_error('address1'),
			        		'county'       =>  form_error('county'),
			        		'city'         =>  form_error('city'),
			        		'zip'          =>  form_error('zip')
		        		);
		    
		        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
		        }else{ //$id_segment = 0 -> if delivery address is different, 

		        	
		        	$errorArr = array(
			        		'firstname'         =>  form_error('firstname'),
			        		'lastname'          =>  form_error('lastname'),
			        		'email'             =>  form_error('email'),
			        		'address1'          =>  form_error('address1'),
			        		'county'            =>  form_error('county'),
			        		'city'              =>  form_error('city'),
			        		'zip'               =>  form_error('zip'),
			        		'dlvryfirstname'    =>  form_error('dlvryfirstname'),
			        		'dlvrylastname'     =>  form_error('dlvrylastname'),
			        		'dlvryaddress1'     =>  form_error('dlvryaddress1'),
			        		'dlvrycounty'       =>  form_error('dlvrycounty'),
			        		'dlvrycity'         =>  form_error('dlvrycity'),
			        		'dlvryzip'          =>  form_error('dlvryzip')
		        		);
		        	echo json_encode(array('type' => 'error', 'msgs' => $errorArr));

		        }	
        
        }else{ // if all fields are filled

        	
        	
        	$email      =  $this->input->post('email');
        	
        	$fname      =  $this->input->post('firstname');
        	$lname      =  $this->input->post('lastname');
        	$phone      =  $this->input->post('phone');
            $fax        =  $this->input->post('fax');

            $company    =  $this->input->post('company');
            $address1   =  $this->input->post('address1');
            $address2   =  $this->input->post('address2');
            $county     =  $this->input->post('county');
            $city       =  $this->input->post('city');
            $state      =  'New Jersey';
            $zip        =  $this->input->post('zip');

           	
           	if($id_segment==1){ //if delivery address is same

           		//echo "segement 	1";

           		$guest_session = array(

					'guest_email'      =>  $email,
					'guest_first_name' =>  $fname,
					'guest_last_name'  =>  $lname,
					'guest_fax'        =>  $fax,
					'guest_phone'      =>  $phone,
					'guest_company'    =>  $company,
					'guest_adderss1'   =>  $address1,
					'guest_address2'   =>  $address2,
					'guest_county'     =>  $county,
					'guest_city'       =>  $city,
					'guest_state'      =>  $state,
					'guest_zip'        =>  $zip,

					'guest_delivery'   => $id_segment, // contain value 1

					
				);

				$this->session->set_userdata($guest_session);

           	}else{ //if delivery address is different

           		//echo "segement 	0";

       		    $dlvryfname      =  $this->input->post('dlvryfirstname');
	        	$dlvrylname      =  $this->input->post('dlvrylastname');
	        	$dlvryphone      =  $this->input->post('dlvryphone');
	            $dlvryfax        =  $this->input->post('dlvryfax');
				$dlvrycompany    =  $this->input->post('dlvrycompany');
	            $dlvryaddress1   =  $this->input->post('dlvryaddress1');
	            $dlvryaddress2   =  $this->input->post('dlvryaddress2');
	            $dlvrycounty     =  $this->input->post('dlvrycounty');
	            $dlvrycity       =  $this->input->post('dlvrycity');
	            $dlvrystate      =  'New Jersey';
	            $dlvryzip        =  $this->input->post('dlvryzip');

	            $guest_session = array(
           			
					'guest_email'      =>  $email,
					'guest_first_name' =>  $fname,
					'guest_last_name'  =>  $lname,
					'guest_fax'        =>  $fax,
					'guest_phone'      =>  $phone,
					'guest_company'    =>  $company,
					'guest_adderss1'   =>  $address1,
					'guest_address2'   =>  $address2,
					'guest_county'     =>  $county,
					'guest_city'       =>  $city,
					'guest_state'      =>  $state,
					'guest_zip'        =>  $zip,

					'guest_delivery'   => $id_segment, // contain value 0

					'guest_dlvry_first_name' =>  $dlvryfname,
					'guest_dlvry_last_name'  =>  $dlvrylname,
					'guest_dlvry_fax'        =>  $dlvryfax,
					'guest_dlvry_phone'      =>  $dlvryphone,
					'guest_dlvry_company'    =>  $dlvrycompany,
					'guest_dlvry_adderss1'   =>  $dlvryaddress1,
					'guest_dlvry_address2'   =>  $dlvryaddress2,
					'guest_dlvry_county'     =>  $dlvrycounty,
					'guest_dlvry_city'       =>  $dlvrycity,
					'guest_dlvry_state'      =>  $dlvrystate,
					'guest_dlvry_zip'        =>  $dlvryzip,

					
				);

				$this->session->set_userdata($guest_session);

           	} 	

           	echo json_encode(array('type' => 'success', 'msgs' => 'Address successfully insert you will redirect to order summary page within 2 seconds'));


        }	
	
	}



	#load checkout view
	#if session is set than it will redirect to home/billing/registereduser
	public function checkout(){

		if ($this->check_user_sess()) {
			redirect(base_url('home/billing/registereduser'), 'refresh'); 
        }else{
        	$this->get_header();
			$this->load->view('template/checkout');
			$this->get_footer();
        }

	}

	#check user session after login at checkout page
	Public function check_user_sess(){
		$sess_var = $this->session->userdata('email');
		if(!empty($sess_var)){
			return true;
		}else{
			return false;
		}
		
	}


	public function billingAction(){

		$usertype    =  $this->input->post('usertype');
		
		if($usertype){
         	echo json_encode(array('type' => 'success', 'msgs' => $usertype));
        }else{
        	echo json_encode(array('type' => 'failed', 'msgs' => 'Please try again'));
        }
	}


	public function billing(){

		if($this->check_user_sess()) {
			$usertype = $this->uri->segment(3); 			
			//if($usertype=='register' || $usertype=='guest'){
			if($usertype=='register' || $usertype=='guest'){
				redirect(base_url('home/billing/registereduser'), 'refresh');
			}
        }else if(!$this->check_user_sess()){
        	$usertype = $this->uri->segment(3); 			
        	if($usertype=='registereduser'){
				redirect(base_url('home'), 'refresh');
			}
        }	

		$usertype = $this->uri->segment(3); 

		$sessionid = $this->session->userdata('id');
		$where = array('uid' => $sessionid,);

		$data['usertype'] = array('usertype' => $usertype);

		$data['singleuserdata'] = $this->homemodel->getAllRecordsWhere('user_address', $where);

		$data['billingaddress'] = $this->homemodel->getAllRecordsWhere('billing_address', $where);

		$this->get_header();
		$this->load->view('template/billing', $data);
		$this->get_footer();
	}

	#user login at billing page
	public function loginBillingAction(){
    		$config = $this->custom_form_validation->Chk_validation(); 
    		foreach($config as $val) {
    			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
    		}
		    
		    
    		if($this->form_validation->run()==FALSE){
    			$errorArr = array(
        		'email'     => form_error('email'),
        		'password'  => form_error('password')
        		);
        		echo json_encode(array('type' => 'error', 'msgs' => $errorArr));
    		}else{
    			
            	$email     = $this->input->post('email');
	    		$pass      = $this->input->post('password');
	    		$remember  = $this->input->post('remember');

	    		$usertype = $this->uri->segment(3);


	    		if($remember==1){
                	$cookie = array(
					    'name'   => 'remember_me',
					    'value'  => $email.'/'.$pass,
					    'expire' => '1209600'  // Two weeks
					);

					$this->input->set_cookie($cookie);
				}

	    		
	    		$result = $this->homemodel->user_login($email, $pass);

	    		//print_r($result);
                 
                if(!empty($result)) {
                	
                	$sess_email = $result['0']['email'];
                	$sess_uid   = $result['0']['id'];
		    		$admin_session = array(
		            	'email' =>  $sess_email,
		            	'id'    =>  $sess_uid,
		    		);
		    		$this->session->set_userdata($admin_session);
		    		
		    		//$data['usertype'] = array('usertype' => $usertype);

		    		echo json_encode(array('type' => 'success','msg' => 'registereduser'));

                }else{
                	echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
                }

    		}

	}



    // this function will work after click on checkout button from cart page
	function buy(){

		

		if($this->session->userdata('guest_email') || $this->session->userdata('email')){
			$returnURL = base_url().'home/success'; //payment success url
			$cancelURL = base_url().'home/cancel'; //payment cancel url
			$notifyURL = base_url().'home/ipn'; //ipn url
			
			
			$i = 1; 
			
			$email = $this->config->item('business');
			$this->paypal_lib->add_field('business', $email);
			$this->paypal_lib->add_field('return', $returnURL);
			$this->paypal_lib->add_field('cancel_return', $cancelURL);
			$this->paypal_lib->add_field('notify_url', $notifyURL);
			

			foreach ($this->cart->contents() as $items){

				$name     = $items['name'];
				$qty      = $items['qty']; 
				$subtotal = $items['subtotal']; 

				$userID = 1; //current user id
	            
	            //item_name, custom, item_number, amount this name is fixed we can't change
				$this->paypal_lib->add_field('item_name_'.$i, $name);
				//$this->paypal_lib->add_field('custom', $userID);
				$this->paypal_lib->add_field('item_number_'.$i,  $items['rowid']);
				$this->paypal_lib->add_field('amount_'.$i,  $items['price']);		
				$this->paypal_lib->add_field('quantity_'.$i,  $qty);		
				//$this->paypal_lib->image($logo);

				$i++; 
			}

			//echo "above submit";
			
			$post_var = ($_POST);

			$is_post = $post_var['path_chk'];

			if($is_post){
				$this->paypal_lib->paypal_auto_form();
			}else{
				redirect('home');
			}

		}else{
			redirect('home');
		}
	}


	#it will contain all data of guest session
	#Insert data in 4 table
	#it will fire when payment will success
	public function guestSessionData(){

		$sess_guest_email            =  $this->session->userdata('guest_email');
		$sess_guest_first_name       =  $this->session->userdata('guest_first_name');
		$sess_guest_last_name        =  $this->session->userdata('guest_last_name');
		$sess_guest_fax              =  $this->session->userdata('guest_fax');
		$sess_guest_phone            =  $this->session->userdata('guest_phone');
		$sess_guest_company          =  $this->session->userdata('guest_company');
		$sess_guest_adderss1         =  $this->session->userdata('guest_adderss1');
		$sess_guest_address2         =  $this->session->userdata('guest_address2');
		$sess_guest_county           =  $this->session->userdata('guest_county');
		$sess_guest_city             =  $this->session->userdata('guest_city');
		$sess_guest_state            =  $this->session->userdata('guest_state');
		$sess_guest_zip              =  $this->session->userdata('guest_zip');

		$sess_guest_delivery         =  $this->session->userdata('guest_delivery'); // it will contain 0 or 1

		
		$sess_guest_dlvry_first_name =  $this->session->userdata('guest_dlvry_first_name');
		$sess_guest_dlvry_last_name  =  $this->session->userdata('guest_dlvry_last_name');
		$sess_guest_dlvry_fax        =  $this->session->userdata('guest_dlvry_fax');
		$sess_guest_dlvry_phone      =  $this->session->userdata('guest_dlvry_phone');
		$sess_guest_dlvry_company    =  $this->session->userdata('guest_dlvry_company');
		$sess_guest_dlvry_adderss1   =  $this->session->userdata('guest_dlvry_adderss1');
		$sess_guest_dlvry_address2   =  $this->session->userdata('guest_dlvry_address2');
		$sess_guest_dlvry_county     =  $this->session->userdata('guest_dlvry_county');
		$sess_guest_dlvry_city       =  $this->session->userdata('guest_dlvry_city');
		$sess_guest_dlvry_state      =  $this->session->userdata('guest_dlvry_state');
		$sess_guest_dlvry_zip        =  $this->session->userdata('guest_dlvry_zip');

		// insert data in user table
		// @return id
		$data_user =  array(
		        		'email'     =>  $sess_guest_email, 
		        		'status'    =>  '0',
		        		'user_type' =>  '0',
		        		'role'      =>  '2'  
		        	);
    	$id = $this->homemodel->insertData("user",$data_user); //this query will return last insert id

    	// insert data in billing table 
    	// @retrun last insert id $result_billing_address
    	$data_billing_address =  array(
		        		'firstname' =>  $sess_guest_first_name, 
		        		'lastname'  =>  $sess_guest_last_name, 
		        		'email'     =>  $sess_guest_email,
		        		'phone'     =>  $sess_guest_phone,
		        		'fax'       =>  $sess_guest_fax,
		        		'company'   =>  $sess_guest_company,
		        		'address1'  =>  $sess_guest_adderss1,
		        		'address2'  =>  $sess_guest_address2,
		        		'county'    =>  $sess_guest_county,
		        		'city'      =>  $sess_guest_city,
		        		'state'     =>  $sess_guest_state,
		        		'zip'       =>  $sess_guest_zip,
		        		'uid'       =>  $id //last insert id 
		        		);
        $result_billing_address = $this->homemodel->insertData("billing_address", $data_billing_address);


    	// insert data in personal_detail 
    	// @return last insert id  $result_personaldetail
    	$data_personaldetail =  array(
		        		'firstname' =>  $sess_guest_first_name, 
		        		'lastname'  =>  $sess_guest_last_name, 
		        		'phone'     =>  $sess_guest_phone,
		        		'fax'       =>  $sess_guest_fax,
		        		'uid'       =>  $id //last insert id by above query 
		        		);
        $result_personaldetail = $this->homemodel->insertData("personal_detail", $data_personaldetail);

        //insert data in user_adress table
        // @return last insert id , $result_user_address
        if($sess_guest_delivery==1){ // if address is same
            	$data_user_address =  array(
		        		'firstname' =>  $sess_guest_first_name, 
		        		'lastname'  =>  $sess_guest_last_name, 
		        		'phone'     =>  $sess_guest_phone,
		        		'fax'       =>  $sess_guest_fax,
		        		'company'   =>  $sess_guest_company,
		        		'address1'  =>  $sess_guest_adderss1,
		        		'address2'  =>  $sess_guest_address2,
		        		'county'    =>  $sess_guest_county,
		        		'city'      =>  $sess_guest_city,
		        		'state'     =>  $sess_guest_state,
		        		'zip'       =>  $sess_guest_zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            	$result_user_address = $this->homemodel->insertData("user_address", $data_user_address);
            
        }else{ // if address is different 

	           
            	$data_user_address =  array(
		        		'firstname' =>  $sess_guest_dlvry_first_name, 
		        		'lastname'  =>  $sess_guest_dlvry_last_name, 
		        		'phone'     =>  $sess_guest_dlvry_phone,
		        		'fax'       =>  $sess_guest_dlvry_fax,
		        		'company'   =>  $sess_guest_dlvry_company,
		        		'address1'  =>  $sess_guest_dlvry_adderss1,
		        		'address2'  =>  $sess_guest_dlvry_address2,
		        		'county'    =>  $sess_guest_dlvry_county,
		        		'city'      =>  $sess_guest_dlvry_city,
		        		'state'     =>  $sess_guest_dlvry_state,
		        		'zip'       =>  $sess_guest_dlvry_zip,
		        		'uid'       =>  $id //last insert id 
		        		);
            	$result_user_address = $this->homemodel->insertData("user_address", $data_user_address);
        }

        $guest_address_session = array(
		            	'delivery_address_id' =>  $result_user_address,
		            	'billing_address_id'  =>  $result_billing_address,
		            	'guest_user_id'       =>  $id,
		    		);
		$this->session->set_userdata($guest_address_session);

		$this->BillingGuestEmail();


	}


	#send product enquiry on mail for guest user
	public function BillingGuestEmail(){

		$sess_guest_email            =  $this->session->userdata('guest_email');
		$sess_guest_first_name       =  $this->session->userdata('guest_first_name');
		$sess_guest_last_name        =  $this->session->userdata('guest_last_name');
		$sess_guest_fax              =  $this->session->userdata('guest_fax');
		$sess_guest_phone            =  $this->session->userdata('guest_phone');
		$sess_guest_company          =  $this->session->userdata('guest_company');
		$sess_guest_adderss1         =  $this->session->userdata('guest_adderss1');
		$sess_guest_address2         =  $this->session->userdata('guest_address2');
		$sess_guest_county           =  $this->session->userdata('guest_county');
		$sess_guest_city             =  $this->session->userdata('guest_city');
		$sess_guest_state            =  $this->session->userdata('guest_state');
		$sess_guest_zip              =  $this->session->userdata('guest_zip');

		$sess_guest_delivery         =  $this->session->userdata('guest_delivery'); // it will contain 0 or 1

		
		$sess_guest_dlvry_first_name =  $this->session->userdata('guest_dlvry_first_name');
		$sess_guest_dlvry_last_name  =  $this->session->userdata('guest_dlvry_last_name');
		$sess_guest_dlvry_fax        =  $this->session->userdata('guest_dlvry_fax');
		$sess_guest_dlvry_phone      =  $this->session->userdata('guest_dlvry_phone');
		$sess_guest_dlvry_company    =  $this->session->userdata('guest_dlvry_company');
		$sess_guest_dlvry_adderss1   =  $this->session->userdata('guest_dlvry_adderss1');
		$sess_guest_dlvry_address2   =  $this->session->userdata('guest_dlvry_address2');
		$sess_guest_dlvry_county     =  $this->session->userdata('guest_dlvry_county');
		$sess_guest_dlvry_city       =  $this->session->userdata('guest_dlvry_city');
		$sess_guest_dlvry_state      =  $this->session->userdata('guest_dlvry_state');
		$sess_guest_dlvry_zip        =  $this->session->userdata('guest_dlvry_zip');	


		// mail function for guest 
			$msg = '<table>
					<thead>
						<tr>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> First Name </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Last Name </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Email </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Phone </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Fax </th>


						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$sess_guest_email.'</td>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$sess_guest_last_name.'</td>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$sess_guest_email.'</td>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$sess_guest_phone.'</td>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">'.$sess_guest_fax.'</td>
						</tr>
					</tbody>
				</table>';

				$msg .= '<br/><br/>';

				if($this->session->userdata('guest_delivery')==1){
					$msg .= '<table style="width:100%;">
					<thead>
						<tr>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Billing Address </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Shipping Address </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_guest_first_name. " ".$sess_guest_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Email </strong>".$sess_guest_email.", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_guest_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_guest_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_guest_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_guest_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_guest_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_guest_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_guest_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_guest_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_guest_state.", ".'</td></tr>
								</table>
							</td>

							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_guest_first_name. " ".$sess_guest_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_guest_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_guest_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_guest_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_guest_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_guest_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_guest_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_guest_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_guest_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_guest_state.", ".'</td></tr>
								</table>
							</td>
						</tr>
					</tbody>
				    </table>';
				}else{
				$msg .=	'<table style="width:100%;">
					<thead>
						<tr>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Billing Address </th>
							<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Shipping Address </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
								    <tr><td>'."<strong>Name </strong>".$sess_guest_first_name. " ".$sess_guest_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Email </strong>".$sess_guest_email.", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_guest_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_guest_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_guest_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_guest_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_guest_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_guest_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_guest_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_guest_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_guest_state.", ".'</td></tr>
								</table>
							</td>

							<td style="border: 1px solid black ;border-collapse: collapse; padding: 5px; text-align: left;">
								<table>
									<tr><td>'."<strong>Name </strong>".$sess_guest_dlvry_first_name. " ". $sess_guest_dlvry_last_name. ", ".'</td></tr>
									<tr><td>'."<strong>Phone </strong>".$sess_guest_dlvry_phone.", ".'</td></tr>
									<tr><td>'."<strong>Fax </strong>".$sess_guest_dlvry_fax.", ".'</td></tr>
									<tr><td>'."<strong>Company </strong>".$sess_guest_dlvry_company.", ".'</td></tr>
									<tr><td>'."<strong>Address1 </strong>".$sess_guest_dlvry_adderss1.", ".'</td></tr>
									<tr><td>'."<strong>Address2 </strong>".$sess_guest_dlvry_address2.", ".'</td></tr>
									<tr><td>'."<strong>City </strong>".$sess_guest_dlvry_city.", ".'</td></tr>
									<tr><td>'."<strong>Zip </strong>".$sess_guest_dlvry_zip.", ".'</td></tr>
									<tr><td>'."<strong>County </strong>".$sess_guest_dlvry_county.", ".'</td></tr>
									<tr><td>'."<strong>State </strong>".$sess_guest_dlvry_state.", ".'</td></tr>
									
								</table>
							</td>
						</tr>
					</tbody>
				    </table>';
				}

				$msg .= '<br/><br/>';

				// =======================

				$msg .=	'<table style="width:100%;">
							<thead>
								<tr>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Name </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Types Of Product</th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> quantity </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> Price </th>
									<th style="background-color: #333333;color:white;border: 1px solid black;border-collapse: collapse;padding: 5px;text-align: left;"> subtotal </th>
								</tr>
							</thead>

							<tbody>';


						// ===============
						$totalamonut = $this->cart->format_number($this->cart->total());	
                     	$i = 1; 
						foreach ($this->cart->contents() as $items){

							$msg .= '<tr>';

								foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
						             if($option_name == 'Link' && $option_value){ 
						             	 $msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['name']. '</td>';
						             }elseif($option_name == 'Link' && $option_value == ''){
						                 $msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['name']. '</td>';
						       		 } 
					         	}

					            
					            if ($this->cart->has_options($items['rowid']) == TRUE){
									foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
							            if(($option_name == 'Servings' || $option_name == 'Tray') && $option_value){ 
							            	$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left"> '.$option_name. " - ". $option_value. '</td>';
							            } 
						            }
								}
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'.$items['qty']. '</td>';
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'."$".$items['price']. '</td>';
								$msg .= '<td style="border:1px solid black;border-collapse:collapse;padding:5px;text-align:left">'."$".$items['subtotal']. '</td>';

							$msg .= '</tr>';

							$i++;
						}
						// ============	

						$msg .= '<tr> <td colspan="5" style="text-align:right;"><strong>Total</strong>: ' ."$".$totalamonut. '</td> </tr>';

						$msg .=	'</tbody>
						</table>';
				
				// ==========================


				$this->email->from('simplydeliciousdinners@outlook.com', 'Order Summary');
	            $this->email->to($sess_guest_email);
	            $this->email->subject('Order Summary');
	            $this->email->set_mailtype("html");
	            $this->email->message($msg);
	            $this->email->send();

		// end mail function for guest
	}


	#if payment is success
	public function success(){

		$paypalInfo = $this->input->get();

		$payment_status = $data['status']  = $paypalInfo["st"];

		if($payment_status=='Completed'){
			if($this->session->userdata('guest_email')){ //if user purchasing product as a guest user
				$this->guestSessionData();  //this function will insert data 
			}		
		}

		foreach ($this->cart->contents() as $items){

			  $id       = $items['id'];
			  $qty      = $items['qty'];
			  $price    = $items['price'];
			  $name     = $items['name'];
			  $Servings = $items['options']['Servings'];
			  $Tray     = $items['options']['Tray'];
			  $Image    = $items['options']['Image'];
			  $Link     = $items['options']['Link'];
			  $subtotal = $items['subtotal'];
			  $rowid    = $items['rowid'];
			
			if(empty($Servings)){
				$pro_type = $Tray;
			}else{
				$pro_type = $Servings;
			}
	        
			$item_number    = $data['item_number']           = $paypalInfo['item_number']; 
			$txn_id         = $data['txn_id']                = $paypalInfo["tx"];
		 	$payment_gross  = $data['payment_amt']           = $paypalInfo["amt"];
			$currency_code  = $data['currency_code']         = $paypalInfo["cc"];
			$payment_status = $data['status']                = $paypalInfo["st"];
			$image          = $items['options']['Image'];
			$link           = $items['options']['Link'];
			
			
            #guest session data

			if($this->session->userdata('guest_email')){ //if user purchasing product as a guest user

					        
				$insertData = array(
								'user_id'         => $this->session->userdata('guest_user_id'),  
								'user_name'       => $this->session->userdata('guest_email'),  
								'delivery_add_id' => $this->session->userdata('delivery_address_id'),
								'billing_add_id'  => $this->session->userdata('billing_address_id'),
								'product_name'    => $name, 
								'quantity'        => $qty, 
								'product_type'    => $pro_type, 
								'delivery_date'   => '10', 
								'txn_id'          => $txn_id, 
								'payment_gross'   => $subtotal,  
								'currency_code'   => $currency_code, 
								'payment_status'  => $payment_status, 
							);

			}else{ // if user purchase product after registration or login

				$insertData = array(
								'user_id'         => $this->session->userdata('id'), 
								'user_name'       => $this->session->userdata('email'), 
								'delivery_add_id' => $this->session->userdata('register_dlvry_id'),
								'billing_add_id'  => $this->session->userdata('register_billing_id'),
								'product_name'    => $name, 
								'quantity'        => $qty, 
								'product_type'    => $pro_type, 
								'delivery_date'   => '10', 
								'txn_id'          => $txn_id, 
								'payment_gross'   => $subtotal,  
								'currency_code'   => $currency_code, 
								'payment_status'  => $payment_status,
							);

				
				// =====================coupon code start===================
					if($payment_status=='Completed'){
						$where = array(
										'uid'         => $this->session->userdata('id'), 
										'coupon_code' => $this->session->userdata('coupon_code'), 
									);

						$coupon_exist = $this->homemodel->isRecordExist('user_coupon',$where);

						if($coupon_exist==0){

							$insertcoupon = array(
								'uid'         => $this->session->userdata('id'), 
								'coupon_code' => $this->session->userdata('coupon_code'), 
								'count'       => '1',
							);
							$result = $this->homemodel->insertData('user_coupon', $insertcoupon);	
						}else{
							
							$where = array(
										'uid'         => $this->session->userdata('id'),  
										'coupon_code' => $this->session->userdata('coupon_code'),
									);

							$coupon_exist = $this->homemodel->getSingleRecords('user_coupon', $where);
							$count = $coupon_exist->count;
							$countupdate = $count + 1;

							if(2 >= $count){
								$insertcoupon = array(
									'uid'         => $this->session->userdata('id'),   
									'coupon_code' => $this->session->userdata('coupon_code'), 
									'count'       => $countupdate,
								);
								$result = $this->homemodel->updateRecords('user_coupon', $insertcoupon, $where);
							}else{

							}
				
						}


						$array_items = array(
							'coupon_code'   , 
							'offer'         ,
							'exp_date'      ,
							'discount_price'
						);
						$this->session->unset_userdata($array_items);

					}
			// =====================coupon code end===================

			
			}

		

			if($payment_status=='Completed')
			{
				$result = $this->homemodel->insertData('payments', $insertData);
			}else{
				redirect('home/cancel');
			}

		}

		if($payment_status=='Completed'){
			if($this->session->userdata('register_billing_id')){ 
				$this->BillingRegisteredUserEmail();  //this function will send mail ();
			}		
		}

		if($payment_status=='Completed'){
			if($this->session->userdata('guest_email')){ //if user purchasing product as a guest user
				$this->session->sess_destroy();
			}		
		}

		#after payment cart will blank
		foreach ($this->cart->contents() as $items){
			$info = array(
		   		'rowid' => $items['rowid'],
		   		'qty'   => 0
			 );
			$this->cart->update($info);
		}

		
		$this->get_header();
		$this->load->view('template/success');
		$this->get_footer();

		//end get data from cart section

	}
	

	// if payment is fail
	public function cancel(){
		$this->get_header();
		$this->load->view('template/cancel');
		$this->get_footer();
	}

	// function ipn(){
	// 	//paypal return transaction details array
	// 	$paypalInfo	= $this->input->post();

	// 	//$data['user_id'] = $paypalInfo['custom'];
	// 	//$data['product_id']	= $paypalInfo["item_number"];
	// 	//$data['txn_id']	= $paypalInfo["txn_id"];
	// 	//$data['payment_gross'] = $paypalInfo["payment_gross"];
	// 	//$data['currency_code'] = $paypalInfo["mc_currency"];
	// 	$data['payer_email'] = $paypalInfo["payer_email"];
	// 	//$data['payment_status']	= $paypalInfo["payment_status"];

	// 	$paypalURL = $this->paypal_lib->paypal_url;		
	// 	$result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
	// 	//check whether the payment is verified
	// 	if(preg_match("/VERIFIED/i",$result)){
	// 	    //insert the transaction data into the database
	// 		$result = $this->homemodel->insertData('payments', $insertData);
	// 	}
 //    }


	public function ordersummary(){

		if($this->session->userdata('guest_email') || $this->session->userdata('email')){
			
			if($this->session->userdata('email')){
				$email = $this->session->userdata('email');
				$data['records'] = $this->homemodel->isEmailExist($email);
			}else if($this->session->userdata('guest_email')){
				$email = $this->session->userdata('guest_email');
				$data['records'] = $this->homemodel->isEmailExist($email);
			}
			

			$this->get_header();
			$this->load->view('template/ordersummary', $data);
			$this->get_footer();
		}else{
			redirect('home');
		}

	}

	public function couponVarify(){ 
		$coupon_name = $this->input->post("couponname");
		$where = array('coupon_code' => $coupon_name, );
		$result = $data['coupon'] = $this->homemodel->getSingleRecords('coupon', $where);
		
		if($result){
			$c_code    = $data['coupon']->coupon_code;
			$c_offer   = $data['coupon']->offer;
			
			$c_expdate = strtotime($data['coupon']->exp_date);
			$current_date = strtotime(date("m/d/Y"));

			$valid_till = $c_expdate - $current_date;
			$original_price = $this->cart->format_number($this->cart->total());

			$discount_price =  $original_price - $c_offer;

			if($valid_till >= 0){
				$coupon_session = array(
	            	'coupon_code'    =>  $c_code,
	            	'offer'          =>  $c_offer,
	            	'exp_date'       =>  $c_expdate,
	            	'discount_price' =>  $discount_price,
	    		);
	    		$this->session->set_userdata($coupon_session);
	    		echo json_encode(array('type' => 'success','msg' => 'Congartulation', 'coupon_codecode' => $c_code, 'offer' => $c_offer, 'exp_date' => $c_expdate, 'discount_price' => $discount_price ));

			}else{
				echo json_encode(array('type' => 'failed','msg' => 'Coupon has been expired'));
			}


	    }else{
	    	echo json_encode(array('type' => 'error','msg' => 'Coupon does not exist'));
	    }


	}
    

}

