<?php 
    if($this->input->cookie('remember_me', TRUE)){ 
        $str = $this->input->cookie('remember_me', TRUE); 
        $Arrcookie = explode("/",$str);
        $email_cookie = $Arrcookie[0];
        $pass_cookie  = $Arrcookie[1];
    }
?>

<script>
jQuery(document).ready(function(){
  jQuery("#btn_continue").on('click', (function(e) {
      var leftsecid = jQuery(this).parents('.checkout_left').attr('id');
      var usertype  = jQuery("#"+leftsecid).find('input[name=usertype]:checked').val();
      e.preventDefault();
      var url = "<?php echo base_url('home/billingAction'); ?>"; 
      jQuery.ajax({
          url: url,
          type: "POST",
          data: {usertype:usertype},
          dataType: "json",
          success: function(data) {
            if(data.type == "success"){
                var usertype =  data.msgs;
                console.log(usertype);
                var billingurl = "<?php echo base_url('home/billing/'); ?>"+"/"+usertype+""; 
                console.log(url);
                window.location = billingurl; 
            }else{
                var msg =  data.msgs;
                console.log(msg);
            }  
          },
      });
      }));

      // for login  
        jQuery("#checkoutlogin").on('submit', (function(e) {
            e.preventDefault();
            var url = "<?php echo base_url('home/loginBillingAction/registereduser'); ?>"; 
            jQuery.ajax({
                url: url,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: "json",
                processData: false,
                success: function(data) {
                    if(data.type == "error"){
                        jQuery(".success").hide();
                        jQuery(".error").hide();
                        jQuery(".err").show();

                        var total = data.msgs;
                        var obj = Object.keys(total);
                        for (var i = 0; i < obj.length; i++) {
                           jQuery('.' + obj[i]).html(total[obj[i]]);
                        };
                    }else if(data.type=="failed"){
                        var msg = data.msg;
                        jQuery(".err").hide();
                        jQuery(".success").hide();
                          jQuery(".error").show();
                        jQuery(".error").html(msg); 
                    }else if(data.type=="success"){
                        var msg = data.msg;
                        console.log(msg);
                        jQuery(".err").hide();
                        jQuery(".error").hide();
                        jQuery(".success").html(msg);
                        var billingurl = "<?php echo base_url('home/billing/'); ?>"+"/"+msg+""; 
                        console.log(url);
                        window.location = billingurl; 
                    }
                },

            });
        }));
      // end for login

  });
</script>

<div class="main_container how_it">
            <section class="common howit_contain">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="main_head">CHECKOUT</h1>
                           <div class="chk_out"> <a class="rtn_chkot" href="<?php echo base_url('home/cartpage'); ?>">Return to Cart</a></div>
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
                        <div class="col-sm-6">
                            <div class="checkout_left" id="check_left">
                              <h2 class="sub_rgs">CHECKOUT AS A GUEST OR REGISTER</h2>
                              <p class="chk_pera">Register with us for future convenience:</p>
                              <p class="chk_pera">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                
                                <div class="chk_option">
                                    <ul>
                                        <li><label><input type="radio" name="usertype" value="guest"> Checkout as Guest</label></li>
                                        <li><label><input type="radio" name="usertype" value="register" checked=""> Register an Account</label></li>
                                    </ul>
                                </div>
                                <div class="cook_instruc">
                                    <ul>
                                        
                                        <li> 4 Fast and easy check out</li>
                                        <li>4 Easy access to your order history and status</li>
                                    </ul>
                                </div>
                         
                                    <button type="submit" class="btn btn-contact fl_wth" id="btn_continue">countinue</button>
                               
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="checkout_right">
                                      <h2 class="sub_rgs">Already a Member</h2>
                              <p class="chk_pera">I am a returning customer</p>
                              
                              <div class="row">

                        <form role="form" method="post" action="#" id="checkoutlogin">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">E-Mail Address:</label>
                                    <input type="text" class="form-control" name="email" value="<?php if($this->input->cookie('remember_me', TRUE)){ echo $email_cookie; }else{} ?>" />
                                    <span class="err email"></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Password:</label>
                                    <input type="password" class="form-control" name="password" value="<?php if($this->input->cookie('remember_me', TRUE)){ echo $pass_cookie; }else{} ?>" />
                                    <span class="err password"></span>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <a href="<?php echo base_url(); ?>user_admin/forgotpass" class="forgt_pswrd">Forgotten Password</a>
                                </div>
                            </div>
              
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-contact fl_wth">login</button>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="checkbox">
                                        <label><input type="checkbox" name="remember" value="1" <?php if($this->input->cookie('remember_me', TRUE)){ echo 'checked'; }else{} ?>> Remember me</label>
                                  </div>
                                </div>
                            </div>
                        </form>

                        
                        <span class="error"></span>
                        <span class="success"></span>

                    </div>
                                    
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