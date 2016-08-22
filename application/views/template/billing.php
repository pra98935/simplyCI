<?php
    if($usertype){
        $typeofuser = $usertype['usertype'];
    }

    // echo '<pre>';
    // print_r($billingaddress);
    // die;
    
?>
<script>
jQuery(document).ready(function(){

    jQuery(".delivery_add1").change(function(){
        if (jQuery(this).prop('checked')) {
             
             jQuery(".deliveryformrow1").hide();
             jQuery(".deliverymsg").removeClass('hide');
        }
        else {
            
            jQuery(".deliverymsg").addClass('hide');
            jQuery(".deliveryformrow1").show();
        }
    });

    jQuery(".delivery_add2").change(function(){
         if (jQuery(this).prop('checked')) {
             
             jQuery(".deliveryformrow2").hide();
             jQuery(".deliverymsg").removeClass('hide');
        }
        else {
            
            jQuery(".deliverymsg").addClass('hide');
            jQuery(".deliveryformrow2").show();
        }
    });

    jQuery(".delivery_addcheck").change(function(){
         if (jQuery(this).prop('checked')) {
             
             jQuery(".deliveryformrow").hide();
             jQuery(".deliverymsg").removeClass('hide');
        }
        else {
            
            jQuery(".deliverymsg").addClass('hide');
            jQuery(".deliveryformrow").show();
        }
    });


    // registeration of user
    jQuery("#blngadd_reguser").on('submit', (function(e) {
        e.preventDefault();
          
        if (jQuery("#blngadd_reguser .delivery_addcheck").prop('checked')) {
      		var Jsbillingad = 1;
        }else{
      		var Jsbillingad = 0;
        }

        var url = "<?php echo base_url('home/billingRegisterAction'); ?>/"+Jsbillingad; 
        
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
                    console.log(total);
                    var obj = Object.keys(total);
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msgs;
                    jQuery(".err").hide();
                    jQuery(".success").hide();
                    jQuery(".error").show();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msgs;
                    jQuery(".err").hide();
                    jQuery(".error").hide();
                    jQuery(".success").show();
                    jQuery(".success").html(msg); 

                    setTimeout(function(){
                    	window.location.href = "<?php echo base_url('home/billing/register'); ?>";
                 	}, 2000);
                }
            },

        });
    }));


    // Guest account
    jQuery("#guest_user").on('submit', (function(e) {
        e.preventDefault();
          
        if (jQuery("#guest_user .delivery_addcheck").prop('checked')) {
            var Jsbillingad = 1;
        }else{
            var Jsbillingad = 0;
        }

        var url = "<?php echo base_url('home/billingGuestAction'); ?>/"+Jsbillingad; 
        
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
                    console.log(total);
                    
                    var obj = Object.keys(total);
                    for (var i = 0; i < obj.length; i++) {
                       jQuery('.' + obj[i]).html(total[obj[i]]);
                    };
                }else if(data.type=="failed"){
                    var msg = data.msgs;
                    jQuery(".err").hide();
                    jQuery(".success").hide();
                    jQuery(".error").show();
                    jQuery(".error").html(msg); 
                }else if(data.type=="success"){
                    var msg = data.msgs;
                    jQuery(".err").hide();
                    jQuery(".error").hide();
                    jQuery(".success").show();
                    jQuery(".success").html(msg); 

                    setTimeout(function(){
                        window.location.href = "<?php echo base_url('home/ordersummary'); ?>";
                    }, 2000);
                }
            },

        });
    }));
    
    //checked first radio button
    // jQuery("input:radio[name=dlvryadd][disabled=false]:first").attr('checked', true);
    // jQuery("#form_alreadyuser .dlvryaddbilling input:radio[disabled=false]:first").attr('checked', true);

    //already registered user 
     jQuery("#form_alreadyuser").on('submit', (function(e) {
        e.preventDefault();
          
        if (jQuery("#form_alreadyuser .delivery_addcheck").prop('checked')) { 
            var Jsbillingad = 1;
        }else{
            var Jsbillingad = 0;
            
            if(!jQuery("input:radio[name='dlvryadd']").is(":checked")) {
                alert("Please select delivery address");
                return false;
            }

        }

        

        var billing_id  = jQuery("#form_alreadyuser .billingradio").attr('id');

        var delivery_id = jQuery("input[name=dlvryadd]:checked").attr('id');

        var url = "<?php echo base_url('home/setUserSession'); ?>/"+Jsbillingad+'/'+billing_id+'/'+delivery_id; 
        
        jQuery.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            dataType: "json",
            processData: false,
            success: function(data) {
                if(data.type=="failed"){
                    var msg = data.msgs;
                    jQuery(".success").hide();
                    jQuery(".error").show();
                    jQuery(".error").html(msg); 
                }else{
                    var msg = data.msgs;
                    jQuery(".error").hide();
                    jQuery(".success").show();
                    jQuery(".success").html(msg); 
                    

                    setTimeout(function(){
                        window.location.href = "<?php echo base_url('home/ordersummary'); ?>";
                    }, 2000);
                }
            },

        });
    }));



});
</script> 




<div class="main_container how_it">
    <section class="common howit_contain">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 billingpage">

            <?php if($usertype){ 
                $typeofuser = $usertype['usertype'];
                if($typeofuser=='register'){
            ?>
            <div class="row mainrow">

            		<form role="form" method="post" id="blngadd_reguser" action="#">
                    <div class="col-sm-7 boxborder">
                        <div class="admin_leftbar">
                            <h1 class="main_head">Account & Billing Details</h1>
                            <div class="row">
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>First Name:</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control">
                                            <span class="firstname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Last Name:</label>
                                            <input type="text" name="lastname" id="lname" class="form-control">
                                            <span class="lastname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Email:</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                            <span class="email err"></span>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone:</label>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div> 

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fax">Fax:</label>
                                            <input type="text" id="" class="form-control" name="fax">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">How Did You Hear About Us?</label>
                                            <select class="form-control" name="hearabtus">
                                                <option value="Search Engine" >Search Engine</option>
                                                <option value="Newspaper">Newspaper</option>
                                                <option value="By Email">By Email</option>
                                                <option value="By Friends">By Friends</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="Allergies">Do You Have Any Food Allergies?</label>
                                            <div class="chk_box">
                                                <ul>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts1"> Nuts1 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts2"> Nuts2 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts3"> Nuts3 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts4"> Nuts4 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts5"> Nuts5 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts6"> Nuts6 </li>
                                                    <li><input type="checkbox" name="allergies[]" value="nuts7"> Nuts7 </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <h2 class="sub_rgs">YOUR ADDRESS</h2>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Company:</label>
                                            <input type="text" id="email" class="form-control" name="company">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Address1:</label>
                                            <input type="text" id="" class="form-control" name="address1">
                                            <span class="address1 err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Address2:</label>
                                            <input type="text" id="" class="form-control" name="address2">
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>County:</label>
                                            <select name="county" id="input-county" class="form-control">
                                              <option value="">--Select--</option>
                                              <option value="essex_counties">Essex Counties</option>
                                              <option value="hunterdon">Hunterdon</option>
                                              <option value="mercer">Mercer</option>
                                              <option value="middlesex_counties">Middlesex Counties</option>
                                              <option value="morris">Morris</option>
                                              <option value="somerset">Somerset</option>
                                              <option value="union">Union</option>
                                              <option value="warren">Warren</option>
                                            </select>
                                            <span class="county err"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city"><span class="cmplsry">*</span>City:</label>
                                            <input type="text" id="city" class="form-control" name="city">
                                            <span class="city err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state"><span class="cmplsry">*</span>State:</label>
                                            <input type="text" id="state" class="form-control" name="state" value="New Jersey" disabled="">
                                            <span class="state err"></span>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Zip / Postal Code:</label>
                                            <input type="text" id="zip" class="form-control" name="zip">
                                            <span class="zip err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <h2 class="sub_rgs">YOUR PASSWORD</h2>
                                    </div>
                      
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="password"><span class="cmplsry">*</span>Password:</label>
                                        <input type="password" id="" class="form-control" name="password">
                                        <span class="err password"></span>
                                      </div>
                                    </div>

                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="confirmpassword"><span class="cmplsry">*</span>Confirm Password:</label>
                                        <input type="password" id="" class="form-control" name="confirmpass">
                                        <span class="err confirmpass"></span>
                                      </div>
                                    </div>

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <input type="checkbox" class="delivery_addcheck" name="deliveryadd"> <span>Billing address same as delivery address</span>
                                      </div>
                                    </div>
                                   

                                    
                                    <!-- <div class="col-sm-12 submitbtn">
                                        <div class="form-group">
                                            <button class="btn btn-contact" type="submit">Register</button>
                                        </div>
                                    </div> -->
                                    
                                
                            </div>
                        </div>
                    </div>
                    <!-- delivery address -->
                    <div class="col-sm-4 boxborder pull-right">
                        <div class="admin_leftbar">
                            <h1 class="main_head">Delivery Address</h1>
                            <strong class="deliverymsg hide">Your delivery address same as billing address</strong>
                            <div class="row deliveryformrow">
                                
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>First Name:</label>
                                            <input type="text" name="dlvryfirstname" id="firstname" class="form-control">
                                            <span class="dlvryfirstname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Last Name:</label>
                                            <input type="text" name="dlvrylastname" id="lname" class="form-control">
                                            <span class="dlvrylastname err"></span>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone">Telephone:</label>
                                            <input type="text" id="phone" name="dlvryphone" class="form-control">
                                        </div>
                                    </div> 

                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="fax">Fax:</label>
                                            <input type="text" id="" class="form-control" name="dlvryfax">
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Company:</label>
                                            <input type="text" id="email" class="form-control" name="dlvrycompany">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Address1:</label>
                                            <input type="text" id="" class="form-control" name="dlvryaddress1">
                                            <span class="dlvryaddress1 err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Address2:</label>
                                            <input type="text" id="" class="form-control" name="dlvryaddress2">
                                        </div>
                                    </div>

                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>County:</label>
                                            <select name="dlvrycounty" id="input-county" class="form-control">
                                              <option value="">--Select--</option>
                                              <option value="essex_counties">Essex Counties</option>
                                              <option value="hunterdon">Hunterdon</option>
                                              <option value="mercer">Mercer</option>
                                              <option value="middlesex_counties">Middlesex Counties</option>
                                              <option value="morris">Morris</option>
                                              <option value="somerset">Somerset</option>
                                              <option value="union">Union</option>
                                              <option value="warren">Warren</option>
                                            </select>
                                            <span class="dlvrycounty err"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="city"><span class="cmplsry">*</span>City:</label>
                                            <input type="text" id="city" class="form-control" name="dlvrycity">
                                            <span class="dlvrycity err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="state"><span class="cmplsry">*</span>State:</label>
                                            <input type="text" id="state" class="form-control" name="dlvrystate" value="New Jersey" disabled="">
                                            <span class="dlvrystate err"></span>
                                        </div>
                                    </div>

                                     <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Zip / Postal Code:</label>
                                            <input type="text" id="zip" class="form-control" name="dlvryzip">
                                            <span class="dlvryzip err"></span>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-sm-12 submitbtn">
                                        <div class="form-group">
                                            <button class="btn btn-contact" type="submit">Submit</button>
                                        </div>
                                    </div> -->
                                   
                                
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-sm-12 submitsec">
                            <div class="form-group">
                        	<button type="submit" class="btn btn-contact">Register</button>
                            </div>
                        </div>

                        <div class="col-sm-12">
	                        <div class="success"></div>
	                        <div class="error"></div>
                        </div>

                        </form>
                        <!-- <a href="<?php //echo base_url('home/ordersummary'); ?>" class="nextstep" >Continue</a> -->
                    </div>
                    <!-- end delivery address -->
          <?php }else if($typeofuser=='guest'){ ?>
                   <div class="row mainrow">

                    <form role="form" method="post" id="guest_user" action="#">
                    <div class="col-sm-6">
                        <div class="admin_leftbar">
                            <h1 class="main_head">Billing Details</h1>
                            <div class="row">
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>First Name:</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control">
                                            <span class="firstname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Last Name:</label>
                                            <input type="text" name="lastname" id="lname" class="form-control">
                                            <span class="lastname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Email:</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                            <span class="email err"></span>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone:</label>
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div> 

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fax">Fax:</label>
                                            <input type="text" id="" class="form-control" name="fax">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Company:</label>
                                            <input type="text" id="email" class="form-control" name="company">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Address1:</label>
                                            <input type="text" id="" class="form-control" name="address1">
                                            <span class="address1 err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Address2:</label>
                                            <input type="text" id="" class="form-control" name="address2">
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>County:</label>
                                            <select name="county" id="input-county" class="form-control">
                                              <option value="">--Select--</option>
                                              <option value="essex_counties">Essex Counties</option>
                                              <option value="hunterdon">Hunterdon</option>
                                              <option value="mercer">Mercer</option>
                                              <option value="middlesex_counties">Middlesex Counties</option>
                                              <option value="morris">Morris</option>
                                              <option value="somerset">Somerset</option>
                                              <option value="union">Union</option>
                                              <option value="warren">Warren</option>
                                            </select>
                                            <span class="county err"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city"><span class="cmplsry">*</span>City:</label>
                                            <input type="text" id="city" class="form-control" name="city">
                                            <span class="city err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state"><span class="cmplsry">*</span>State:</label>
                                            <input type="text" id="state" class="form-control" name="state" value="New Jersey" disabled="">
                                            <span class="state err"></span>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Zip / Postal Code:</label>
                                            <input type="text" id="zip" class="form-control" name="zip">
                                            <span class="zip err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <input type="checkbox" class="delivery_addcheck" name="deliveryadd"> <span>Billing address same as delivery address</span>
                                      </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <!-- delivery address -->
                    <div class="col-sm-6 pull-right">
                        <div class="admin_leftbar">
                            <h1 class="main_head">Delivery Address</h1>
                            <strong class="deliverymsg hide">Your delivery address same as billing address</strong>
                            <div class="row deliveryformrow">
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>First Name:</label>
                                            <input type="text" name="dlvryfirstname" id="firstname" class="form-control">
                                            <span class="dlvryfirstname err"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Last Name:</label>
                                            <input type="text" name="dlvrylastname" id="lname" class="form-control">
                                            <span class="dlvrylastname err"></span>
                                        </div>
                                    </div>
                                    
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone:</label>
                                            <input type="text" id="phone" name="dlvryphone" class="form-control">
                                        </div>
                                    </div> 

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fax">Fax:</label>
                                            <input type="text" id="" class="form-control" name="dlvryfax">
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Company:</label>
                                            <input type="text" id="email" class="form-control" name="dlvrycompany">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Address1:</label>
                                            <input type="text" id="" class="form-control" name="dlvryaddress1">
                                            <span class="dlvryaddress1 err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Address2:</label>
                                            <input type="text" id="" class="form-control" name="dlvryaddress2">
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>County:</label>
                                            <select name="dlvrycounty" id="input-county" class="form-control">
                                              <option value="">--Select--</option>
                                              <option value="essex_counties">Essex Counties</option>
                                              <option value="hunterdon">Hunterdon</option>
                                              <option value="mercer">Mercer</option>
                                              <option value="middlesex_counties">Middlesex Counties</option>
                                              <option value="morris">Morris</option>
                                              <option value="somerset">Somerset</option>
                                              <option value="union">Union</option>
                                              <option value="warren">Warren</option>
                                            </select>
                                            <span class="dlvrycounty err"></span>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city"><span class="cmplsry">*</span>City:</label>
                                            <input type="text" id="city" class="form-control" name="dlvrycity">
                                            <span class="dlvrycity err"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state"><span class="cmplsry">*</span>State:</label>
                                            <input type="text" id="state" class="form-control" name="dlvrystate" value="New Jersey" disabled="">
                                            <span class="dlvrystate err"></span>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><span class="cmplsry">*</span>Zip / Postal Code:</label>
                                            <input type="text" id="zip" class="form-control" name="dlvryzip">
                                            <span class="dlvryzip err"></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-contact">Order Summary</button>
                        </div>

                        <div class="col-sm-12">
                            <div class="success"></div>
                            <div class="error"></div>
                        </div>

                        </form>
                        <!-- <a href="<?php //echo base_url('home/ordersummary'); ?>" class="nextstep" >Continue</a> -->
                    </div>
                <?php }else if($typeofuser=='registereduser'){ ?>   
                        <div class="row mainrow registeredusersection">
                        <form action="#" method="post" id="form_alreadyuser">
                            <div class="col-sm-6">
                                <div class="admin_leftbar">
                                    <h1 class="main_head">Billing Details</h1>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if($billingaddress) {?>
                                            <?php foreach ($billingaddress as $value) { ?>
                                                <?php //echo '<pre>'; print_r($value); ?>
                                                <div class="multibillingadd">    
                                                    <span><input type="radio" name="billingadd" class="billingradio" checked="checked" id="<?php echo $value['id']; ?>"></span> 
                                                      <span class="spanadd">
                                                        <?php 
                                                          echo '<div>';
                                                            if($value['firstname']){echo "<strong>Name </strong>".$value['firstname'];}
                                                            if($value['lastname']){echo " ".$value['lastname'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['company']){echo "<strong>Company </strong>".$value['company'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['email']){echo "<strong>Email </strong>".$value['email'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['address1']){echo "<strong>Address1 </strong>".$value['address1'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['address2']){echo "<strong>Address2 </strong>".$value['address2'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['phone']){echo "<strong>Mobile </strong>".$value['phone'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['fax']){echo "<strong>Fax </strong>".$value['fax'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['city']){echo "<strong>City </strong>".$value['city'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['zip']){echo "<strong>Zip </strong>".$value['zip'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['county']){echo "<strong>County </strong>".$value['county'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['state']){echo "<strong>State </strong>".$value['state'];}
                                                          echo '</div>';
                                                        ?>  
                                                    </span>
                                                </div>
                                            <?php } ?>
                                            <?php } ?>
                                        </div>

                                        <div class="col-sm-12">
                                          <div class="row">
                                          <div class="form-group">
                                            <input type="checkbox" value="1" name="deliveryadd" class="delivery_addcheck"> <span>Billing address same as delivery address</span>
                                          </div>
                                          </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- delivery address -->
                            <div class="col-sm-6 pull-right">
                                <div class="admin_leftbar">
                                    <h1 class="main_head">Delivery Address</h1>
                                    <strong class="deliverymsg hide">Your delivery address same as billing address</strong>
                                    <div class="row deliveryformrow">
                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if($singleuserdata) {?>
                                            <!-- <select class="registeredbilling"> -->
                                            <?php $i=1; ?>
                                            <?php foreach ($singleuserdata as $value) { ?>
                                                        <?php 
                                                          //$address = $value['firstname']." ".$value['lastname'].", ".$value['company'].", ".$value['address1'].", ".$value['address2'].", ".$value['city']."(".$value['zip']."), ".$value['county'].", ".$value['state'].", Mobile- ".$value['phone'].", Fax- ".$value['fax'];
                                                        ?>
                                                        <!-- <option value="<?php echo $address; ?>"><?php echo $address; ?></option> -->
                                                        <div class="deliveradd-<?php echo $i; ?> dlvryaddbilling" >
                                                        <span><input type="radio" name="dlvryadd" class="dlvryradio" id="<?php echo $value['id']; ?>" <?php if($this->session->userdata('register_dlvry_id') == $value['id']){echo "checked";}else{} ?>></span> 
                                                        <span class="spanadd">
                                                        <?php 
                                                          echo '<div>';
                                                            if($value['firstname']){echo "<strong>Name </strong>".$value['firstname'];}
                                                            if($value['lastname']){echo " ".$value['lastname'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['company']){echo "<strong>Company </strong>".$value['company'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['address1']){echo "<strong>Address1 </strong>".$value['address1'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['address2']){echo "<strong>Address2 </strong>".$value['address2'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['phone']){echo "<strong>Mobile </strong>".$value['phone'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['fax']){echo "<strong>Fax </strong>".$value['fax'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['city']){echo "<strong>City </strong>".$value['city'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['zip']){echo "<strong>Zip </strong>".$value['zip'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['county']){echo "<strong>County </strong>".$value['county'];}
                                                          echo '</div>';

                                                          echo '<div>';
                                                            if($value['state']){echo "<strong>State </strong>".$value['state'];}
                                                          echo '</div>';
                                                        ?> 
                                                        </span>
                                                        </div>
                                            <?php $i++; ?>              
                                            <?php } ?>
                                            <!-- </select>	 -->
                                            <?php } ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <!-- <a href="<?php //echo base_url('home/ordersummary'); ?>" class="nextstep billingbtn">Order Summary</a> -->
                                <button type="submit" class="btn btn-contact">Order Summary</button>
                            </div>
                        </form>
                        <div class="col-sm-12"> 
                            <span class="error"></span> 
                            <span class="success"></span>
                        </div>
                        </div>
                <?php }
             } ?> 
            </div>        
            </div>
        </div>
    </section>
</div>