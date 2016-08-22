<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        $this->load->model('admin_model');
    	$this->load->library('form_validation');
    }

	public function index()
	{   
		if($this->Check_Admin_Sess()){
			redirect('admin/Admin_Login_Success_Cntrl');
		}
		//$this->load->view('admin/header');
		    //$this->load->view('admin/header');
            $this->load->view('admin/login');
        	//$this->load->view('admin/footer');
		
        //$this->load->view('admin/footer');
	}

	public function Admin_Login_Cntrl(){
    		$config = $this->custom_form_validation->Chk_validation(); 
    		foreach($config as $val) {
    			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
    		}
		    
		     //$this->form_validation->set_rules('email', 'Username', 'required');
            //$this->form_validation->set_rules('password', 'Password', 'required');
    		
    		if($this->form_validation->run()==FALSE){
    			//$this->load->view('admin/header');
                $this->load->view('admin/login');
        	    //$this->load->view('admin/footer');
    		}else{
    			
            	$email = $this->input->post('email');
	    		$pass  = $this->input->post('password');
	    		
	    		$result = $this->admin_model->admin_Login($email, $pass);

                if(!empty($result)) {
                	
                	$sess_email = $result['0']['email'];
                	//$sess_fname = $result['0']['firstname'];
		    		$admin_session = array(
		            	'email' =>  $sess_email,
		            );
		    		$this->session->set_userdata($admin_session);
		    		redirect('admin/Admin_Login_Success_Cntrl');

                }else{
                	$this->session->set_flashdata('error', 'You have entered some wrong');
                	redirect('admin');
                }

    		}

	}

	Public function Check_Admin_Sess(){
		$sess_var = $this->session->userdata('email');
		if(!empty($sess_var)){
			return true;
		}else{
			return false;
		}
		
	}

	public function Admin_Login_Success_Cntrl(){
		
		if ($this->Check_Admin_Sess()) {
            //$this->load->view('admin/header');
			// $this->load->view('admin/home');
            //$this->load->view('admin/footer');
            redirect('admin/allpagesmenu');
        }else{
        	redirect('admin');
        }
		
	}

	public function Admin_Logout_Cntrl(){
		$this->session->unset_userdata($admin_session);
		$this->session->sess_destroy();
		redirect('admin');

	}

	public function addnewpagesmenu(){
    	if ($this->Check_Admin_Sess()) {
            $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
			$this->load->view('admin/addnewpages');
        	$this->load->view('admin/footer');
        }else{
        	redirect('admin');
        }
	}

	public function insert_add_newpages(){
    	if ($this->Check_Admin_Sess()) {
            
            $config = $this->custom_form_validation->addpagevalidation(); 

    		foreach($config as $val) {
    			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
    		} 
            
            if($this->form_validation->run()==FALSE){
            	echo json_encode(array('type' => 'title_blank','msg' => 'Please Insert a Valid Title'));
            }else{
            	$data = array(
					'title' => $this->input->post('pagetitle'),
					'description' => $this->input->post('desc'),
					'status' => '1',
				);
				
				$result = $this->admin_model->insertData('static_pages', $data);
				if($result){
					echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record insert successfully '));
				}else{
					echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
				}
            }

	
		}else{
        	redirect('admin');
        }
	}

	public function allpagesmenu(){
    	if ($this->Check_Admin_Sess()) {
            $data['result'] = $this->admin_model->getRecords('static_pages');
            
            $this->load->view('admin/header');
            $this->load->view('admin/sidebar');
			$this->load->view('admin/allpages', $data);
        	$this->load->view('admin/footer');
        }else{
        	redirect('admin');
        }
	}

	public function updatepage(){
		
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->editpagevalidation(); 
		
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	echo json_encode(array('type' => 'title_blank','msg' => 'Please Insert a Valid Title'));
        }else{
        	$data = array(
	           'title' => $this->input->post('page_title'),
			   'description' => $this->input->post('desc'),
	        ); 
			//$id = $this->uri->segment(3);
			$id = $this->input->post('pageid');
			
			$where = array('id' => $id);
			
			$result = $this->admin_model->updateRecords('static_pages', $data, $where);

			if($result){
				echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully '));
			}else{
				echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}
        }

        
		
	}

	public function editpage(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

        
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['result'] = $this->admin_model->getSingleRecords('static_pages', $where);
        
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/updatepage', $data);
		$this->load->view('admin/footer');
		
		//$this->session->set_flashdata('updatepage','Page successfully Updated'); 
		//redirect('admin/allpagesmenu');
	}

	public function deletepage(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->admin_model->deleteRecords('static_pages', $where);
		$this->session->set_flashdata('daletepage','Page successfully deleted'); 
		redirect('admin/allpagesmenu');
		
	}

	public function menu(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
        
        $data['result']='';
        $data['month_year'] = array(
        	'month' => '', 
        	'year' => ''
        	);

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/menu', $data);
		$this->load->view('admin/footer');
	}

	public function editmenu(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
        
        $data['result']='';

        $data['month_year'] = array(
        	'month' => '', 
        	'year' => ''
        	);

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/editmenu', $data);
		$this->load->view('admin/footer');
	}

	public function catering(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
             
        	$data['result']      = $this->admin_model->getRecords('catering_item');
			$data['allcatering'] = $this->admin_model->getRecords('catering');

			$this->load->view('admin/header');
	        $this->load->view('admin/sidebar');
			$this->load->view('admin/catering', $data);
			$this->load->view('admin/footer');
      

		
	}

	public function filtercatering(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
 
        $catname = $this->input->post('catnamefilter');
            
        if($catname=='all'){
        	$data['result'] = $this->admin_model->getRecords('catering_item');
        }else{
        	$where = array('cat_name' => $catname, );
    		$data['result'] = $this->admin_model->getConditionRecords('catering_item', $where);	
        }

		$data['allcatering'] = $this->admin_model->getRecords('catering');
		$data['selectedcatname'] = $catname;

		$this->load->view('admin/header');
     	$this->load->view('admin/sidebar');
		$this->load->view('admin/filtercatering', $data);
		$this->load->view('admin/footer');
	}

	public function addcatering(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$data['result'] = $this->admin_model->getRecords('catering');

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/addcatering', $data);
		$this->load->view('admin/footer');
	}

	public function addcateringAction(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addcatering(); 
		
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
			$arrayError = array(
				'item'      => form_error('item'), 
				'half_tray' => form_error('half_tray'), 
				'full_tray' => form_error('full_tray') 
				);
        	echo json_encode(array('type' => 'error','msgs' => $arrayError));
        }else{

        	$item      = $this->input->post('item');
            $half_tray = $this->input->post('half_tray');
            $full_tray = $this->input->post('full_tray');
            
            $cat_name = $this->input->post('catlist');
            
            $where = array('category' => $cat_name, ); 

            $catrecords = $this->admin_model->getSingleRecords('catering', $where);
            $catid = $catrecords->id;

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
				    $store     = "asset/admin/uploads/catering_item/". $f_newfile;
				    if(move_uploaded_file($f_tmp, $store)){
					    $data      = array(
											'image'     => $f_newfile,
											'item'      => $item, 
							            	'half_tray' => $half_tray, 
							            	'full_tray' => $full_tray, 
							            	'cat_name'  => $cat_name,
							            	'cat_id'    => $catid,
							            	'status'    => '1'
																  );
					}
			    }else{
						$data = array(
					            	'item'      => $item, 
					            	'half_tray' => $half_tray, 
					            	'full_tray' => $full_tray, 
					            	'cat_name'  => $cat_name,
					            	'cat_id'    => $catid,
					            	'status'    => '1'
					            	);
					}
            
             
            $result = $this->admin_model->insertData('catering_item', $data);
            if($result){
            	echo json_encode(array('type' => 'success', 'msg'=>'Catering item successfully insert'));
            }else{
            	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
            }
            

        }

	}

	public function updatecatAction(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addcatering(); 
		
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
			$arrayError = array(
				'item'      => form_error('item'), 
				'half_tray' => form_error('half_tray'), 
				'full_tray' => form_error('full_tray') 
				);
        	echo json_encode(array('type' => 'error','msgs' => $arrayError));
        }else{

        	$item      = $this->input->post('item');
            $half_tray = $this->input->post('half_tray');
            $full_tray = $this->input->post('full_tray');
            $cat_name  = $this->input->post('catlist');
            $id = $this->uri->segment(3);
            
            $where = array('category' => $cat_name,);

            $data['catering'] = $this->admin_model->getSingleRecords('catering', $where);
            $cat_id = $data['catering']->id;
            
            

            
           
            $where = array('id' => $id, ); 
            
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
				    $store     = "asset/admin/uploads/catering_item/". $f_newfile;
				    if(move_uploaded_file($f_tmp, $store)){
					    $data      = array(
											'image'     => $f_newfile,
											'item'      => $item, 
							            	'half_tray' => $half_tray, 
							            	'full_tray' => $full_tray, 
							            	'cat_name'  => $cat_name,
							            	'cat_id'    => $cat_id,
							            );	
					    
					}
			    }else{
						$data = array(
					            	'item'      => $item, 
					            	'half_tray' => $half_tray, 
					            	'full_tray' => $full_tray, 
					            	'cat_name'  => $cat_name,
					            	'cat_id'    => $cat_id,
					            	);
					}
             
            $result = $this->admin_model->updateRecords('catering_item', $data, $where);

            if($result){
            	echo json_encode(array('type' => 'success', 'msg'=>'Catering item successfully update'));
            }else{
            	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
            }
            

        }

	}
    
    // delete catering records
	public function del_catering_item(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->admin_model->deleteRecords('catering_item', $where);
		$this->session->set_flashdata('catering_item_del','Catering item successfully deleted'); 
		redirect('admin/catering');
		
	}

	public function addcat(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}


		$this->form_validation->set_rules('category', 'Category', 'required|is_unique[catering.category]');

		if($this->form_validation->run()==FALSE){
			echo json_encode(array('type' => 'invalid', 'msg' => 'Please Insert Unique Title'));
		}else{
			$catname = $this->input->post('category'); 		
			$data = array(
				'category' => $catname, 
				'status'   => 1, 
				);
			$result = $this->admin_model->insertData('catering',$data);
			if($result){
				echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record insert successfully '));
			}else{
				echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			}
		}

	}

	public function editcatering(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['result'] = $this->admin_model->getSingleRecords('catering_item', $where);

		$data['allcatering'] = $this->admin_model->getRecords('catering');

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/editcatering', $data);
		$this->load->view('admin/footer');
	}

	public function addnewmeal($month=NULL, $year=NULL){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		//echo $month;
		//echo $year;

		$data['month_year'] = array(
				'month' => $month, 
				'year' =>  $year
			);

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/addnewmeal', $data);
		$this->load->view('admin/footer');
	}


    public function addMealAction(){

		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addmeal(); 
		
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
			$arrayError = array(
				'title'           => form_error('title'), 
				'cooking_time'    => form_error('cooking_time'), 
				'description'     => form_error('description'), 
				'cal'        => form_error('cal'), 
				'total_fat'       => form_error('total_fat'), 
				'carbohydrate'    => form_error('carbohydrate'), 
				'protein'         => form_error('protein'), 
				'sodium'          => form_error('sodium'), 
				'sugar'           => form_error('sugar'), 
				'service_price_3' => form_error('service_price_3'), 
				'service_price_6' => form_error('service_price_6') 
			);
        	echo json_encode(array('type' => 'error','msgs' => $arrayError));
        }else{

	        	$title                = $this->input->post('title');
	            $cooking_time         = $this->input->post('cooking_time');
	            $description          = $this->input->post('description');
	            $cooking_instructions = $this->input->post('cooking_instructions');
	            $cal                  = $this->input->post('cal');
	            $total_fat            = $this->input->post('total_fat');
	            $carbohydrate         = $this->input->post('carbohydrate');
	            $protein              = $this->input->post('protein');
	            $sodium               = $this->input->post('sodium');
	            $sugar                = $this->input->post('sugar');
	            $service_price_3      = $this->input->post('service_price_3');
	            $service_price_6      = $this->input->post('service_price_6');
	            $add_menu_month       = $this->input->post('add_menu_month');
	            $add_menu_year        = $this->input->post('add_menu_year');
            

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
				    $store     = "asset/admin/uploads/menu_meals/". $f_newfile;
				    if(move_uploaded_file($f_tmp, $store)){
					    $data      = array(
											'title'                => $title,
								            'cooking_time'         => $cooking_time,
								            'description'          => $description,
								            'cooking_instructions' => $cooking_instructions,
								            'cal'                  => $cal,
								            'total_fat'            => $total_fat,
								            'carbohydrate'         => $carbohydrate,
								            'protein'              => $protein,
								            'sodium'               => $sodium,
								            'sugar'                => $sugar,
								            'service_price_3'      => $service_price_3,
								            'service_price_6'      => $service_price_6,
								            'add_menu_month'       => $add_menu_month,
                                            'add_menu_year'        => $add_menu_year,
											'image'                => $f_newfile,
											'status'               => '0'
									);
					}
			    }else{
						$data = array(
					            	
											'title'                => $title,
								            'cooking_time'         => $cooking_time,
								            'description'          => $description,
								            'cooking_instructions' => $cooking_instructions,
								            'cal'             => $cal,
								            'total_fat'            => $total_fat,
								            'carbohydrate'         => $carbohydrate,
								            'protein'              => $protein,
								            'sodium'               => $sodium,
								            'sugar'                => $sugar,
								            'service_price_3'      => $service_price_3,
								            'service_price_6'      => $service_price_6,
								            'add_menu_month'       => $add_menu_month,
                                            'add_menu_year'        => $add_menu_year,
											'status'               => '0'
					            	);
				}
            
            
	            $result = $this->admin_model->insertData('menu_meals', $data);
	            if($result){
	            	echo json_encode(array('type' => 'success', 'msg'=>'Meals item successfully insert'));
	            }else{
	            	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
	            }
            

            }

	}


    public function editMealAction(){

		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

        $id = $this->uri->segment(3);
		

		$config = $this->custom_form_validation->addmeal(); 
		
		foreach($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
			$arrayError = array(
				'title'           => form_error('title'), 
				'cooking_time'    => form_error('cooking_time'), 
				'description'     => form_error('description'), 
				'cal'        => form_error('cal'), 
				'total_fat'       => form_error('total_fat'), 
				'carbohydrate'    => form_error('carbohydrate'), 
				'protein'         => form_error('protein'), 
				'sodium'          => form_error('sodium'), 
				'sugar'           => form_error('sugar'), 
				'service_price_3' => form_error('service_price_3'), 
				'service_price_6' => form_error('service_price_6') 
			);
        	echo json_encode(array('type' => 'error','msgs' => $arrayError));
        }else{

	        	$title                = $this->input->post('title');
	            $cooking_time         = $this->input->post('cooking_time');
	            $description          = $this->input->post('description');
	            $cooking_instructions = $this->input->post('cooking_instructions');
	            $cal                  = $this->input->post('cal');
	            $total_fat            = $this->input->post('total_fat');
	            $carbohydrate         = $this->input->post('carbohydrate');
	            $protein              = $this->input->post('protein');
	            $sodium               = $this->input->post('sodium');
	            $sugar                = $this->input->post('sugar');
	            $service_price_3      = $this->input->post('service_price_3');
	            $service_price_6      = $this->input->post('service_price_6');
	            $add_menu_month       = $this->input->post('add_menu_month');
	            $add_menu_year        = $this->input->post('add_menu_year');
            

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
				    $store     = "asset/admin/uploads/menu_meals/". $f_newfile;
				    if(move_uploaded_file($f_tmp, $store)){
					    $data      = array(
											'title'                => $title,
								            'cooking_time'         => $cooking_time,
								            'description'          => $description,
								            'cooking_instructions' => $cooking_instructions,
								            'cal'                  => $cal,
								            'total_fat'            => $total_fat,
								            'carbohydrate'         => $carbohydrate,
								            'protein'              => $protein,
								            'sodium'               => $sodium,
								            'sugar'                => $sugar,
								            'service_price_3'      => $service_price_3,
								            'service_price_6'      => $service_price_6,
								            'add_menu_month'       => $add_menu_month,
                                            'add_menu_year'        => $add_menu_year,
											'image'                => $f_newfile,
											//'status'               => '0'
									);
					}
			    }else{
						$data = array(
					            	
											'title'                => $title,
								            'cooking_time'         => $cooking_time,
								            'description'          => $description,
								            'cooking_instructions' => $cooking_instructions,
								            'cal'                  => $cal,
								            'total_fat'            => $total_fat,
								            'carbohydrate'         => $carbohydrate,
								            'protein'              => $protein,
								            'sodium'               => $sodium,
								            'sugar'                => $sugar,
								            'service_price_3'      => $service_price_3,
								            'service_price_6'      => $service_price_6,
								            'add_menu_month'       => $add_menu_month,
                                            'add_menu_year'        => $add_menu_year,
											//'status'               => '0'
					            	);
				}
            
                
	            $where = array("id" => $id);
	            $result = $this->admin_model->updateRecords('menu_meals', $data, $where);

	            if($result){
	            	echo json_encode(array('type' => 'success', 'msg'=>'Meals item successfully updated'));
	            }else{
	            	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
	            }
            

            }

	} 



	public function filterMenu(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
 
        $month = $this->input->post('add_menu_month');
        $year  = $this->input->post('add_menu_year');
            
        
        $where = array(
        			'add_menu_month' => $month, 
        			'add_menu_year'  => $year,
        			'status'         => 1,  
        		);
    	$data['result'] = $this->admin_model->getConditionRecords('menu_meals', $where);

    	$data['month_year'] = array(
					            	'month' => $month,
								    'year'  => $year
								);	

		$this->load->view('admin/header');
     	$this->load->view('admin/sidebar');
		$this->load->view('admin/menu', $data);
		$this->load->view('admin/footer');
	}

	public function filterEditMenu(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
 
        $month = $this->input->post('add_menu_month');
        $year  = $this->input->post('add_menu_year');
            
        
        $where = array(
        			'add_menu_month' => $month, 
        			'add_menu_year'  => $year,
        		);

    	$data['result'] = $this->admin_model->getConditionRecords('menu_meals', $where);

    	$data['month_year'] = array(
    			'month' =>  $month,
    			'year'  =>  $year
    		);	

		$this->load->view('admin/header');
     	$this->load->view('admin/sidebar');
		$this->load->view('admin/editmenu', $data);
		$this->load->view('admin/footer');
	}
    
    

   	public function editmenumeal(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['result'] = $this->admin_model->getSingleRecords('menu_meals', $where);

		//$data['allcatering'] = $this->admin_model->getRecords('catering');

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/editmenumeal', $data);
		$this->load->view('admin/footer');
	}

	public function del_menumeal_item(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$result = $this->admin_model->deleteRecords('menu_meals', $where);

        if($result){
        	echo json_encode(array('type' => 'success', 'msg'=>'Meals item successfully deleted'));
        }else{
        	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
        } 


		//$this->session->set_flashdata('catering_item_del','Catering item successfully deleted'); 
		//redirect('admin/menu');
	}


	// public function editmenumeal(){
	// 	if(!$this->Check_Admin_Sess()){
	// 		redirect('admin');
	// 	}

	// 	$this->load->view('admin/header');
 //        $this->load->view('admin/sidebar');
	// 	$this->load->view('admin/editmenumeal');
	// 	$this->load->view('admin/footer');
	// }

	public function order(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/order');
		$this->load->view('admin/footer');
	}

	public function orderdetail(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/orderdetail');
		$this->load->view('admin/footer');
	}

	public function customers(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/customers');
		$this->load->view('admin/footer');
	}

	public function customersdetail(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/customersdetail');
		$this->load->view('admin/footer');
	}

	public function reviews(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$data['result'] = $this->admin_model->getRecords('customer_review');

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/reviews',$data);
		$this->load->view('admin/footer');
	}

	public function addnewreviews(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/addnewreviews');
		$this->load->view('admin/footer');
	}

	public function addnewreviewsAction(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addreview();
		foreach ($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}
        
        if($this->form_validation->run()==FALSE){
        	$arrayError = array(
        		'name'   => form_error('name'), 
                'review' => form_error('review')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $arrayError ));
        }else{
        	$name   = $this->input->post('name'); 
        	$review = $this->input->post('review'); 

        	$data = array(
        		'name'   => $name, 
        		'review' => $review, 
        		'status' => 1 
        		); 
            $result = $this->admin_model->insertData('customer_review', $data);
            if($result){
            	echo json_encode(array('type'=>'success', 'msg'=>'Review successfully inserted'));
            }else{
            	echo json_encode(array('type'=>'failed', 'msg'=>'Please try again later'));
            }

        }

	}

	public function editreview(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
        
        $id = $this->uri->segment(3);
        $where = array('id' => $id, );
		$data['result'] = $this->admin_model->getSingleRecords('customer_review', $where);
        
		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/editreview', $data);
		$this->load->view('admin/footer');
	}

	public function updatereview(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addreview();
		foreach ($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}
        
        if($this->form_validation->run()==FALSE){
        	$arrayError = array(
        		'name'   => form_error('name'), 
                'review' => form_error('review')
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $arrayError ));
        }else{
        	$name   = $this->input->post('name'); 
        	$review = $this->input->post('review'); 
            
            $id = $this->uri->segment(3);

        	$data = array(
        		'name'   => $name, 
        		'review' => $review 
        		); 
            
            $where = array('id' => $id,);

            $result = $this->admin_model->updateRecords('customer_review', $data, $where);
            
            if($result){
            	echo json_encode(array('type'=>'success', 'msg'=>'Review successfully updated'));
            }else{
            	echo json_encode(array('type'=>'failed', 'msg'=>'Please try again later'));
            }

        }

	}

	public function deletereview(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->admin_model->deleteRecords('customer_review', $where);
		$this->session->set_flashdata('review_del','Review successfully deleted'); 
		redirect('admin/reviews');
		
	}

	// code for coupon

	public function addcoupon(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 

		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/addcoupon');
		$this->load->view('admin/footer');
		
	}

	public function addcouponAction(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}

		$config = $this->custom_form_validation->addcoupon();
		foreach ($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	$arrayError = array(
        		'coupon_code' => form_error('coupon_code'), 
                'offer'       => form_error('offer'),
                'exp_date'    => form_error('exp_date'),
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $arrayError ));
        }else{
        	$coupon_code = $this->input->post('coupon_code');
			$offer       = $this->input->post('offer');
			$exp_date    = $this->input->post('exp_date');

			$data = array(
						'coupon_code' => $coupon_code, 
						'offer'       => $offer, 
						'exp_date'    => $exp_date, 
					);

			$result = $this->admin_model->insertData('coupon', $data);
			
			if($result){
	        	echo json_encode(array('type'=>'success', 'msgs'=>'Coupon successfully created'));
	        }else{
	        	echo json_encode(array('type'=>'failed', 'msgs'=>'Please try again later'));
	        }
        } 
	}

	public function updateCouponAction(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 

		$config = $this->custom_form_validation->editcoupon();
		foreach ($config as $val) {
			$this->form_validation->set_rules($val['field'], $val['label'], $val['rules']);
		}

		if($this->form_validation->run()==FALSE){
        	$arrayError = array(
        		//'coupon_code' => form_error('coupon_code'), 
                'offer'       => form_error('offer'),
                'exp_date'    => form_error('exp_date'),
        		);
        	echo json_encode(array('type' => 'error', 'msgs' => $arrayError ));
        }else{
        	$c_id = $this->uri->segment(3); 

			//$coupon_code = $this->input->post('coupon_code');
			$offer       = $this->input->post('offer');
			$exp_date    = $this->input->post('exp_date');

			$where = array('id' => $c_id, );

			$data = array(
						//'coupon_code' => $coupon_code, 
						'offer'       => $offer, 
						'exp_date'    => $exp_date, 
					);

			$result = $this->admin_model->updateRecords('coupon', $data, $where);
			
			if($result){
	        	echo json_encode(array('type'=>'success', 'msgs'=>'Coupon successfully updated'));
	        }else{
	        	echo json_encode(array('type'=>'failed', 'msgs'=>'Please try again later'));
	        }
        }

		
		
	}

	

	public function allcoupon(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 

		$data['coupon'] = $this->admin_model->getRecords('coupon');
		
		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/allcoupon', $data);
		$this->load->view('admin/footer');
	}

	public function delete_coupon(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->admin_model->deleteRecords('coupon', $where);
		$this->session->set_flashdata('coupon_del','Coupon successfully deleted'); 
		redirect('admin/allcoupon');
		
	}

	public function edit_coupon(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		} 
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['singlecoupon'] = $this->admin_model->getSingleRecords('coupon', $where);
        
		$this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/edit_coupon', $data);
		$this->load->view('admin/footer');

		//$this->session->set_flashdata('coupon_del','Coupon successfully deleted'); 
		//redirect('admin/allcoupon');
		
	}

	

	public function calendar(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
		/***
		 * To add state in db table 
		 * Method added by trilok
		 * */
			
		if($this->input->post('add_location')){
				$data = array(
								'zipcode'=> $this->input->post('zipcode'),
								'city'   => $this->input->post('city'),
								'state'  => $this->input->post('state'),
								'county' => $this->input->post('county'),
							  ); 
				$result = $this->admin_model->insertData('locations', $data);
				if($result){
					$this->session->set_flashdata('message', 'Location added successfully.');

					//echo json_encode(array('type'=>'success', 'msg'=>'Location added successfully'));
				}else{
					//echo json_encode(array('type'=>'failed', 'msg'=>'Please try again later'));
				}
			
		}
		
        $data['locations']= $this->get_locations();
        $data['events']= $this->get_events();
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar');
		$this->load->view('admin/calendar',$data);
		$this->load->view('admin/footer');
	}
	/**
	 * Method : get_locations
	 * Response : html
	 * Created By : TRILOK
	 ****/
	public function get_locations(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
    return $this->admin_model->getRecords('locations');
    	
	}
	public function get_events(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
    return $this->admin_model->getRecords('calendar');
    	
	}
	function addEvent(){ //print_r($_REQUEST); die;
		
		$data=array('date'=>date("Y-m-d",strtotime($this->input->post('date'))),'state'=>$this->input->post('state'),'county'=>$this->input->post('county'),'color'=>$this->input->post('color'),'delivery'=>$this->input->post('delivery'),'recurring'=>$this->input->post('recurring'));
		
		 $result = $this->admin_model->insertData('calendar', $data);
            if($result){
            	echo json_encode(array('type' => 'success', 'msg'=>'Added Successfully'));
            }else{
            	echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
            }
            
	}
	function getEventByDate(){
	
	$date = $this->input->post('date');
	$where = array('date' =>date('Y-m-d', strtotime($date)));
	$result = $this->admin_model->getAllRecordsWhere('calendar',$where);

    if($result){
           	echo json_encode($result[0]);
    }else{
       	    echo json_encode(array('type' => 'failed', 'msg'=>'Please try again'));
    }	
	
	}
	
	public function changestatus(){
		if(!$this->Check_Admin_Sess()){
			redirect('admin');
		}
        
        $month = $this->input->post('month'); 
        $year  = $this->input->post('year');
        
        $where = array(
        			'add_menu_month' => $month, 
        			'add_menu_year'  => $year 
        	);

        $status0 = 0;
        $result_status = $this->admin_model->changestatus0('menu_meals', $status0, $where);

        $checkboxValues = $this->input->post('checkboxValues'); 
                
		for ($i=0;$i<count($checkboxValues);$i++) {
            $status = 1;
            $result = $this->admin_model->changestatus('menu_meals',$checkboxValues[$i],$status);	

            if($result){
				echo json_encode(array('type' => 'success','lid' => $result,'msg' => 'Record Update successfully'));
			}else{
				echo json_encode(array('type' => 'failed','msg' => 'Failed Please Try Again'));
			} 
		}
        




	}
}
