<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartcontrol extends CI_Controller {

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
        $this->load->model('cartmodel');
    	$this->load->library('form_validation');
    	$this->load->library("pagination");

    	$this->load->helper('url');
        $this->load->library('cart');
    }

	public function index()
	{
		
    	$data['products'] = array(
            array(
                   'id'      => 'sku_888',
                   'qty'     => 2,
                   'price'   => 10,
                   'name'    => 'T-Shirt'
                   
                ),
            array(
                   'id'      => 'sku_777',
                   'qty'     => 2,
                   'price'   => 20,
                   'name'    => 'Coffee Mug'
                ),
            array(
                   'id'      => 'sku_666',
                   'qty'     => 2,
                   'price'   => 30,
                   'name'    => 'Shot Glass'
                )
        );

        // Insert the product to cart
		if ($this->input->get('id') != '')
		{
			$this->cart->insert($data['products'][$this->input->get('id')]);
		}

		$this->load->view('frontend/cartpro',$data);

    }

    public function cartpage(){
    	    // Lets update our cart
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

			$this->load->view('frontend/cartpage');
    }
}

