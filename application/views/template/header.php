<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

<?php
  $lastparameter = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simply Delicious Dinners | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/plugin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/flaticon.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/slick.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/slick-theme.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>asset/frontend/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/frontend/css/responsive.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/frontend/js/modernizr-custom.js"></script>
  
  </head>

<body>

<?php 
 // echo $this->session->userdata('register_dlvry_id'); 
 // echo '<br/>'; 
 // echo $this->session->userdata('register_billing_id'); 
?>

<script>
jQuery(document).ready(function(){

    jQuery(".shop_cart a").click(function(){
        jQuery(".cartdescription").toggleClass("hide");
    });
    
    jQuery(".add_cart").on('click', (function(e) {
      jQuery(".onload").hide();	
      jQuery("#pronumpageload").hide();
      jQuery("#cartdata").removeClass("hide");
      var cart_data = '';
      setTimeout(function(){
        var url = "<?php echo base_url('home/addtocartAjax'); ?>"; 
        
        jQuery.ajax({
            url: url,
            type: "POST",
            //data: {subsval:subscribe},
            dataType: "json",
            success: function(data) {
              if(data.type == "returndata"){
                
                var msg          = data.msg;
                var totalamount  = data.total;
                var totalproduct = msg.length;

                jQuery('#pronum').html(totalproduct);

                for (var i = 0; i < msg.length; i++) {
                  if(msg[i].options.Servings){
                    cart_data += "<li class='cartlist'><span class='name'><img src='"+msg[i].options.Image+"' alt='proimage' width='50' height='50'>" + "<a href='"+msg[i].options.Link+"' target='_blank'>" +msg[i].name+ "</a>" + "<a href='javascript:void();' class='delcart' id="+msg[i].rowid+"> x </a>" + "</br><strong> Servings: </strong>" + msg[i].options.Servings + "</span>"+ " " +"<span class='qty'></br><strong> Quantity: </strong>" +msg[i].qty+ "</span>" + " " + "<span class='subtotal'></br><strong> Subtotal: </strong>"+"$"+msg[i].subtotal+ "</span></li>";
                  }else{
                    cart_data += "<li class='cartlist'><span class='name'><img src='"+msg[i].options.Image+"' alt='proimage' width='50' height='50'>" + "<a href='"+msg[i].options.Link+"' target='_blank'>" +msg[i].name+ "</a>" + "<a href='javascript:void();' class='delcart' id="+msg[i].rowid+"> x </a>" + "</br><strong> Tray: </strong>" + msg[i].options.Tray + "</span>"+ " " +"<span class='qty'></br><strong> Quantity: </strong>" +msg[i].qty+ "</span>" + " " + "<span class='subtotal'></br><strong> Subtotal: </strong>"+"$"+msg[i].subtotal+ "</span></li>";
                  }
                };
                cart_data += "<li class='cartlist'><strong>Grand Total: </strong>" + "$" + totalamount + "</li>";
                cart_data += "<li class='cartnchk'><a href='<?php echo base_url('home/cartpage'); ?>' class='hdrcart'>Cart</a><a href='<?php echo base_url('home/checkout'); ?>' class='hdrchk'>Checkout</a></li>"
                jQuery('#cartdata').html(cart_data);
              }
            },
        });

      }, 1000);
    })); 

    // Delete cart item from header

    jQuery(document).on('click', '.delcart' ,(function(e) {
      e.preventDefault();
      var cartid = jQuery(this).attr('id');
      // alert(cartid);
      var url = "<?php echo base_url('home/daletecart/"+cartid+"'); ?>"; 
      jQuery.ajax({
          url: url,
          type: "POST",
          //data: {subsval:subscribe},
          dataType: "json",
          success: function(data) {
            if(data.type == "success"){
              //var msg = data.msg;
              //jQuery(".error").html(msg); 
              window.location.reload();  
            }
          },
      });
    }));

    
});
</script>
   
    <main class="animsition">
        <!--Header sec start-->
        <header class="header_sec" id="header">
            <div class="top_header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-left">
                                <div class="top_social"> <a href="#"><i class="fa fa-facebook"></i></a> </div>
                            </div>
                            <div class="logo">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>asset/frontend/images/logo.png" class="img-responsive"></a>
                            </div>
                            <div class="pull-right">
                                <?php if($this->session->userdata('email')) { ?>
                                    <a href="<?php echo base_url() ?>user_admin/user_logout_cntrl" style="padding-top:0;"><i class="fa fa-sign-out pull-right"></i> Log Out</a> 
                                <?php }else{ ?>
                                	<div class="account_login"> <a href="<?php echo base_url() ?>user_admin">account login</a> </div>
                                <?php } ?>
                                
                                <div class="shop_cart"> <a href="javascript:void('0');"><i class="flaticon-commerce-1"></i> <span id="pronum"></span> <span id="pronumpageload"><?php echo count($this->cart->contents()); ?></span> <span class="rm_item">Items in Your Cart </span><i class="fa fa-sort-desc headcart"></i></a>                                    </div>
                            </div>

                              <div class="cartdescription hide">
                                <ul id="cartdata" class="hide">
                                  <?php
                                  foreach ($this->cart->contents() as  $value) {
                                        $cartdata[] = $value;
                                        //print_r($cartdata);
                                        foreach ($cartdata as $value) {
                                          //echo '<li class="cartlist">' . $value['name'] . '</li>';
                                          echo '<li class="cartlist loadli"><span class="name">' . $value['name'] . '</span><span class="name">' . " " .$value['qty'] . '</span><span class="name">' . " " . $value['subtotal'] . '</span></li>';
                                          
                                        }
                                      }
                                  ?>
                                </ul>
                                
                                  <!-- page load code start -->	
                                  	<div class="cartlist onload">
  		                                <ul>
                  		                                  	<?php $i = 1; ?>
                  											<?php foreach ($this->cart->contents() as $items): ?>
                  												<li class="cartinfo">
                  													<?php
                  													//echo '<pre>';
                  													//print_r($items);
                  													?>
                  													<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                  													
                  														<span class="name">
                  															<!--<?php //echo $items['name']; ?> <a href="javascript:void(0)" id="<?php //echo $items['rowid']; ?>" class="delcart">x</a>-->
                  															
                                                <!-- product image -->
                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                  <?php if($option_name == 'Image' && $option_value){ ?>  
                                                    <img src="<?php echo $option_value; ?>" alt="proimage" width="50" height="50">
                                                  <?php } ?>
                                                <?php endforeach; ?>

                                                <!-- product title -->
                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                <?php if($option_name == 'Link' && $option_value){ ?> 
                                                  <a href="<?php echo $option_value; ?>" target="_blank"> <?php echo $items['name']; ?> </a> <a href="javascript:void(0)" id="<?php echo $items['rowid']; ?>" class="delcart">x</a>
                                                <?php }elseif($option_name == 'Link' && $option_value == ''){ ?>
                                                     <?php echo $items['name']; ?> <a href="javascript:void(0)" id="<?php echo $items['rowid']; ?>" class="delcart">x</a>
                                                <?php  } ?>
                                                <?php endforeach; ?>

                                                <br/>
                                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                  															
                  															<!-- tray and servings -->
                  															<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                  <?php if(($option_name == 'Servings' || $option_name == 'Tray') && $option_value){ ?> 
                                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                                                  <?php } ?>
                                                <?php endforeach; ?>
                  															
                  															
                  															
                  															<?php endif; ?>
                  														</span>
                  														<span class="qty"><strong>Quantity: </strong><?php echo $items['qty']; ?></span>
                  														<!-- <li style="text-align:right"><?php //echo $this->cart->format_number($items['price']); ?></li> -->
                  														<br/>
                                              <span class="subtotal"><strong>Subtotal: </strong> $<?php echo $items['subtotal']; ?></span>
                  														<?php $rowid = $items['rowid']; ?>
                  														<!-- <li style="text-align:right"><a href="javascript:void(0)" id="<?php //echo $rowid; ?>" class="delcart">Delete</a></li> -->
                  													
                  													<?php $i++; ?>
                  												</li>
                                          
                  											<?php endforeach; ?>
                                        <li>
                                            <strong>Grand Total: </strong> $<?php echo $this->cart->format_number($this->cart->total()); ?>
                                        </li>
                                        <li class="cartnchk">
                                            <a href="<?php echo base_url('home/cartpage'); ?>" class="hdrcart">Cart</a>
                                            <a href="<?php echo base_url('home/checkout'); ?>" class="hdrchk">Checkout</a>
                                        </li>
                  										</ul>	
                  									</div>
                                  <!-- end page load cart start -->
                              </div>  

                        </div>
                    </div>
                </div>
            </div>
            <div class="middle_header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12"></div>
                    </div>
                </div>
            </div>
            <div class="main_nav">
                <nav class="navbar navbar-inverse">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>                                </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">
              <!-- <li class="active"><a href="index.html">Home</a></li>-->   
              
              <li class="<?php if($lastparameter=='simplydelicious'){ echo 'active'; }else{} ?> "><a href="<?php echo base_url(); ?>">Home</a></li>
              <?php
                if($result){
                foreach ($result as $value) {
                    // print_r($value);
                    // die;
                    $title = str_replace(' ', '_', $value['title']); ?>
                    <li class="<?php if($lastparameter=='How_It_Works'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/pages/<?php echo $title; ?>"><?php echo $value['title']; ?></a></li>
              <?php } }?>
              <li class="<?php if($lastparameter=='menu'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/menu">Menu</a></li>
              <li class="<?php if($lastparameter=='order_my_meal'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/order_my_meal">Order My Meals</a></li>
              <li class="<?php if($lastparameter=='catering'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/catering">Catering</a></li>
              <li class="<?php if($lastparameter=='review'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/review">Reviews</a></li>
              <li class="<?php if($lastparameter=='contact'){ echo 'active'; }else{} ?>" ><a href="<?php echo base_url(); ?>home/contact">Contact Us</a></li>

            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--Header sec end--> 


<style type="text/css">
.cartlist {text-align: left;}
.cartdescription {background: white none repeat scroll 0 0;border: 2px solid #fb9a00;border-radius: 5px;height: auto;max-height: 400px;overflow-y: auto;padding: 10px;position: absolute;right: 0;top: 107px;width: 300px;z-index: 999;}
.cartdescription ul li {border-bottom: 1px solid #fb9a00;display: block;font-family: "latoregular";padding-bottom: 5px;padding-top: 5px;position: relative;text-align: left;}
li.cartnchk a{background-color: #fb9a00;border-radius: 3px;color: white;display: inline-block;font-family: "latoregular";letter-spacing: 0.02em;margin-right: 5px;padding: 5px 10px;}
li.cartnchk a:hover{background-color: #D82E1C;}
.cartnchk {border-bottom: medium none !important;}
.cartdescription .delcart {color: red;position: absolute;right: -4px;top: 5px;}
</style>


