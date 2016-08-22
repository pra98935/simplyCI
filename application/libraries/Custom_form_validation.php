<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
class Custom_form_validation {
   public function __construct(){
      $this->Chk_validation();
      $this->addpagevalidation();       
      $this->editpagevalidation();
      $this-> user_register();
      $this->billing_user_register();
      $this-> newaddress();
      $this->submitmail();
      $this->changepass();
      $this->addreview();
      $this->addcatering();
      $this->addmeal();
      $this->guest_billing();
      $this->guest_billing_n_delivery();
      $this->addcoupon();
      $this->editcoupon();
   }

   public function Chk_validation(){
      $config = array(
         array(
               'field'   => 'email', 
               'label'   => 'Email', 
               'rules'   => 'required|valid_email'
            ),
         array(
               'field'   => 'password', 
               'label'   => 'Password', 
               'rules'   => 'required'
            ),
         
      );
      return $config;
   }

   public function addpagevalidation(){
      $config = array(
         array(
               'field'   => 'pagetitle', 
               'label'   => 'Page Title', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function editpagevalidation(){
      $config = array(
         array(
               'field'   => 'page_title', 
               'label'   => 'Page Title', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function user_register(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'email', 
               'label'   => 'Email', 
               'rules'   => 'required|valid_email|is_unique[user.email]'
            ),
         array(
               'field'   => 'password', 
               'label'   => 'Password', 
               'rules'   => 'required'
            ),
         
         array(
               'field'   => 'confirmpass', 
               'label'   => 'Confirm password', 
               'rules'   => 'required|matches[password]'
            ),   
         array(
               'field'   => 'address1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'county', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'city', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'zip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function billing_user_register(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'email', 
               'label'   => 'Email', 
               'rules'   => 'required|valid_email|is_unique[user.email]'
            ),
         array(
               'field'   => 'password', 
               'label'   => 'Password', 
               'rules'   => 'required'
            ),
         
         array(
               'field'   => 'confirmpass', 
               'label'   => 'Confirm password', 
               'rules'   => 'required|matches[password]'
            ),   
         array(
               'field'   => 'address1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'county', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'city', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'zip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryfirstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrylastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryaddress1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrycounty', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrycity', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryzip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
      );
      return $config;
   }

   public function user_editacnt(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function newaddress(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         
         array(
               'field'   => 'city', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'zip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'county', 
               'label'   => 'county', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function submitmail(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'email', 
               'label'   => 'Email', 
               'rules'   => 'required|valid_email'
            )
      );
      return $config;
   }

   public function changepass(){
      $config = array(
         array(
               'field'   => 'oldpass', 
               'label'   => 'Old password', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'newpass', 
               'label'   => 'New password', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'confirmpass', 
               'label'   => 'Confirm password', 
               'rules'   => 'required|matches[newpass]'
            )
      );
      return $config;
   }

   public function addreview(){
      $config = array(
         array(
               'field'   => 'name', 
               'label'   => 'Customer Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'review', 
               'label'   => 'Review', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function addcatering(){
      $config = array(
         array(
               'field'   => 'item', 
               'label'   => 'Item name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'half_tray', 
               'label'   => 'Half tray price', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'full_tray', 
               'label'   => 'Full tray price', 
               'rules'   => 'required'
            )
      );
      return $config;
   }

   public function addmeal(){
      $config = array(
         array(
               'field'   => 'title', 
               'label'   => 'Meal Item', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'cooking_time', 
               'label'   => 'Cooking Time', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'description', 
               'label'   => 'Description', 
               'rules'   => 'required'
            ),
         array(
            'field'   => 'cal', 
            'label'   => 'Calories', 
            'rules'   => 'required'
            ),
         array(
               'field'   => 'total_fat', 
               'label'   => 'Total Fat', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'carbohydrate', 
               'label'   => 'Carbohydrate', 
               'rules'   => 'required'
            ),
          array(
               'field'   => 'protein', 
               'label'   => 'Protein', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'sodium', 
               'label'   => 'Sodium', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'sugar', 
               'label'   => 'Sugar', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'service_price_3', 
               'label'   => '3 Servings Price', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'service_price_6', 
               'label'   => '6 Servings Price', 
               'rules'   => 'required'
            )
      );
      return $config;   
   }

   public function guest_billing(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'email', 
               'label'   => 'Email', 
               'rules'   => 'required|valid_email'
            ),
           
         array(
               'field'   => 'address1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'county', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'city', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'zip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
        
      );
      return $config;
   }

   public function guest_billing_n_delivery(){
      $config = array(
         array(
               'field'   => 'firstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'lastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
          
         array(
               'field'   => 'address1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'county', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'city', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'zip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryfirstname', 
               'label'   => 'First Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrylastname', 
               'label'   => 'Last Name', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryaddress1', 
               'label'   => 'Address', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrycounty', 
               'label'   => 'County', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvrycity', 
               'label'   => 'City', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'dlvryzip', 
               'label'   => 'Zip', 
               'rules'   => 'required'
            ),
      );
      return $config;
   }

   public function addcoupon(){
      $config = array(
         array(
               'field'   => 'coupon_code', 
               'label'   => 'Coupon Code', 
               'rules'   => 'required|is_unique[coupon.coupon_code]'
            ),
         array(
               'field'   => 'offer', 
               'label'   => 'Discount', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'exp_date', 
               'label'   => 'Expire Date', 
               'rules'   => 'required'
            ),
         
      );
      return $config;
   }

   public function editcoupon(){
      $config = array(
         // array(
         //       'field'   => 'coupon_code', 
         //       'label'   => 'Coupon Code', 
         //       'rules'   => 'required'
         //    ),
         array(
               'field'   => 'offer', 
               'label'   => 'Discount', 
               'rules'   => 'required'
            ),
         array(
               'field'   => 'exp_date', 
               'label'   => 'Expire Date', 
               'rules'   => 'required'
            ),
         
      );
      return $config;
   }

}
?>