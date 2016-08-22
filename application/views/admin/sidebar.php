<?php

$lastparameter = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// if(strpos($_SERVER['REQUEST_URI'], 'editmenumeal') !== false){
//     echo "in";
// }else{
//     echo "not";
// }



?>

<div class="col-sm-4">
    <div class="admin_sidebar">
        <div class="admin_sidbarh">Manage Modules </div>
        <div class="sidebar_link main_admin">
            <ul>
                 <li class="<?php if($lastparameter=='allpagesmenu' || strpos($_SERVER['REQUEST_URI'], 'editpage') !== false){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/allpagesmenu"><img src="<?php echo base_url(); ?>asset/admin/images/admin_cms.png"> CMS</a></li>
                 <li class="<?php if($lastparameter=='menu' || $lastparameter=='filtermenu' || $lastparameter=='editmenu' || $lastparameter=='filterEditMenu' || strpos($_SERVER['REQUEST_URI'], 'editmenumeal') !== false || strpos($_SERVER['REQUEST_URI'], 'addnewmeal') !== false){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/menu"><img src="<?php echo base_url(); ?>asset/admin/images/admin_menu.png"> Menu</a></li>
                 <li class="<?php if($lastparameter=='catering' || $lastparameter=='filtercatering' || $lastparameter=='addcatering' || strpos($_SERVER['REQUEST_URI'], 'editcatering') !== false){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/catering"><img src="<?php echo base_url(); ?>asset/admin/images/admin_catring.png"> Catering</a></li>
                 <li class="<?php if($lastparameter=='order' || $lastparameter=='orderdetail'){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/order"><i class="flaticon6-choice"></i> Order</a></li>
                 <li class="<?php if($lastparameter=='customers' || $lastparameter=='customersdetail'){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/customers"><i class="flaticon6-people"></i> Customers</a></li>
                 <li class="<?php if($lastparameter=='reviews' || $lastparameter=='addnewreviews' || strpos($_SERVER['REQUEST_URI'], 'editreview') !== false){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/reviews"><i class="flaticon6-interface-1"></i> Reviews</a></li>
                 <li class="<?php if($lastparameter=='calendar'){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/calendar"><i class="fa fa-calendar"></i> Calendar Settings </a></li>
                 <li class="<?php if($lastparameter=='addcoupon'){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/addcoupon"><i class="fa fa-pencil-square-o"></i> Add Coupon </a></li>
                 <li class="<?php if($lastparameter=='allcoupon'){echo "active";} {}?>" ><a href="<?php echo base_url(); ?>admin/allcoupon"><i class="fa fa-list"></i> All Coupon </a></li>
            </ul>
        </div>
    </div>
</div>