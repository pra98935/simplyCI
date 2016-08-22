<?php
$dp="";
if($this->session->userdata('profile_image')){
    $dppath = $this->session->userdata('profile_image');
    $dp = base_url("asset/user/uploads/profile_pic/$dppath");
}else if($this->session->userdata('image')){
    $dppath = $this->session->userdata('image');
    $dp = base_url("asset/user/uploads/profile_pic/$dppath");
}else{
    $dp = base_url("asset/user/images/avatar.png");
}
?>

<?php
$lastparameter = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<div class="col-sm-4">
    <div class="admin_sidebar">
        <div class="admin_comnh">
            <img src="<?php echo $dp; ?>"> Hoang Nguyen
        </div>
        <div class="sidebar_link">
            <ul>
                <li><i class="flaticon3-user-avatar-with-check-mark"></i> My Account</li>
                <li class="<?php if($lastparameter=='edit_acnt'){echo "active";}{} ?>" ><a href="<?php echo base_url(); ?>user_admin/edit_acnt">  Edit your account information</a></li>
                <li class="<?php if($lastparameter=='changepass'){echo "active";}{} ?>" ><a href="<?php echo base_url(); ?>user_admin/changepass">   Change your password</a></li>
                <li class="<?php if($lastparameter=='billingaddress'){echo "active";}{} ?>" ><a href="<?php echo base_url(); ?>user_admin/billingaddress"> Billing Address </a></li>
                <li class="<?php if($lastparameter=='modifyaddress' || $lastparameter=='addnewaddress' || strpos($_SERVER['REQUEST_URI'], 'editaddress') !== false){echo "active";}{} ?>"><a href="<?php echo base_url(); ?>user_admin/modifyaddress">   Modify your address book entries</a></li>
                <li><i class="flaticon3-choice"></i> My Orders</li>
                <li class="<?php if($lastparameter=='allorder' || $lastparameter=='orderdetail'){echo "active";}{} ?>"><a href="<?php echo base_url(); ?>user_admin/allorder">   View your order history</a></li>
                <li><i class="flaticon3-interface"></i> Newsletter Settings</li>
                <li class="<?php if($lastparameter=='subscribe'){echo "active";}{} ?>" ><a href="<?php echo base_url(); ?>user_admin/subscribe">   Subscribe / Unsubscribe to Newsletter</a></li>
            </ul>
        </div>
    </div>
</div>




                <!-- <li><i class="flaticon3-user-avatar-with-check-mark"></i> My Account</li>
                <li class="active"><a href="<?php //echo base_url(); ?>user_admin/edit_acnt">  Edit your account information</a></li>
                <li><a href="<?php //echo base_url(); ?>user_admin/changepass">   Change your password</a></li>
                <li><a href="<?php //echo base_url(); ?>user_admin/modifyaddress">   Modify your address book entries</a></li>
                <li><i class="flaticon3-choice"></i> My Orders</li>
                <li><a href="<?php //echo base_url(); ?>user_admin/allorder">   View your order history</a></li>
                <li><i class="flaticon3-interface"></i> Newsletter Settings</li>
                <li><a href="<?php //echo base_url(); ?>user_admin/subscribe">   Subscribe / Unsubscribe to Newsletter</a></li> -->