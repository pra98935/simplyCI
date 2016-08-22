<?php
  $chk_quantity='';
  foreach ($this->cart->contents() as $items){
    $chk_quantity += $items['qty'];
  }
?>


<script type="text/javascript">
  
  function randomString(length) {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for(var i = 0; i < length; i++) {
          text += possible.charAt(Math.floor(Math.random() * possible.length));
      }
      return text;
  }

  //var pathchecker = randomString(4);

  


  function registerbuy(){
    document.getElementById('checker').value = randomString(4);
   
    var js_email = '<?php echo $records; ?>'; //check ordersummary() function
    var js_qty   = '<?php echo $chk_quantity; ?>';

    if(js_email==0 && js_qty >= 18){
      window.location.href = '<?php echo base_url(); ?>home/buy';
    }else if(js_email >= 1 && js_qty >= 30){
      window.location.href = '<?php echo base_url(); ?>home/buy';
    }else if(js_email==0 && js_qty <= 17){
      alert('Quantity should be 18');
      return false; 
    }else if(js_email >= 1 && js_qty <= 29){
      alert('Quantity should be 30');
      return false; 
    }

    document.getElementById("frm_checker").submit(); 
    return false; 
  }
    

  
  function guestbuy(){

    document.getElementById('checker').value = randomString(4);
    
    var js_qty   = '<?php echo $chk_quantity; ?>';
    var js_email = '<?php echo $records; ?>'; //check ordersummary() function

    if(js_email==0 && js_qty >= 18){
      window.location.href = '<?php echo base_url(); ?>home/buy';
    }else if(js_email >= 1 && js_qty >= 30){
      window.location.href = '<?php echo base_url(); ?>home/buy';
    }else if(js_email==0 && js_qty <= 17){
      alert('Quantity should be 18');
      return false; 
    }else if(js_email >= 1 && js_qty <= 29){
      alert('Quantity should be 30');
      return false;
    }

    document.getElementById("frm_checker").submit(); 
    return false; 

  }

</script>

<form action="<?php echo base_url('home/buy'); ?>" method="post" id="frm_checker">
  <input type="hidden" value="" name="path_chk" id="checker" class="">
</form>


<div class="main_container how_it">
    <section class="common howit_contain">
        <div class="container">
            
            <div class="row">
              <div class="col-sm-12">
                <h1 class="main_head">BILLING</h1>
              </div>

              <div class="col-sm-12">
                <div class="order_bar">
                  <ul>
                      <li>
                          <div class="ordbar_detal"><span>1</span> </div>
                          <a href="#">Your Cart</a>
                      </li>
                      <li>
                          <div class="ordbar_detal"><span>2</span> </div>
                          <a href="#">Checkout</a>
                      </li>
                      <li>
                          <div class="ordbar_detal"><span>3</span> </div>
                          <a href="#">Shipping Address</a>
                      </li>
                      <li>
                          <div class="ordbar_detal"><span>4</span> </div>
                          <a href="#"> Billing</a>
                      </li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="row checkout_rw">
                <div class="col-sm-8">
                  <div class="checkout_left  paypal_box">
                    <h2 class="sub_rgs">Choose payment method</h2>
                    <div class="paypal_box">
                        <div class="paypal_logo">
                          <img class="img-responsive" src="<?php echo base_url(); ?>asset/frontend/images/paypal.png" alt="paypal">
                        </div>
                        <div class="paypal_detail">
                          <h3>Pay with PayPal</h3>
                          <p>You'll be redirected to the PayPal site to sign in and confirm your payment. You will then be returned to officedepot.com to review and complete your order.</p>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="checkout_right paypal_box">
                    <h2 class="sub_rgs">Order summary</h2>
                    <div class="cart_edit"><a class="rtn_chkot" href="<?php echo base_url('home/cartpage'); ?>">Edit Cart</a></div>
                    <div class="total_paypal">
                        <ul>
                            <li>Subtotal                                   <span>$<?php echo $this->cart->format_number($this->cart->total()); ?></span></li>
                            <li>Total                                         <span>$<?php echo $this->cart->format_number($this->cart->total()); ?></span></li>
                            <li>Delivery                                         <small> (<?php echo count($this->cart->contents()); ?> items)</small></li>
                        </ul>
                    </div>
                    <div id="item_dropdown" class="paypal_clicable"><i class="fa fa-angle-down"></i></div>
                    <div class="delevery_item view_itmdd">
                        <h2 class="sub_rgs">Delivery <span class="item_qnty">(<?php echo count($this->cart->contents()); ?> items)</span></h2>
                        
                        <!-- cart start -->

    <?php $i = 1; ?>
    <?php foreach ($this->cart->contents() as $items): ?>
    <div class="dlvryitm_box">  
        
        <!-- product image -->
        <div class="dlvryitm_img">
        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
          <?php if($option_name == 'Image' && $option_value){ ?>  
              <img src="<?php echo $option_value; ?>" alt="proimage" class="img-responsive">
          <?php } ?>
        <?php endforeach; ?>
        </div>

        <!-- product title -->
        <div class="dlvryitm_desc">
            
            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
              <?php if($option_name == 'Link' && $option_value){ ?> 
                  <a href="<?php echo $option_value; ?>" target="_blank"> <?php echo $items['name']; ?> </a>
              <?php }elseif($option_name == 'Link' && $option_value == ''){ ?>
                  <a href="javascript:void(0)" id="<?php echo $items['rowid']; ?>" class="delcart">x</a>
              <?php  } ?>
            <?php endforeach; ?>

            <?php 
              $qty   = $items['qty'];
              $price = $items['price'];
            ?>
            <span class="item_price"> <?php echo $qty .'x'. $price; ?> = $<?php echo $items['subtotal']; ?></span>
        </div>


        
           
        <!-- <span class="qty"><strong>Quantity: </strong><?php //echo $items['qty']; ?></span>

        <span class="subtotal"><strong>Subtotal: </strong> $<?php //echo $items['subtotal']; ?></span> -->
        

    </div>     
    <?php $i++; ?>
    <?php endforeach; ?>
    

                        <!-- end cart start -->

                        
                    </div>
                  </div>
                  

                  <div class="paypal_btn">
                    <?php if($this->session->userdata('email')){?>
                      <a title="paypal button" href="javascript:void('0');" onclick="registerbuy();">
                        <img alt="paypal" src="<?php echo base_url(); ?>asset/frontend/images/paypal_btn.png">
                      </a>
                      <?php }else{ ?>
                        <a title="paypal button" href="javascript:void('0');" onclick="guestbuy();">
                          <img alt="paypal" src="<?php echo base_url(); ?>asset/frontend/images/paypal_btn.png">
                        </a>
                      <?php } ?>
                  </div>

                </div>

            </div>
            
        </div>
    </section>


    <section class="common blog_sec">
      <div class="top_deading">
        <div class="container">
          <div class="row">
              <div class="col-sm-12">
                <h1 class="head_line"> <span><a class="order" href="order.html">Order My Meals</a></span> </h1>
              </div>
          </div>
        </div>
      </div>
    </section>

</div>

<script>
$(document).ready(function() {
    $("#item_dropdown").click(function() {
        $(".delevery_item").toggleClass("view_itmdd");
    });
});

</script>